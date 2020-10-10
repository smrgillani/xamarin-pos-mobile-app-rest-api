<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id')->unsigned()->comment('Foregion Key');
            $table->string('name');
            $table->string('type');
            $table->integer('seats');
            $table->integer('free_tables');
            $table->string('reservation_time'); 
            $table->tinyInteger('status');
            $table->foreign('profile_id')->references('id')->on('profiles');   
            $table->softDeletes();
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
        Schema::dropIfExists('tables');
    }
}
