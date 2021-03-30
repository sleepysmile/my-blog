<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('website');
            $table->text('message');
            $table->integer('created_by')
                ->nullable(true)
                ->comment('Кто создал запись');
            $table->integer('updated_by')
                ->nullable(true)
                ->comment('Кто обновил запись');
            $table->string('owner_name')
                ->comment('Класс владельца');
            $table->integer('owner_id')
                ->comment('ID владельца');
            $table->timestamps();

            // indexes
            $table->index(['owner_name', 'owner_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
