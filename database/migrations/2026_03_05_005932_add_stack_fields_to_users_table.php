<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stack_backend')->nullable()->after('twitter_url');
            $table->string('stack_frontend')->nullable()->after('stack_backend');
            $table->string('stack_database')->nullable()->after('stack_frontend');
            $table->string('stack_devops')->nullable()->after('stack_database');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'stack_backend',
                'stack_frontend',
                'stack_database',
                'stack_devops'
            ]);
        });
    }
};
