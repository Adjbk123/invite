<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ——— Champs événement dans parametres ———
        Schema::table('parametres', function (Blueprint $table) {
            $table->string('event_edition', 100)->nullable()->after('photo');   // ex : "2ème édition"
            $table->date('event_date')->nullable()->after('event_edition');     // ex : 2026-04-23
            $table->string('event_heure', 50)->nullable()->after('event_date'); // ex : "15h00"
            $table->string('event_lieu', 255)->nullable()->after('event_heure');// ex : "Porto-Novo"
        });

        // ——— Numéro de table dans invites ———
        Schema::table('invites', function (Blueprint $table) {
            $table->string('numero_table', 20)->nullable()->after('statut_modifie'); // ex : "Table 05"
        });
    }

    public function down(): void
    {
        Schema::table('parametres', function (Blueprint $table) {
            $table->dropColumn(['event_edition', 'event_date', 'event_heure', 'event_lieu']);
        });

        Schema::table('invites', function (Blueprint $table) {
            $table->dropColumn('numero_table');
        });
    }
};
