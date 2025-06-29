<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Warehouse;
use App\Repositories\SubCategoryRepository;

class SubcategoryController extends Controller
{
    protected $subCategoryRepository;
    public function __construct(SubCategoryRepository $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }
    public function index()
    {
        return view('sub-category.index');
    }

    public function create()
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();
        return view('sub-category.create', compact('categories', 'warehouses'));
    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $this->subCategoryRepository->create([
                'category_id' => $request->category_id,
                'warehouse_id' => $request->warehouse_id,
                'name' => $request->name,
            ]);
            return redirect()->route('sub-category.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $categories = Category::all();
        $warehouses = Warehouse::all();

        $sub_category = $this->subCategoryRepository->find($id);
        return view('sub-category.edit', compact('sub_category', 'categories', 'warehouses'));
    }

    public function update($id, SubCategoryRequest $request)
    {
        try {
            $this->subCategoryRepository->update($id, [
                'category_id' => $request->category_id,
                'warehouse_id' => $request->warehouse_id,
                'name' => $request->name,
            ]);
            return redirect()->route('sub-category.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->subCategoryRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->subCategoryRepository->datatable($request);
        }
    }

    public function get_category(Request $request)
    {
        $warehouse_id = $request->query('warehouse_id');
        // info($warehouse_id);
        $categories = Category::where('warehouse_id', $warehouse_id)->get();
        return response()->json($categories);
    }
}
