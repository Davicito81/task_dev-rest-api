<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Product;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller{

    public function __construct(){}

    /**
     * List all products.
     * 
     * @return JsonResponse
     */
    public function index():JsonResponse {
        $products = Product::all();
        if($products->count() > 0)
            return response()->json($products, 200); 
        else
            return response()->json(['message' => 'No products available'], 200);
    }

    /**
     * Store a newly product.
     *  
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request):JsonResponse {
        /*$request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'state' => 'required|boolean',
        ]);*/

        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'state' => 'nullable|boolean',
        ]);

        if($validated->fails())
            return response()->json([
                'message' => 'All fields re mandatory',
                'error' => $validated->messages(),
            ], 422);        

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->category = $request->category;
        $product->state = !empty($request->state)? $request->state : true;
        $product->created_at = date('Y-m-d H:i:s');
        $product->updated_at = null;
        $product->save();

        return response()->json(['message'=> 'Product created successfuly.', 'id'=> $product->id, 'data' => $product], 200); 
    }

     /**
     * Store a list of products.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function storeJsonList(Request $request):JsonResponse {
        $requestProducts = $request->all();

        // Validierung für jedes Produkt im Array
        foreach ($requestProducts as $item) {
            $validator = Validator::make($item, [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|string',
                'state' => 'nullable|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'All fields re mandatory',
                    'error' => $validator->errors()
                ], 422);
            }
        }

        $products = [];

        // Erstellung jedes Produkts
        foreach ($requestProducts as $item) {
            $product = Product::create($item);
            array_push($products, $product);
        }

        return response()->json(['message' => 'Produkte erfolgreich hinzugefügt', 'products' => $products], 201);
    }

    /**
     * Display the specified resource.
     * 
     * @param Product $product
     * @return JsonResponse
     */
    public function show(Product $product):JsonResponse {
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param Request $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Request $request, Product $product): JsonResponse{

        $validated = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'state' => 'nullable|boolean',
        ]);

        if($validated->fails())
            return response()->json([
                'message' => 'All fields re mandatory',
                'error' => $validated->messages(),
            ], 422);

        $product->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'state' => $request->state,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return response()->json(['message'=> 'Product updated successfuly.', 'data' => $product], 200);       
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse{
        $product->delete();
        return response()->json(['message'=> 'Product deleted successfuly.'], 200); 
    }
}
