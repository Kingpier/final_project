<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToysTable extends Migration
{
    public function up()
    {
        Schema::create('toys', function (Blueprint $table) {
            $table->uuid('toy_id')->primary();
            $table->uuid('category_id');
            $table->string('image');
            $table->string('name');
            $table->text('description');
            $table->integer('stock');
            $table->integer('price'); // Tambahkan kolom price
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('toys');
    }
}
