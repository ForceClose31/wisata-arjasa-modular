<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportationsTable extends Migration
{
    public function up()
    {
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->json('description');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->json('duration');
            $table->json('facilities')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transportations');
    }
}
