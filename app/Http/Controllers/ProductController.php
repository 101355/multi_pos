<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $warehouses = $this->productRepository->getAllWarehouse();
        $categories = $this->productRepository->getAllCategory();

        return view('product.create', compact('warehouses', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }


    public function get_category(Request $request)
    {
        $categoryId = $request->query('category_id');
        $subcategories = Category::where('category_id', $categoryId)->get(['id', 'name']);

        return response()->json($subcategories);
    }
}
