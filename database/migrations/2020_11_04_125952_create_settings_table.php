<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('setting_name')->unique();
            $table->string('setting_value');
            $table->enum('setting_type',['json','string']);
            $table->timestamps();

        });
    }


    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
