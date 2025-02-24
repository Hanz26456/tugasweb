<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('author');
        $table->string('publisher');
        $table->year('year');
        $table->string('isbn')->unique();
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->string('location');
        $table->integer('quantity');
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
