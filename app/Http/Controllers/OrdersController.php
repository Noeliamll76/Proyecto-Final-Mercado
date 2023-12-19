<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Symfony\Component\HttpFoundation\Response;
use Error;
use Illuminate\Support\Facades\Validator;
use illuminate\Support\Facades\Log;

class OrdersController extends Controller
{
    private function validateOrders(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'ud' => 'required|min:1|max:4',
        ]);
        return $validator;
    }

    public function orderRegister(Request $request)
    {
        try {
            $validator = $this->validateOrders($request);
            if ($validator->fails()) {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Error registering order",
                        "error" => $validator->errors()
                    ],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $user_id = auth()->user()->id;
            $product_id = $request->input('product_id');

            if (!$product = Product::query()->find($product_id)) {
                throw new Error('Invalid');
            }

            $ud = $request->input('ud');
            $price = $product->price;
            $import = ($ud * $price);

            $newOrder = Order::create(
                [
                    "user_id" => $user_id,
                    "product_id" => $product_id,
                    "ud" => $ud,
                    "price" => $price,
                    "import" => $import,
                ]
            );
            return response()->json(
                [
                    "success" => true,
                    "message" => "Order registered",
                    "data" =>
                    [
                        $newOrder,
                        auth()->user()->name,
                        $product->name,
                    ]
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect product"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error registering order",

                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function orderUpdate(Request $request, $id)
    {
        try {
            $user_id = auth()->user()->id;

            if (!$order = Order::query()
                ->where('id', $id)
                ->where('user_id', $user_id)
                ->first()) {
                throw new Error('Invalid');
            }
            $ud = $request->input('ud');
            $import = ($ud * $order->price);

            $order->ud = $ud;
            $order->import = $import;

            $order->save();

            return response()->json(
                [
                    "success" => true,
                    "message" => "Order updated",
                    "data" => $order
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect order"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error updating order",

                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function orderDelete(Request $request, $id)
    {
        try {
            $user_id = auth()->user()->id;

            if (!$order = Order::query()
                ->where('id', $id)
                ->where('user_id', $user_id)
                ->first()) {
                throw new Error('Invalid');
            }
            
            $order->delete();
            return response()->json(
                [
                    "success" => true,
                    "message" => "Order delete"
                ],
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            if ($th->getMessage() === 'Invalid') {
                return response()->json(
                    [
                        "success" => false,
                        "message" => "Incorrect order"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }
            return response()->json(
                [
                    "success" => false,
                    "message" => "Error deleted order",

                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
