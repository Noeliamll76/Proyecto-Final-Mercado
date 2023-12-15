<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Guild;
use Symfony\Component\HttpFoundation\Response;
use Error;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;


class StoresController extends Controller
{
    private function validateStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'owner' => 'required|min:3|max:100',
            'location' => 'required|min:3|max:100',
            'guild_id' => 'required',
            'description' => 'required|min:3|max:500',
        ]);
        return $validator;
    }

    public function storeRegister(Request $request)
    {
        try {
            $validator = $this->validateStore($request);
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering store",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }
            $name = $request->input('name');
            $owner = $request->input('owner');
            $location = $request->input('location');
            $is_active = true;
            $image = $request->input('image');
            $description = $request->input('description');
            $email = auth()->user()->email;
            $password = auth()->user()->password;
            $roles = auth()->user()->roles;

            $guild_id = $request->input('guild_id');
            if (!$guild = Guild::query()->find($guild_id)) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "No existe este guild",
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            $newStore = Store::create(
                [
                    "name" => $name,
                    "owner" => $owner,
                    "location" => $location,
                    "guild_id" => $guild_id,
                    "is_active" => $is_active,
                    "image" => $image,
                    "description" => $description,
                    "email" => $email,
                    "password" => $password,
                    "roles" => $roles
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Store registered",
                    "data" => $newStore
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering store",
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function storeProfile(Request $request)
    {
        try {
            $email = auth()->user()->email;
            $password = auth()->user()->password;

            $store = Store::query()->where('email', $email)->first();

            if ($store->is_active === 0) {
                throw new Error('Is active false');
            }
            if (!$store || ($password !== $store->password)) {
                throw new Error('invalid');
            }
            return response()->json(
                [
                    "success" => true,
                    "message" => "Store :",
                    "data" => $store,
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Is active false') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Store not found"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error profile store",
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
