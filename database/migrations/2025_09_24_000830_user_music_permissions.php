<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->dropColumn('last_fm_username');
            $table->dropColumn('can_last_fm');
            $table->dropColumn('can_spotify');
            $table->dropColumn('can_deezer');
        });
    }

    public function up(): void
    {
        Schema::table('users', function (Blueprint $table): void {
            $table->string('last_fm_username')->nullable();
            $table->boolean('can_last_fm')->default(false);
            $table->boolean('can_spotify')->default(false);
            $table->boolean('can_deezer')->default(false);
        });
    }
};
