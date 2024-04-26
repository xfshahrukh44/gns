<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('jobs')) {
            Schema::create('jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('title')->nullable();
                $table->string('location')->nullable();
                $table->longText('description')->nullable();
                });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('jobs');
    }
}
