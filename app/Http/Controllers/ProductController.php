<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(20);
        return $this->sendResponse($products, 'Products fetched successfully', Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:products',
                'price' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
            }

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            return $this->sendResponse($product, 'Product created successfully', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->sendError('Error creating product', Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:products,name,'.$id.',id',
                'price' => 'required|numeric|min:0',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', Response::HTTP_UNPROCESSABLE_ENTITY, $validator->errors());
            }

            $product = Product::find($id);

            if(!$product) {
                return $this->sendError('Product not found', Response::HTTP_NOT_FOUND);
            }
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
            ]);

            return $this->sendResponse($product, 'Product updated successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError('Error updating product', Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::find($id);

            if(!$product) {
                return $this->sendError('Product not found', Response::HTTP_NOT_FOUND);
            }

            $product->delete();

            return $this->sendResponse($product, 'Product deleted successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError('Error deleting product', Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

    /**
     * Retrieve a specific product by ID
     *
     * @param int $id The ID of the product to fetch
     * @return \Illuminate\Http\JsonResponse Product details or error message
     */
    public function show($id)
    {
        try {
            $product = Product::find($id);

            if(!$product) {
                return $this->sendError('Product not found', Response::HTTP_NOT_FOUND);
            }

            return $this->sendResponse($product, 'Product fetched successfully', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->sendError('Error fetching product', Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }
    }

}
