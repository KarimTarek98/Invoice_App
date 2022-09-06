<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('invoice_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_name', 999);
            $table->string('invoice_number', 50);
            $table->string('created_by', 999);
            $table->foreignId('invoice_id')
            ->nullable()
            ->constrained('invoices')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('invoice_attachments');
    }
};
