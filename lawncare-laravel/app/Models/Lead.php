<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'company',
        'email',
        'marketing_email',
        'phone',
        'marketing_sms',
        'street',
        'unit',
        'city',
        'province',
        'postal_code',
        'service',
        'message',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'marketing_email' => 'boolean',
            'marketing_sms' => 'boolean',
        ];
    }

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
