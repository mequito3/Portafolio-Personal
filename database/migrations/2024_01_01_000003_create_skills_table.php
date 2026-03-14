<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // frontend, backend, database, tools
            $table->unsignedTinyInteger('level')->default(80); // 0-100
            $table->string('icon')->nullable();
            $table->unsignedSmallInteger('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['category', 'is_active', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};
