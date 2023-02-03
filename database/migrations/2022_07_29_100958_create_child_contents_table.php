<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('childpage_id');
            $table->integer('parentpage_id')->nullable();
            $table->text("text")->nullable();
            $table->int("price")->nullable();
            $table->text("bedsize")->nullable();
            $table->int("total_no_of_persons")->nullable();
            $table->text("Thumbnailimg")->nullable();
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
        Schema::dropIfExists('child_contents');
    }
}
