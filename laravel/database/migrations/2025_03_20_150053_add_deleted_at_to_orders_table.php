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
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('customer', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('cart', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('order', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('payment', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('order_product', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
        Schema::table('whistlist', function (Blueprint $table) {
            //
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('products', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('customer', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('cart', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('order', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('payment', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('order_product', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
        Schema::table('whistlist', function (Blueprint $table) {
            //
            $table->dropSoftDeletes();
        });
    }
};
