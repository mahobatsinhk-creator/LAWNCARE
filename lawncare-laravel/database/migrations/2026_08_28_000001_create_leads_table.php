<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->boolean('marketing_email')->default(false);
            $table->string('phone');
            $table->boolean('marketing_sms')->default(false);
            $table->string('street');
            $table->string('unit')->nullable();
            $table->string('city');
            $table->string('province', 8);
            $table->string('postal_code', 16);
            $table->string('service');
            $table->text('message');
            $table->string('status')->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
