<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $total = 0;

            foreach($request->products as $product) {
                $productModel = Product::findOrFail($product['id']);
                $total += $productModel->price * $product['quantity'];
            }

            $order = new Order;
            $order->total = $total;
            $order->save();

            foreach($request->products as $product) {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }

            return response()->json([
                "success"  => true,
                'message' => 'Pedido realizado com sucesso.',
                'data' => [
                    'order_id' => $order->id,
                    'total' => $total,
                    'products' => $order->products,
                ],
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "success"  => false,
                "message" => "{$e->getMessage()}",
                "data"    => []
            ], $e->getCode() < 600 ?: 500);
        }
        
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return $order;
    }

}
