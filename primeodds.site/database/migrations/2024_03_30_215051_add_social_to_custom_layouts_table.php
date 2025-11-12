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
        Schema::table('custom_layouts', function (Blueprint $table) {
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('telegram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('whastapp')->nullable();
            $table->string('youtube')->nullable();
            $table->string('Suporte')->nullable();
            $table->string('esportes')->nullable();
            $table->string('apostasaovivo')->nullable();
            $table->string('cassino')->nullable();
            $table->string('cassinoaovivo')->nullable();
            $table->string('ajuda')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('custom_layouts', function (Blueprint $table) {
            $table->dropColumn('instagram');
            $table->dropColumn('facebook');
            $table->dropColumn('telegram');
            $table->dropColumn('twitter');
            $table->dropColumn('whastapp');
            $table->dropColumn('youtube');
            $table->dropColumn('Suporte');
            $table->dropColumn('esportes');
            $table->dropColumn('apostasaovivo');
            $table->dropColumn('cassino');
            $table->dropColumn('cassinoaovivo');
            $table->dropColumn('ajuda');
        });
    }
};
