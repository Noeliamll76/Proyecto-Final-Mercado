<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guild;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Log;
use Error;


class GuildsController extends Controller
{
    public function guildRegister(Request $request)
    {
        try {

            $newGuild = Guild::create(
                [
                    "name" => $request->input('name'),
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Guild registered",
                    "data" => $newGuild
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering guild"
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
