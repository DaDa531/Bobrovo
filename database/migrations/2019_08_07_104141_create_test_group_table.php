<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_group', function (Blueprint $table) {
            $table->unsignedInteger('test_id');
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');

            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');

            $table->boolean('mix_questions');
            $table->boolean('available_answers');

            $table->timestamp('available_from')->useCurrent();
            $table->timestamp('available_to')->useCurrent();
            $table->integer('time_to_do');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_group');
    }
}
