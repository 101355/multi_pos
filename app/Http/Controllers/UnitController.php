<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\UnitRequest;
use Exception;
use App\Repositories\UnitRepository;

class UnitController extends Controller
{
    protected $unitRepository;
    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }
    public function index()
    {
        return view('unit.index');
    }

    public function create()
    {
        return view('unit.create');
    }

    public function store(UnitRequest $request)
    {
        try {
            $this->unitRepository->create([
                'name' => $request->name,
            ]);
            return redirect()->route('unit.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $unit = $this->unitRepository->find($id);
        return view('unit.edit', compact('unit'));
    }

    public function update($id, UnitRequest $request)
    {
        try {
            $this->unitRepository->update($id, [
                'name' => $request->name,
            ]);
            return redirect()->route('unit.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->unitRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->unitRepository->datatable($request);
        }
    }
}
