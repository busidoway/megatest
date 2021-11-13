<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTestItemRelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_test_item_rels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id');
            $table->foreign('test_id')->references('id')->on('tests');
            $table->foreignId('test_item_id');
            $table->foreign('test_item_id')->references('id')->on('test_items');
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
        Schema::dropIfExists('test_test_item_rels');
    }
}
