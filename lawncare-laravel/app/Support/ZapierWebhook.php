<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ZapierWebhook
{
    public static function dispatch(string $source, array $payload): void
    {
        $url = config('services.zapier.webhook_url');

        if (! is_string($url) || $url === '') {
            return;
        }

        $service = (string) ($payload['service'] ?? '');
        $message = (string) ($payload['message'] ?? '');
        $notes = trim(implode("\n", array_filter([
            $service !== '' ? "Service: {$service}" : null,
            $message !== '' ? "Message: {$message}" : null,
        ])));

        try {
            $response = Http::timeout(8)
                ->acceptJson()
                ->asJson()
                ->post($url, array_merge([
                    'source' => $source,
                    'form_type' => $payload['form'] ?? $source,
                    'submitted_at' => now()->toIso8601String(),
                    'site' => config('app.url'),
                    'notes' => $notes,
                ], $payload));

            if (! $response->successful()) {
                Log::warning('Zapier webhook returned a non-success status.', [
                    'source' => $source,
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
            }
        } catch (Throwable $exception) {
            Log::warning('Zapier webhook request failed.', [
                'source' => $source,
                'message' => $exception->getMessage(),
            ]);
        }
    }
}
