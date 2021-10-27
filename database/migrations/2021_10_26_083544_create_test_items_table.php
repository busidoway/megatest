<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('test_items', function (Blueprint $table) {
        //     $table->id();
        //     // $table->integer('test_id')->unsigned();
        //     // $table->foreign('test_id')->references('id')->on('tests');
        //     $table->text('text');
        //     $table->enum('status', ['y','n'])->default('n');
        // });

        Schema::table('test_items', function (Blueprint $table) {
            $table->foreignId('id_test');
            $table->foreign('id_test')->references('id')->on('tests');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_items');
    }
}
