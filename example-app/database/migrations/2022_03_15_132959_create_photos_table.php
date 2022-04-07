<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();

            $table->string('photo');
            $table->string('title');
            $table->string('size');
            $table->string('description');

            $table->timestamps();
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->foreignId('album_id')->constrained('albums')->default(0)->nullable();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
};
