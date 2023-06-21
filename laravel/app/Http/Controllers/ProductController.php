<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $products = Product::all();

            return response()->json([
                "success"  => true,
                'message' => 'Produtos carregados com sucesso.',
                'data' => $products
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "sucess"  => false,
                "message" => "{$e->getMessage()}",
                "data"    => []
            ], $e->getCode() < 600 ?: 500);
        }
    }
}
