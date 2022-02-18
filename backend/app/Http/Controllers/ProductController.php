<?php

namespace App\Http\Controllers;

use App\Models\CurrencySetupModel;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

    public function check_for_requested_currency($request, $product)
    {


        if ($request->query('currency')) {

            $currency = $request->query('currency');
            $db_rates = CurrencySetupModel::find(1);
            $currency_in_db = json_decode($db_rates);

            $rates = json_decode($currency_in_db->currency_rates);
            // return $rates->$currency;
            $rate = $rates->$currency;

            $product->requested_currency = $currency;
            $product->converted_price = $product->price * $rate;
        } else {
            $product->requested_currency = env("BASE_CURRENCY");
            $product->converted_price = 0.0;
        }



        return $product;
    }

    public function getSingleProduct(Request $request, $product_id)
    {
        try {



            $product = Product::find($product_id);


            if (!is_null($product)) {

                $transform_product = $this->check_for_requested_currency($request, $product);

                return response()->json([
                    'code' => '000',
                    'message' => 'Product found !',
                    'data' => [$product]
                ], 200);
            } else {


                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found !',
                    'data' => NULL
                ], 404);
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
                $products = Product::orderBy('id', 'ASC')->get();
            } else {
                $products = Product::orderBy('id', 'DESC')->get();
            }

            // return $products;



            if (is_null($products)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found !',
                    'data' => NULL
                ], 404);
            } else {

                foreach ($products as $product) {
                    $this->check_for_requested_currency($request, $product);
                }

                return response()->json([
                    'code' => '000',
                    'message' => 'Product found !',
                    'data' => $products
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

    public function searchProduct(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [
            'search_text' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => '422',
                'message' => 'Validation Error(s)',
                'data' => $validator->errors()
            ], 422);
        }


        try {



            $search_text = $request->search_text;


            // return $products;



            $products = Product::query()
                ->where('name', 'LIKE', "%{$search_text}%")
                ->orWhere('description', 'LIKE', "%{$search_text}%")
                ->orWhere('description', 'LIKE', "%{$search_text}%")
                ->get();


            if (is_null($products)) {
                return response()->json([
                    'code' => '404',
                    'message' => 'Product not found !',
                    'data' => NULL
                ], 404);
            } else {

                foreach ($products as $product) {
                    $this->check_for_requested_currency($request, $product);
                }

                return response()->json([
                    'code' => '000',
                    'message' => 'Product found !',
                    'data' => $products
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
}