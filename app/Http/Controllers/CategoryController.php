<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
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
        return view('category.create');
    }

    public function store(CategoryRequest $request)
    {
        try {
            $this->categoryRepository->create([
                'name' => $request->name,
            ]);
            return redirect()->route('category.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('category.edit', compact('category'));
    }

    public function update($id, CategoryRequest $request)
    {
        try {
            $this->categoryRepository->update($id, [
                'name' => $request->name,
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
