<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_catagories', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name')->nullable(); 
            $table->string('image');
            $table->text('caption')->nullable(); 
            $table->integer("child_pages_id")->refrences("id")->on("child_pages");
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
        Schema::dropIfExists('room_catagories');
    }
};
