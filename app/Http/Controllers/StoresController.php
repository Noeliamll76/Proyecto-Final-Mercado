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
                        "message" => "Fallo en validacion datos Error registering store",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }
            $name=$request->input('name');
            $owner=$request->input('owner');
            $location=$request->input('location');
            $is_active=$request->input('is_active');
            $image=$request->input('image');
            $description=$request->input('description');
            $email=auth()->user()->email;
            $password=auth()->user()->password;
            $roles=auth()->user()->roles;
            
            $guild_id=$request->input('guild_id');
            if(!$guild = Guild::query()->find($guild_id)){
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
                    "is_active"=> $is_active,
                    "image" => $image,
                    "description" => $description,
                    "email" => $email,
                    "password" => $password,
                    "roles"=> $roles
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
                    "message" => "Salgo por el catch Error registering store",
                    "data"=> $name
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
