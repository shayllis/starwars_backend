<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistics extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Site available categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // Terms
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('device_id')->nullable()->constrained();
            $table->string('term');
            $table->index('term');
            $table->timestamps();
        });

        // Item visited
        Schema::create('visiteds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->nullable()->constrained();
            $table->foreignId('category_id')->constrained();
            $table->string('item');
            $table->index('item');
            $table->timestamps();
        });

        // Most searched terms
        Schema::create('most_requesteds', function (Blueprint $table) {
            $table->id();
            $table->string('term');
            $table->integer('views');
            $table->timestamps();
        });

        // Most visited items
        Schema::create('most_visiteds', function (Blueprint $table) {
            $table->id();
            $table->string('item');
            $table->integer('views')->defualt(0);
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
        Schema::dropIfExists('most_visiteds');
        Schema::dropIfExists('most_requesteds');
        Schema::dropIfExists('visiteds');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('terms');
    }
}
