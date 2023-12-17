<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Guild;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Log;
use Error;

class CategoriesController extends Controller
{
    private function validateCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'guild_id' => 'required',
            'description' => 'required|min:3|max:500',
        ]);
        return $validator;
    }

    public function categoryRegister(Request $request)
    {
        try {
            $validator = $this->validateCategory($request);
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering category",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $guild_id = $request->input('guild_id');
            $description = $request->input('description');
            $image = $request->input('image');

            if (!$guild = Guild::query()->find($guild_id)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "No existe este guild",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            $newCategory = Category::create(
                [
                    "guild_id" => $guild_id,
                    "description" => $description,
                    "image" => $image,
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category registered",
                    "data" => $newCategory
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

    public function categoryUpdate(Request $request, $id)
    {
        try {
            if (!$category = Category::query()->find($id)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Category doesn't exist",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $guild_id = $request->input('guild_id');
            $description = $request->input('description');
            $image = $request->input('image');

            if ($request->has('guild_id')) {
                if (!$guild = Guild::query()->find($guild_id)) {
                    return response()->json(
                        [
                            "success" => false,
                            "message" => "No existe este guild",
                        ],
                        Response::HTTP_NOT_FOUND
                    );
                }
                $category->guild_id = $guild_id;
            }
            if ($request->has('description')) {
                if (strlen($description) > 3 && strlen($description) < 101) {
                    $category->description = $description;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('image')) {
                $category->image = $image;
            }

            $category->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category update",
                    "data"=> $category
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
                    "message" => "Error update category"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function categoryDelete(Request $request, $id)
    {
        try {
            $category = Category::query()->find($id);

            if (!$category) {
                throw new Error('invalid');
            }

            $category->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Category delete"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "This category doesn't exist"
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
