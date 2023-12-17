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

    public function guildUpdate(Request $request, $id)
    {
        try {
            $guild = Guild::query()->find($id);
            $name = $request->input('name');

            if ($request->has('name')) {
                if (strlen($name) > 3 && strlen($name) < 100) {
                    $guild->name = $name;
                } else {
                    throw new Error('invalid');
                }
            }
            $guild->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Guild update"
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
                    "message" => "Error update guild"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function guildDelete(Request $request, $id)
    {
        try {
            $guild = Guild::query()->find($id);

            if (!$guild) {
                throw new Error('invalid');
            }

            $guild->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Guild delete"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "This guild doesn't exist"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error delete guild"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}