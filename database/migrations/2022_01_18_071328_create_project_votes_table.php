<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->index();
            $table->string('ip');
            $table->timestamps();
        });
    }
}
