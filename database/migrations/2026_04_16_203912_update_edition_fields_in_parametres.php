<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('parametres', function (Blueprint $table) {
            $table->string('event_edition_ancienne', 100)->nullable()->after('event_edition');
            $table->string('event_edition_nouvelle', 100)->nullable()->after('event_edition_ancienne');
        });
    }

    public function down(): void
    {
        Schema::table('parametres', function (Blueprint $table) {
            $table->dropColumn(['event_edition_ancienne', 'event_edition_nouvelle']);
        });
    }
};
