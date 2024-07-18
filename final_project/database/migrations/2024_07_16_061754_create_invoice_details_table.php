<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->uuid('invoice_detail_id')->primary();
            $table->uuid('invoice_header_id');
            $table->uuid('toy_id');
            $table->integer('quantity');
            $table->integer('subTotal');
            $table->timestamps();
            $table->foreign('invoice_header_id')->references('invoice_header_id')->on('invoice_headers')->onDelete('cascade');
            $table->foreign('toy_id')->references('toy_id')->on('toys')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
}
