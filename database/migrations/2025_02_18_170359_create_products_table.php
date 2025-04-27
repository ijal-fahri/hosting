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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // nama produk
            $table->text('description'); // keterangan
            $table->bigInteger('code')->unique(); // kode produk
            $table->decimal('price', 10, 2); // harga
            $table->integer('stock'); // stok
            $table->string('photo')->nullable(); // foto (path file gambar)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif'); // status
            $table->integer('diskon')->default(0); // Diskon dalam persen
            $table->decimal('harga_diskon', 10, 2)->nullable(); // Harga setelah diskon
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
