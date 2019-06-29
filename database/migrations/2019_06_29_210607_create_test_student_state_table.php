<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestStudentStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_student_state', function (Blueprint $table) {
            $table->unsignedInteger('test_id')->index();
            $table->foreign('test_id')->references('id')->on('tests')->onDelete('cascade');

            $table->unsignedInteger('student_id')->index();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('state')->default(1);
            $table->timestamp('started_at')->nullable()->default(null);
            $table->timestamp('finished_at')->nullable()->default(null);

            $table->primary(['test_id', 'student_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_student_state');
    }
}
