<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('id');
            $table->string('avatar')->nullable()->after('email');
            $table->enum('role', ['user', 'petugas'])->default('user')->after('avatar');
            $table->foreignId('assigned_loket_id')->nullable()->after('role')
                  ->constrained('lokets')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['assigned_loket_id']);
            $table->dropColumn(['google_id', 'avatar', 'role', 'assigned_loket_id']);
        });
    }
};