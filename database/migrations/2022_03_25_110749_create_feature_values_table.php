<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeatureValuesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_values', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('feature_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('feature_id')->references('id')->on('features');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feature_values');
    }
}
