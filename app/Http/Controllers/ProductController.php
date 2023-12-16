<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Store;
use App\Models\Category;
use App\Models\Image_product;
use Symfony\Component\HttpFoundation\Response;
use Error;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    private function validateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required|min:3|max:100',
            'variety' => 'required|min:3|max:100',
            'origin' => 'required|min:3|max:100',
            'price' => 'required',
        ]);
        return $validator;
    }

    public function productRegister(Request $request)
    {
        try {
            $email = auth()->user()->email;
            $store = Store::query()->where('email', $email)->first();
            if (!$store) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Store not found",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $validator = $this->validateProduct($request);
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering product",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $category_id = $request->input('category_id');
            $store_id = $store->id;
            $name = $request->input('name');
            $variety = $request->input('variety');
            $origin = $request->input('origin');
            $price = $request->input('price');
$image="no hay imagen";
            // $imageProduct = Image_product::query()
            //     ->where("name_product", $name)
            //     ->where("variety", $variety)
            //     ->firstOrFail();
            // if (!$imageProduct) {
            //     return response()->json(
            //         [
            //             "success" => false,
            //             "message" => "No existe imagen para este producto",
            //         ],
            //         Response::HTTP_NOT_FOUND
            //     );
            // }
            // $image = $imageProduct->image;


            if (!$category = Category::query()->find($category_id)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "No existe esta categoria",
                    ],
                    Response::HTTP_I_AM_A_TEAPOT
                );
            }

            $newProduct = Product::create(
                [
                    "category_id" => $category_id,
                    "store_id" => $store_id,
                    "name" => $name,
                    "variety" => $variety,
                    "origin" => $origin,
                    "price" => $price,
                    "image" => $image,
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Product registered",
                    "data" => $newProduct
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering product",
                  
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
