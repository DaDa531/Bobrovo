<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->text('description');

            $table->unsignedInteger('group_id');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedInteger('teacher_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->timestamp('available_from')->useCurrent();
            $table->timestamp('available_to')->useCurrent();

            $table->integer('time_to_do');

            $table->boolean('available_description');
            $table->boolean('mix_questions');
            $table->boolean('available_answers');
            $table->boolean('public');

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
        Schema::dropIfExists('tests');
    }
}
