<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\User;
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
                    "message" => "store registered",
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

    public function storeUpdate(Request $request)
    {
        try {
            $email = auth()->user()->email;
            $store = Store::query()->where('email', $email)->first();
            $user = User::query()->where('email', $email)->first();

            $name = $request->input('name');
            $owner = $request->input('owner');
            $location = $request->input('location');
            $is_active = $request->input('is_active');
            $image = $request->input('image');
            $description = $request->input('description');
            $email = $request->input('email');

            if ($store->is_active === 0) {
                throw new Error('Is active false');
            }
            if ($request->has('name')) {
                if (strlen($name) > 3 && strlen($name) < 100) {
                    $store->name = $name;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('owner')) {
                if (strlen($owner) > 3 && strlen($owner) < 100) {
                    $store->owner = $owner;
                    $user->name = $owner;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('location')) {
                if (strlen($location) > 3 && strlen($location) < 100) {
                    $store->location = $location;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('is_active')) {
                if (($is_active) === true || ($is_active) === false) {
                    $store->is_active = $is_active;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('image')) {
                if (strlen($image) < 500) {
                    $store->image = $image;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('description')) {
                if (strlen($description) < 500) {
                    $store->description = $description;
                } else {
                    throw new Error('invalid');
                }
            }
            if ($request->has('email')) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required | email',
                ]);
                if ($validator->fails()) {
                    throw new Error('invalid');
                }
                $store->email = $email;
                // dd($store->email);
            }
            $store->save();
            $user->save();

            // $accessToken = $request->bearerToken();
            // $token = PersonalAccessToken::findToken($accessToken);
            // $token->delete();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Updated store, log in again",
                    "data" => $store
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
            if ($th->getMessage() === 'invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Email or data are invalid"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating store"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
