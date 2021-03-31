<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationsToTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications_to_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('publication_id')
                ->nullable(false)
                ->comment('Ссылка на таблицу публикаций');
            $table->unsignedBigInteger('tag_id')
                ->nullable(false)
                ->comment('Ссылка на таблицу тегов');

            $table->foreign('publication_id')
                ->references('id')
                ->on('publication')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('publications_to_tags', function (Blueprint $table) {
            $table->dropForeign('publications_to_tags_tag_id_foreign');
            $table->dropForeign('publications_to_tags_publication_id_foreign');
        });
        Schema::dropIfExists('publications_to_tags');
    }
}
