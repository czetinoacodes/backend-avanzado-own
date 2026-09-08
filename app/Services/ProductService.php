<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService
{
    public function __construct(
        private ProductRepositoryInterface $repository
        ) { }

    public function createProduct(array $data)
    {
        //regla de negocio: productos con price > $100 se marcan como destacados
        $data['is_featured'] = ($data['price'] ?? 0) > 100;
        //if ($data['price']>100)
        //    $data['is_featured'] = true;

        return $this->repository->create($data);
    }
}