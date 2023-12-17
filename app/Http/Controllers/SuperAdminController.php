<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Guild;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Error;
use Illuminate\Support\Facades\Hash;
use illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class SuperAdminController extends Controller
{
    public function activate(Request $request, $id)
    {
        try {
            $user = User::query()->find($id);
            $user->is_active = true;
            
            $user->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "User is activated"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error activated user"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
    
    public function changeRole(Request $request, $id)
    {
        try {
            $user = User::query()->find($id);
            $user->roles = "admin";
           
            $user->save();
            return response()->json(
                [
                    "success" => true,
                    "message" => "User change to admin"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error change user role"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function getAllUsers(Request $request)
    {
        try {
            $users = User::query()->get();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Get all users successfully",
                    "data" => $users
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json(
                [
                    "success" => false,
                    "message" => "Error getting all users"
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    

    
}
