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

    // public function categoryUpdate(Request $request, $id)
    // {
    //     try {
    //         if (!$category = Category::query()->find($id)) {
    //             return response()->json(
    //                 [
    //                     "success" => false,
    //                     "message" => "Category doesn't exist",
    //                 ],
    //                 Response::HTTP_NOT_FOUND
    //             );
    //         }

    //         $guild_id = $request->input('guild_id');
    //         $description = $request->input('description');
    //         $image = $request->input('image');

    //         if ($request->has('guild_id')) {
    //             if (!$guild = Guild::query()->find($guild_id)) {
    //                 return response()->json(
    //                     [
    //                         "success" => false,
    //                         "message" => "No existe este guild",
    //                     ],
    //                     Response::HTTP_NOT_FOUND
    //                 );
    //             }
    //             $category->guild_id = $guild_id;
    //         }
    //         if ($request->has('description')) {
    //             if (strlen($description) > 3 && strlen($description) < 101) {
    //                 $category->description = $description;
    //             } else {
    //                 throw new Error('invalid');
    //             }
    //         }
    //         if ($request->has('image')) {
    //             $category->image = $image;
    //         }

    //         $category->save();
    //         return response()->json(
    //             [
    //                 "success" => true,
    //                 "message" => "Category update",
    //                 "data" => $category
    //             ],
    //             Response::HTTP_OK
    //         );
    //     } catch (\Throwable $th) {
    //         Log::error($th->getMessage());
    //         if ($th->getMessage() === 'invalid') {
    //             return response()->json(
    //                 [
    //                     "success" => false,
    //                     "message" => "Data are invalid"
    //                 ],
    //                 Response::HTTP_NOT_FOUND
    //             );
    //         }
    //         return response()->json(
    //             [
    //                 "success" => false,
    //                 "message" => "Error update category"
    //             ],
    //             Response::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }

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
