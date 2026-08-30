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
        Schema::table('orders', function (Blueprint $table) {

            $table->string('order_number')
                ->unique()
                ->after('user_id');

            $table->string('customer_name')
                ->after('order_number');

            $table->string('customer_email')
                ->after('customer_name');

            $table->string('customer_phone')
                ->after('customer_email');

            $table->text('delivery_address')
                ->after('customer_phone');

            $table->decimal('total_amount', 12, 2)
                ->default(0)
                ->after('delivery_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->dropUnique([
                'order_number'
            ]);

            $table->dropColumn([
                'order_number',
                'customer_name',
                'customer_email',
                'customer_phone',
                'delivery_address',
                'total_amount',
            ]);
        });
    }
};