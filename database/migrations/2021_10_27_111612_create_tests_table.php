<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('test_box_id');
            $table->foreign('test_box_id')->references('id')->on('test_boxes');
            $table->string('name');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        // Schema::table('tests', function (Blueprint $table) {
        //     $table->foreignId('test_box_id');
        //     $table->foreign('test_box_id')->references('id')->on('test_boxes');
        // });

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
