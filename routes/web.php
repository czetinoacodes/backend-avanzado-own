<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/reporte-cat-stock', function(){
return[
    'categorias_con_stock' => Category::with(['products' => fn($q) => $q->inStock()])->get(),
];
});


Route::get('/products-by-category', function(){
return[                     //funcion en mo
    'reporte' => Product::productsByCategory(),
];
});
