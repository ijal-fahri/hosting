<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('origin');
            $table->string('destination');
            $table->string('courier');
            $table->string('service');
            $table->integer('weight');
            $table->decimal('total_price', 10, 2);
            $table->text('masukan')->nullable();
            $table->text('alamat');
            $table->string('payment_photo')->nullable();
            $table->enum('status', ['Pending', 'Processed', 'Delivery', 'Completed', 'Cancelled'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};