<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

class ZapierWebhook
{
    /**
     * Build a Jobber-friendly payload for Zapier Filters + field mapping.
     *
     * @param  'contact'|'quote'  $formType
     * @param  array<string, mixed>  $fields
     * @return array<string, mixed>
     */
    public function payloadFor(string $formType, array $fields): array
    {
        $service = trim((string) ($fields['service'] ?? ''));
        $message = trim((string) ($fields['message'] ?? ''));

        $notes = collect([
            $service !== '' ? "Service requested: {$service}" : null,
            $message !== '' ? "Message: {$message}" : null,
        ])->filter()->implode("\n");

        return array_merge($fields, [
            'source' => $formType,
            'form_type' => $formType,
            'lead_type' => $formType === 'quote' ? 'Get Quote' : 'Contact Form',
            'service' => $service,
            'message' => $message,
            'notes' => $notes,
            'jobber_notes' => $notes,
        ]);
    }

    public function send(array $payload): bool
    {
        $url = config('services.zapier.webhook_url');

        if (! is_string($url) || $url === '') {
            return false;
        }

        try {
            $response = Http::timeout(10)
                ->acceptJson()
                ->asJson()
                ->post($url, $payload);

            if (! $response->successful()) {
                Log::warning('Zapier webhook returned non-success status.', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return false;
            }

            return true;
        } catch (Throwable $exception) {
            Log::warning('Zapier webhook request failed.', [
                'message' => $exception->getMessage(),
            ]);

            return false;
        }
    }
}
