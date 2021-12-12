<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListhomestayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listhomestay', function (Blueprint $table) {
            $table->id();
            $table->string('gambar_seo');
            $table->string('nama');
            $table->string('lokasi');
            $table->integer('harga');
            $table->date('tgl_terbit');
            $table->timestamps();
            $table->string('foto');
            $table->integer('like');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listhomestay');
    }
}
