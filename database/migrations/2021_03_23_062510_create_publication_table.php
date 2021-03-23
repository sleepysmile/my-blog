<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publication', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable(false)->comment('Заголовок публикации');
            $table->string('text', 255)->nullable(false)->comment('Текст публикации');
            $table->string('slug', 255)->nullable(false)->comment('Слаг публикации');
            $table->string('image', 255)->nullable(true)->comment('Путь до изображения');
            $table->boolean('published')->nullable(false)->comment('Признак публикации записи');
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
        Schema::dropIfExists('publication');
    }
}
