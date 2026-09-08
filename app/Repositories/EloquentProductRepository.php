<?php

namespace App\Repositories;

use App\Models\Product;

class EloquentProductRepository implements ProductRepositoryInterface
{
    public function all()
    {
        return Product::with('category')->paginate(10);
    }

    public function find(int $id): Product
    {
        return Product::with('category')->findOrFail($id);
    }
    
    public function create(array $data): Product
    {
        return Product::create($data);

    }


}
