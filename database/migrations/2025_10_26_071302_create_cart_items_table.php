<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');
            $table
                ->foreignId('product_id')
                ->constrained('products')
                ->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->timestamp('added_at')->useCurrent();
            $table->timestamps();

            $table->unique(['user_id', 'product_id']); // each product only once per user’s cart
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
