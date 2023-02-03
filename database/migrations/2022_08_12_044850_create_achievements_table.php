<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('header');
            $table->string('student_name')->nullable();
            $table->string('exam_roll_no')->nullable();
            $table->string('faculty')->nullable();
            $table->string('level')->nullable();
            $table->string('year_of_completion')->nullable();
            $table->string('CGPA')->nullable();
            $table->string('image')->nullable();
            $table->string('semester')->nullable();
            $table->string('year')->nullable();
            $table->string('Achievement')->nullable();
            $table->string('genere')->nullable();
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
        Schema::dropIfExists('achievements');
    }
}
