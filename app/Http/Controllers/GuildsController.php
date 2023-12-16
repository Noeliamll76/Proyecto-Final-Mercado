<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guild;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Log;


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
}
