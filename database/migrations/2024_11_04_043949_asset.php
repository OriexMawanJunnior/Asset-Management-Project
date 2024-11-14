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
        Schema::create('assets', function(Blueprint $table){
            $table->id();
            $table->string('asset_id')->unique();
            $table->string('name');
            $table->string('merk');
            $table->string('color');
            $table->string('serial_number');
            $table->string('purchase_order_number');
            $table->float('purchase_price', precision:53);
            $table->integer('quantity');
            $table->string('condition');
            $table->enum('status', ['borrowed', 'available', 'other']);
            $table->string('remarks')->nullable();
            $table->string('location');
            $table->text('asset_detail_url');
            $table->string('qr_code_path')->nullable();
            $table->date('date_of_receipt');
            $table->integer('number');
            $table->foreignId('category_id')->references('id')->on('category')->name('assets_category_id_foreign');
            $table->foreignId('subcategory_id')->references('id')->on('subcategory')->name('assets_subcategory_id_foreign');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
