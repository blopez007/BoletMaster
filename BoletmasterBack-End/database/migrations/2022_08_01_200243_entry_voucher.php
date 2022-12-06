<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('entries_voucher', function (Blueprint $table) {
            $table->unsignedInteger('cantidad_comprada');
            $table->unsignedDouble('precio_total');
            //foreign key to entry table
            $table->unsignedBigInteger('entry_id');
            $table->foreign('entry_id')->references('id')->on('entries')->onDelete('restrict')->onUpdate('cascade');
            //foreign key to voucher table
            $table->unsignedBigInteger('voucher_id');   
            $table->foreign('voucher_id')->references('id')->on('vouchers')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('entries_voucher');
    }
};
