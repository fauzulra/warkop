<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name', 100);
        $table->string('category', 50);
        $table->integer('price');
        $table->boolean('is_active')->default(true);
        $table->text('description')->nullable();
        $table->string('image');
        $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
};