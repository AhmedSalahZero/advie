<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->json('name')->nullable();
            $table->json('content')->nullable();
            $table->string('slug');
            $table->boolean('dropdown')->nullable();
            $table->boolean('status')->nullable();
            $table->enum('position' , ['header' , 'footer'])->nullable();
            $table->string('sort')->nullable();
            $table->string('image')->nullable();
            $table->string('banner')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
