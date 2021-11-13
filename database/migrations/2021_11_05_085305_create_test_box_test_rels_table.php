<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestBoxTestRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_box_test_rels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_box_id');
            $table->foreign('test_box_id')->references('id')->on('test_boxes');
            $table->foreignId('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
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
        Schema::dropIfExists('test_box_test_rels');
    }
}
