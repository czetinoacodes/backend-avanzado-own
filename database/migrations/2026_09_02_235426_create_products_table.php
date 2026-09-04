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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

/*
\App\Models\Product::create(['name'=>'Camisa cuadriculada', 'price'=>15.99, 'stock'=>5, 'category_id'=>1]);                                            
\App\Models\Product::create(['name'=>'Pantalon', 'price'=>39.99, 'stock'=>20, 'category_id'=>1]);        
\App\Models\Product::create(['name'=>'Nike Air', 'price'=>89.99, 'stock'=>15, 'category_id'=>2]);                                                      
\App\Models\Product::create(['name'=>'Converse All Star', 'price'=>69.99, 'stock'=>20, 'category_id'=>2]);                       
\App\Models\Product::create(['name'=>'Buds 4 Pro', 'price'=>229.99, 'stock'=>7, 'category_id'=>3]);
\App\Models\Product::create(['name'=>'Galaxy Watch 8', 'price'=>299.99, 'stock'=>18, 'category_id'=>3]);

DB::table('products')->where('category_id', 1)->get(); 
*/