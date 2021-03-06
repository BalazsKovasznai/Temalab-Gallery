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
        Schema::create('comments3', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('username');
            $table->foreignId('photo_id')->constrained('photos')->cascadeOnDelete();
            $table->bigInteger('owner_userid');
            $table->text('comment');
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
        Schema::dropIfExists('comments3');
    }
};
