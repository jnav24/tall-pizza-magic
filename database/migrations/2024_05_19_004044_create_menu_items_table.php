<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->decimal('price');
            $table->string('name');
            $table->string('ingredients');
            $table->string('description');
            $table->string('img_url');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
