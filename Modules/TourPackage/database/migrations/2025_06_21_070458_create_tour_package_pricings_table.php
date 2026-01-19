<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tour_package_pricings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_package_id')->constrained()->onDelete('cascade');
            $table->string('group_size');
            $table->decimal('price', 12, 2);
            $table->string('variant')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour_package_pricings');
    }
};
