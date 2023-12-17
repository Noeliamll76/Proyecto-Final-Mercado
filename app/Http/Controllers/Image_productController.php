<?php

namespace App\Http\Controllers;

use App\Models\Image_product;
use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Log;
use Error;


class Image_productController extends Controller
{
    private function validateImage_product(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_product' => 'required|min:3|max:100',
            'variety' => 'required|min:3|max:100',
            'image' => 'required|min:3|max:500',
        ]);
        return $validator;
    }

    public function image_productRegister(Request $request)
    {
        try {
            $validator = $this->validateImage_product($request);
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering image_product",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $name_product = $request->input('name_product');
            $variety = $request->input('variety');
            $image = $request->input('image');

            $newImage_product = Image_product::create(
                [
                    "name_product" => $name_product,
                    "variety" => $variety,
                    "image" => $image,
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category registered",
                    "data" => $newImage_product
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function image_productUpdate(Request $request, $id)
    {
        try {
                                    
            if (!$image_product = Image_product::query()->find($id)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "This image doesn't exist",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $name_product = $request->input('name_product');
            $variety = $request->input('variety');
            $image = $request->input('image');

            if ($request->has('name_product')) {
                if (strlen($name_product) > 3 && strlen($name_product) < 101) {
                    $image_product->name_product = $name_product;
                } else {
                    throw new Error('invalid');
                }
            }

            if ($request->has('variety')) {
                if (strlen($variety) > 3 && strlen($variety) < 101) {
                    $image_product->variety = $variety;
                } else {
                    throw new Error('invalid');
                }
            }

            if ($request->has('image')) {
                $image_product->image = $image;
            }

            $image_product->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Image_product update",
                    "data" => $image_product
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Data are invalid"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error update image_product"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    // public function categoryDelete(Request $request, $id)
    // {
    //     try {
    //         $category = Category::query()->find($id);

    //         if (!$category) {
    //             throw new Error('invalid');
    //         }

    //         $category->delete();
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Category delete"
    //             ],
    //             Response::HTTP_OK
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         if ($th->getMessage() === 'invalid') {
    //             return response()->json(
    //                 [
    //                     "success" => false,
    //                     "message" => "This category doesn't exist"
    //                 ],
    //                 Response::HTTP_NOT_FOUND
    //             );
    //         }
    //         return response()->json(
    //             [
    //                 "success" => false,
    //                 "message" => "Error delete category"
    //             ],
    //             Response::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }

    // public function getCategoriesByGuild(Request $request, $id)
    // {
    //     try {
    //         $categories = Category::query()->where('guild_id', $id)->get();


    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Get categories successfully",
    //                 "data" => $categories
    //             ],
    //             Response::HTTP_OK
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());

    //         return response()->json(
    //             [
    //                 "success" => false,
    //                 "message" => "Error getting categories"
    //             ],
    //             Response::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }

    // public function getAllCategories(Request $request)
    // {
    //     try {
    //         $categories = Category::query()->get();
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Get all categories successfully",
    //                 "data" => $categories
    //             ],
    //             Response::HTTP_OK
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());

    //         return response()->json(
    //             [
    //                 "success" => false,
    //                 "message" => "Error getting all categories"
    //             ],
    //             Response::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }
}
