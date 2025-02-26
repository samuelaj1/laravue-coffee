<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalesResource;
use App\Models\Product;
use App\Models\Sale;
use App\Services\ApiResponse;
use App\Services\ProductService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $product = Product::where('primary_product', ProductService::PRODUCT_PRIMARY)->first();
        return view('sales')->with(['product' => $product]);
    }
    public function allSales()
    {
        $products = ProductService::getProducts();

        return view('allSales')->with(['products' => $products]);
    }


    public function store(Request $request): SalesResource
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'unit_cost' => 'required|numeric|min:0.01',
            'product_id' => 'nullable|integer|exists:products,id'
        ]);


        $calculatedPrice = ProductService::calculatePrice($validated['quantity'], $validated['unit_cost'], $validated['product_id'] ?? null);

        $sale = Sale::create([
            'product_id' => $calculatedPrice['product_id'],
            'quantity' => $validated['quantity'],
            'unit_cost' => $validated['unit_cost'],
            'selling_price' => $calculatedPrice['selling_price']
        ]);

        return new SalesResource($sale->load('product'));

//        return response()->json(ApiResponse::successResponseV2($sale, 'successfully saved the record'));
    }

    public function fetchSales(Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $type = $request->get('type');
        $sales = ProductService::getSales($type ?? null,100)->load('product');

        // Return as a collection of SalesResource
        return SalesResource::collection($sales);
    }


}
