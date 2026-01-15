<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->foreignId('category_id')->constrained('destination_categories');
            $table->json('location');
            $table->json('operational_hours');
            $table->string('image')->nullable();
            $table->json('facilities')->nullable();
            $table->json('type');
            $table->string('slug');
            $table->integer('views_count')->default(0);
            $table->foreignId('admin_id')->constrained('admins');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('destinations');
    }
};
