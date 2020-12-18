<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary');
            $table->longText('description')->nullable();
            $table->float('price');
            $table->float('discount');
            $table->float('actual_price');
            $table->string('image')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->string('brand')->nullable();
            $table->enum('status',['active','inactive','out_of_stock'])->default('inactive');
            $table->foreignId('cat_id')->nullable()->constrained('categories','id')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreignId('sub_cat_id')->nullable()->constrained('categories','id')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreignId('seller_id')->nullable()->constrained('users','id')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreignId('added_by')->nullable()->constrained('users','id')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
