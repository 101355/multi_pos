<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Models\Warehouse;
use Exception;
use App\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {

        return view('category.index');
    }

    public function create()
    {

        $warehouses = Warehouse::all();
        return view('category.create', compact('warehouses'));
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepository->create([
                'name' => $request->name,
                'warehouse_id' => $request->warehouse_id,
            ]);
            return redirect()->route('category.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        $warehouses = Warehouse::all();

        return view('category.edit', compact('category', 'warehouses'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $this->categoryRepository->update($id, [
                'name' => $request->name,
                'warehouse_id' => $request->warehouse_id,
            ]);
            return redirect()->route('category.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoryRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->categoryRepository->datatable($request);
        }
    }
}
