<?php

use App\Models\User;
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
            $table->string('transaction_code')->unique();
            $table->string('consumer_name');
            $table->boolean('user_has_account')->default(false);
            $table->foreignIdFor(User::class)->nullable()->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('payment_method', ['qris', 'cash']);
            $table->enum('status', ['paid', 'unpaid', 'rejected', 'done'])->default('unpaid');
            $table->string('receipt')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('total_amount', 10, 2);
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
