<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->string('description', 300);
            $table->string('resolution', 100);
            $table->string('name_eng', 200);
            $table->string('subtitle', 100);
            $table->string('year_release', 50);
            $table->string('trailer', 300);
            $table->string('duration', 200);
            $table->integer('id_category');
            $table->integer('id_genre');
            $table->integer('id_country');
            $table->string('image', 300);
            $table->integer('status');
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
        Schema::dropIfExists('movies');
    }
};
