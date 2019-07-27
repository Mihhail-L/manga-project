<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volumes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('manga_id');
            $table->foreign('manga_id')->references('id')->on('mangas')->onDelete('cascade');
            $table->string('volume');
            $table->string('image')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->default(0);
            $table->integer('stock')->default(0);
            $table->integer('total_sold')->default(0);
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('volumes');
    }
}
