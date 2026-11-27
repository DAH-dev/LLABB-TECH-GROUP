<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('lien_facebook')->nullable();
            $table->string('lien_telegram')->nullable();
            $table->string('lien_instagram')->nullable();
            $table->dropColumn('lien_twitter');
        });
    }

    public function down(): void
    {
        Schema::table('team_members', function (Blueprint $table) {
            $table->string('lien_twitter')->nullable();
            $table->dropColumn(['lien_facebook', 'lien_telegram', 'lien_instagram']);
        });
    }
};