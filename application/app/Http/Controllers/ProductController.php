<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\Request;


class ProductController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/products",
     *      operationId="getProductsList",
     *      tags={"Products"},
     *      summary="Get list of products",
     *      description="Returns a list of products",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="products",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="integer", example=1),
     *                      @OA\Property(property="product_id", type="number", example="1235673"),
     *                      @OA\Property(property="name", type="string", example="O rally"),
     *                      @OA\Property(property="price", type="number", example="1212"),
     *                      @OA\Property(property="description", type="string", example="Description"),
     *                      @OA\Property(property="category", type="string", example="Jeans"),
     *                      @OA\Property(property="brand", type="string", example="Levis")
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal server Error",
     *          @OA\JsonContent(
     *              @OA\Property(property="status", type="string", example="Fail."),
     *              @OA\Property(property="message", type="string", example="Internal server error.")
     *          )
     *      )
     * )
     */

    public function index()
    {
        return response()->json(['products' => Product::all()], 200);
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      operationId="addProduct",
     *      tags={"Products"},
     *      summary="Add a new product",
     *      description="Adds a new product to the system",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Product data",
     *          @OA\JsonContent(
     *              required={"name", "price", "description", "category", "brand"},
     *              @OA\Property(property="name", type="string", example="New Product"),
     *              @OA\Property(property="price", type="number", format="float", example=99.99),
     *              @OA\Property(property="description", type="string", example="Description of the new product"),
     *              @OA\Property(property="category", type="string", example="Category of the new product"),
     *              @OA\Property(property="brand", type="string", example="Brand of the new product")
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Product created successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="New Product"),
     *              @OA\Property(property="price", type="number", format="float", example=99.99),
     *              @OA\Property(property="description", type="string", example="Description of the new product"),
     *              @OA\Property(property="category", type="string", example="Category of the new product"),
     *              @OA\Property(property="brand", type="string", example="Brand of the new product")
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Invalid input data")
     *          )
     *      )
     * )
     */


    public function store(Request $request)
    {
        try {
            $request->validate([
                'product_id' => 'required|numeric',
                'name' => 'required|string',
                'price' => 'required|numeric',
            ]);
            $product = Product::create($request->all());
            return response()->json(['product' => $product, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            info($e);
            return response()->json(['status' => 'fail', 'message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/products/{id}",
     *      operationId="getProductById",
     *      tags={"Products"},
     *      summary="Get a single product by ID",
     *      description="Returns a single product based on the provided ID",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product to retrieve",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Product Name"),
     *              @OA\Property(property="price", type="number", format="float", example=99.99),
     *              @OA\Property(property="description", type="string", example="Product description"),
     *              @OA\Property(property="category", type="string", example="Product category"),
     *              @OA\Property(property="brand", type="string", example="Product brand")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Product not found")
     *          )
     *      )
     * )
     */

    public function show(Product $product)
    {
        try {
            return response()->json(['product' => $product, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            info($e);
            return response()->json(['status' => 'fail', 'message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Patch(
     *      path="/api/products/{id}",
     *      operationId="updateProduct",
     *      tags={"Products"},
     *      summary="Update an existing product",
     *      description="Updates an existing product in the system",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product to update",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Updated product data",
     *          @OA\JsonContent(
     *              required={"name", "price", "description", "category", "brand"},
     *              @OA\Property(property="name", type="string", example="Updated Product"),
     *              @OA\Property(property="price", type="number", format="float", example=99.99),
     *              @OA\Property(property="description", type="string", example="Updated description of the product"),
     *              @OA\Property(property="category", type="string", example="Updated category of the product"),
     *              @OA\Property(property="brand", type="string", example="Updated brand of the product")
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Product updated successfully",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Updated Product"),
     *              @OA\Property(property="price", type="number", format="float", example=99.99),
     *              @OA\Property(property="description", type="string", example="Updated description of the product"),
     *              @OA\Property(property="category", type="string", example="Updated category of the product"),
     *              @OA\Property(property="brand", type="string", example="Updated brand of the product")
     *          )
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Product not found")
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Invalid input data")
     *          )
     *      )
     * )
     */


    public function update(Request $request, Product $product)
    {
        try {
            $product = $product->update($request->all());
            return response()->json(['product' => $product, 'status' => 'success'], 200);
        } catch (\Exception $e) {
            info($e);
            return response()->json(['status' => 'fail', 'message' => 'Internal server error'], 500);
        }
    }

    /**
     * @OA\Delete(
     *      path="/api/products/{id}",
     *      operationId="deleteProduct",
     *      tags={"Products"},
     *      summary="Delete an existing product",
     *      description="Deletes an existing product from the system",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="ID of the product to delete",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Product deleted successfully",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Product not found",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Product not found")
     *          )
     *      )
     * )
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response()->json(['status' => 'success', 'message' => 'Product deleted'], 200);
        } catch (\Exception $e) {
            info($e);
            return response()->json(['status' => 'fail', 'message' => 'Internal server error'], 500);
        }
    }
}
