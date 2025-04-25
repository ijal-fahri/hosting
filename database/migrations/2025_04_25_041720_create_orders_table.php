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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constained()->onDelete('set null');
            $table->string('origin');
            $table->string('destination');
            $table->string('courier');
            $table->string('service');
            $table->integer('weight');
            $table->decimal('total_price', 10, 2);
            $table->text('masukan')->nullable();
            $table->text('alamat');
            $table->string('payment_photo');
            $table->enum('status', ['Pending', 'Processed', 'Delivery', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
