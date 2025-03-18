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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('method', ['transfer', 'mercadopago', 'webpay', 'paypal']);
            $table->string('transaction_id')->nullable();
            $table->enum('status', ['pending', 'failed', 'successful'])->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->integer('retry_count')->default(0);
            $table->timestamps();
        });  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
