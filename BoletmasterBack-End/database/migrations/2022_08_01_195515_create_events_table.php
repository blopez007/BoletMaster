<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('descripcion');
            $table->dateTime('fecha_hora');
            $table->string('lugar');
            $table->string('imagen')->nullable();
            $table->timestamps();
            $table->timestamp('archivado')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
};
