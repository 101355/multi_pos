<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Repositories\ProductRepository;
use App\Services\ResponseService;
use Exception;
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
        $units = Unit::all();

        return view('product.create', compact('warehouses', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated(); // Get validated data

            // Auto-generate a 13-digit barcode if empty
            if (empty($data['barcode'])) {
                $data['barcode'] = $this->generateEAN13();
            }

            // Adjust quantity if needed
            $data['quantity'] = $request->quantity * ($request->unit2 ?? 1);

            $this->productRepository->create($data);

            return redirect()->route('product.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }


    private function generateEAN13()
    {
        $code = str_pad(mt_rand(100000000000, 999999999999), 12, '0', STR_PAD_LEFT);
        return $code . $this->calculateEAN13CheckDigit($code);
    }

    private function calculateEAN13CheckDigit($digits)
    {
        $sum = 0;
        for ($i = 0; $i < 12; $i++) {
            $sum += (int) $digits[$i] * ($i % 2 === 0 ? 1 : 3);
        }
        return (10 - ($sum % 10)) % 10;
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
        $warehouses = Warehouse::all();
        $units = Unit::all();
        $categorys = Category::all();
        $sub_categorys = SubCategory::all();

        return view('product.edit', compact('product', 'warehouses', 'units', 'categorys', 'sub_categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $data = $request->validated();

            // If barcode is empty, auto-generate
            if (empty($data['barcode'])) {
                $data['barcode'] = $this->generateEAN13();
            }

            // Adjust quantity
            $data['quantity'] = $request->quantity;

            $product->update($data);

            return redirect()->route('product.index')->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        try {
            $this->productRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }


    public function get_category(Request $request)
    {
        $warehouse_id = $request->input('warehouse_id'); // instead of query()
        $categories = Category::where('warehouse_id', $warehouse_id)->get(['id', 'name']);

        return response()->json($categories);
    }

    public function get_subcategory(Request $request)
    {
        $category_id = $request->input('category_id'); // instead of query()
        $subcategories = Subcategory::where('category_id', $category_id)->get(['id', 'name']);

        return response()->json($subcategories);
    }


    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->productRepository->datatable($request);
        }
    }
}
