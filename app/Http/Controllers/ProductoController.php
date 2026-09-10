<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use OpenApi\Attributes as OA;

class ProductoController extends Controller
{

        #[OA\Get(
        path: "/api/products",
        summary: "Listar productos del usuario autenticado",
        tags: ["Products"],
        security: [["bearerAuth" => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: "Catálogo exitoso",
                content: new OA\JsonContent(
                    type: "array",
                    items: new OA\Items(ref: "#/components/schemas/Product")
                )
            ),
            new OA\Response(response: 401, description: "No Autenticado")
        ]
    )]

    public function index()
    {
        return ProductResource::collection(Product::with('category')->paginate(10));
    }

      #[OA\Post(
        path: "/api/products",
        summary: "Crea un nuevo producto",
        tags: ["Products"],
        security: [["bearerAuth" => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["name", "price", "category_id"],
                properties: [
                    new OA\Property(property: "name", type: "string", example: "Iphone 18 Ultra"),
                    new OA\Property(property: "price", type: "numeric", example: 119.95),
                    new OA\Property(property: "stock", type: "integer", example: 15),
                    new OA\Property(property: "category_id", type: "integer", example: 3),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Producto creado exitosamente",
                content: new OA\JsonContent(ref: "#/components/schemas/Product")
            ),
            new OA\Response(response: 422, description: "Error de validación"),
            new OA\Response(response: 401, description: "Error de autenticación")
        ]
    )]
    public function store(StoreProductRequest $request, ProductService $service)
    {
        //$product = Product::create($request->validated());
        $product = $service->createProduct($request->validated());

        return (new ProductResource($product->load('category')))
        ->response()->setStatusCode(201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product->load('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
