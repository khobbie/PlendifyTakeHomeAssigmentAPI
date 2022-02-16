<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function addProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => '422',
                'message' => 'Validation Error(s)',
                'data' => $validator->errors()
            ], 422);
        }

        // $gpsName = $request->address;

        try {


            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;

            if ($product->save()) {

                return response()->json([
                    'code' => '000',
                    'message' => 'Product created successfully !',
                    'data' => NULL
                ], 201);
            } else {

                return response()->json([
                    'code' => '500',
                    'message' => 'Failed to add product !',
                    'data' => NULL
                ], 200);
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }

    public function updateProduct(Request $request, $product_id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => '422',
                'message' => 'Validation Error(s)',
                'data' => $validator->errors()
            ], 422);
        }

        // $gpsName = $request->address;

        try {

            $product = Product::find($product_id);


            if (is_null($product)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found ',
                    'data' => NULL
                ], 404);
            }


            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;

            if ($product->save()) {

                return response()->json([
                    'code' => '000',
                    'message' => 'Product updated successfully !',
                    'data' => NULL
                ], 200);
            } else {

                return response()->json([
                    'code' => '500',
                    'message' => 'Failed to update product !',
                    'data' => NULL
                ], 200);
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }

    public function deleteProduct(Request $request, $product_id)
    {

        try {

            $product = Product::find($product_id);

            if (is_null($product)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found ',
                    'data' => NULL
                ], 404);
            }


            if ($product->delete()) {

                return response()->json([
                    'code' => '000',
                    'message' => 'Product deleted successfully !',
                    'data' => NULL
                ], 200);
            } else {

                return response()->json([
                    'code' => '500',
                    'message' => 'Failed to delete product !',
                    'data' => NULL
                ], 200);
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }

    public function getSingleProduct(Request $request, $product_id)
    {
        try {

            $product = Product::find($product_id);

            if (is_null($product)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found !',
                    'data' => NULL
                ], 404);
            } else {
                return response()->json([
                    'code' => '000',
                    'message' => 'Product found !',
                    'data' => $product
                ], 201);
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }

    public function getListOfProduct(Request $request)
    {
        try {

            $order = $request->query('order');
            if ($order == 'ASC') {
                $product = Product::orderBy('id', 'ASC')->paginate(10);
            } else {
                $product = Product::orderBy('id', 'DESC')->paginate(10);
            }



            if (is_null($product)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found !',
                    'data' => NULL
                ], 404);
            } else {
                return response()->json([
                    'code' => '000',
                    'message' => 'Product found !',
                    'data' => $product
                ], 201);
            }
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'message' => $e->getMessage(),
                'data' => NULL
            ], 500);
        }
    }
}