<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('registryid');
            $table->integer('mother_id')->unsigned()->nullable();
            $table->integer('father_id')->unsigned()->nullable();
            $table->integer('breed_id')->unsigned();
            $table->boolean('members')->default(false);
        });

        Schema::table('groupings', function($table) {
            $table->foreign('breed_id')->references('id')->on('breeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groupings');
    }
}
