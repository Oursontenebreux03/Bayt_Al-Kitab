<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->string('publisher')->nullable();
            $table->text('description')->nullable();
            $table->string('summary', 512)->nullable();
            $table->string('target_audience')->nullable();
            $table->string('highlights')->nullable();
            $table->string('features')->nullable();
            $table->integer('pages')->nullable();
            $table->string('format')->nullable();
            $table->string('isbn')->nullable();
            $table->decimal('price', 8, 2);
            $table->integer('stock')->default(0);
            $table->json('images')->nullable(); // tableau d'urls
            $table->string('excerpt_pdf')->nullable();
            $table->string('language')->default('fr');
            $table->boolean('is_new')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('is_on_sale')->default(false);
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->string('audience')->nullable(); // enfants/adultes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
