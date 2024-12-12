<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Barros Luco
            $table->text('description')->nullable(); // Descripción del sándwich
            $table->decimal('price', 8, 2); // Precio base, ejemplo: 5000.00
            $table->string('image')->nullable(); // Ruta a la imagen, p.ej. "img/barrosluco.jpg"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

