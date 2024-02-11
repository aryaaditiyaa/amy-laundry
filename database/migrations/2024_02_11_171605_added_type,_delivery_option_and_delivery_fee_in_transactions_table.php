<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->after('status', function (Blueprint $table) {
                $table->enum('delivery_option', ['deliver_only', 'pickup_only', 'deliver_and_pickup'])->nullable();
                $table->integer('delivery_fee')->default(0)->nullable();
                $table->enum('type', ['express', 'non_express'])->default('non_express');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('delivery_option');
            $table->dropColumn('delivery_fee');
            $table->dropColumn('type');
        });
    }
};
