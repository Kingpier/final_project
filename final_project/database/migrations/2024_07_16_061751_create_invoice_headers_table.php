<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceHeadersTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->uuid('invoice_header_id')->primary();
            $table->uuid('user_id');
            $table->integer('total_price');
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_headers');
    }
}
