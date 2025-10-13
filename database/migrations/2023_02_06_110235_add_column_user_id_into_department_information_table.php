<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIdIntoDepartmentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_information', function (Blueprint $table) {
            $table->integer('user_id');
            $table->tinyInteger('type')->default(0);
        });
    }
}
