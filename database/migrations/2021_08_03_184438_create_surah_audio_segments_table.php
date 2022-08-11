<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurahAudioSegmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surah_audio_segments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ayah_id')->nullable()->constrained('ayah')->onUpdate('set null')->onDelete('set null');
            $table->foreignId('surah_audio_id')->nullable()->constrained('surah_audio')->onUpdate('set null')->onDelete('set null');
            $table->float('start_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surah_audio_segments');
    }
}
