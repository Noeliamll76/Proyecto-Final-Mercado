<?php

// declare(strict_types=1);

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

            $imageProduct = Image_product::query()
                ->where("name_product", $name)
                ->where("variety", $variety)
                ->first();
            if ($imageProduct) {
                $image_id = $imageProduct->id;
            } else {
                $image_id = "1";
            } // El campo 1 se reserva para los productos sin imagen

            if (!$category = Category::query()->find($category_id)) {
                throw new Error('Incorrect category');
            }

            if ($category->guild_id !== $store->guild_id) {
                throw new Error('Incorrect category');
            }

            $newProduct = Product::create(
                [
                    "category_id" => $category_id,
                    "store_id" => $store_id,
                    "name" => $name,
                    "variety" => $variety,
                    "origin" => $origin,
                    "price" => $price,
                    "image_id" => $image_id
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
            if ($th->getMessage() === 'Incorrect category') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect category"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering product",

                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function productProfile(Request $request, $id)
    {
        try {
            $email = auth()->user()->email;
            $role=auth()->user()->roles;
            $store = Store::query()->where('email', $email)->first();

            $product = Product::query()->where('id', $id)->first();

            if ($role === 'admin') {
                if ($product->store_id !== $store->id) {
                    throw new Error('Incorrect');
                }
            }
            return response()->json(
                [
                    "success" => true,
                    "message" => "Get product successfully",
                    "data" => $product
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Incorrect') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "This product does not belong to you"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting product"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function allProductsByStore(Request $request, $id)
    {
        try {
            $product = Product::query()->where('store_id', $id)->get();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Get products successfully",
                    "data" => $product
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Incorrect') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Store incorrect"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting products"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function productUpdate(Request $request, $id)
    {
        try {
            $email = auth()->user()->email;
            $store = Store::query()->where('email', $email)->first();
            $product = Product::query()->where('id', $id)->first();

            if (!$store) {
                throw new Error('invalid');
            }
            if ($product->store_id !== $store->id) {
                throw new Error('invalid');
            }

            $category_id = $request->input('category_id');
            $name = $request->input('name');
            $variety = $request->input('variety');
            $price = $request->input('price');
            $origin = $request->input('origin');

            if ($request->has('category_id')) {
                if (!$category = Category::query()->find($category_id)) {
                    throw new Error('invalid');
                }
                if ($category->guild_id !== $store->guild_id) {
                    throw new Error('invalid');
                }
                $product->category_id = $category_id;
            }
            if ($request->has('name')) {
                if (strlen($name) > 3 && strlen($name) < 100) {
                    $product->name = $name;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('variety')) {
                if (strlen($variety) > 3 && strlen($variety) < 100) {
                    $product->variety = $variety;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('origin')) {
                if (strlen($origin) > 3 && strlen($origin) < 100) {
                    $product->origin = $origin;
                } else {
                    throw new Error('invalid');
                }
            }

            if ($request->has('price')) {
                $product->price = $price;
            }

            $imageProduct = Image_product::query()
                ->where("name_product", $name)
                ->where("variety", $variety)
                ->first();
            if ($imageProduct) {
                $image_id = $imageProduct->id;
            } else {
                $image_id = "1";
            } // El campo 1 se reserva para los productos sin imagen
            $product->image_id = $image_id;

            $product->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Product updated",
                    "data" => $product
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect data"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering product",
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function productDelete(Request $request, $id)
    {
        try {
            $email = auth()->user()->email;
            $store = Store::query()->where('email', $email)->first();
            $product = Product::query()->find($id);

            if (!$product) {
                throw new Error('Invalid');
            };

            if (!$store || $store->id != $product->store_id) {
                throw new Error('Invalid');
            };

            $product->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Product delete"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect date"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error delete category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
