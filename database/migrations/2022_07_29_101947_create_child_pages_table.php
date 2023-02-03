<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parentpage_id');
            $table->string("child_title");
            $table->timestamps();
            $table->foreign('parentpage_id')->references('id')->on('parent_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('child_pages');
    }
}
