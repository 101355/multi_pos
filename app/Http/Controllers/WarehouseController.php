<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Repositories\Warehouserepository;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $warehouseRepository;
    public function __construct(Warehouserepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }
    public function index()
    {
        return view('warehouse.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->warehouseRepository->create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'address' => $request->input('address'),
            ]);

            return redirect()->route('warehouse.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        try {
            $this->warehouseRepository->update($warehouse->id, [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'address' => $request->input('address'),
            ]);

            return redirect()->route('warehouse.index')->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        try {
            $this->warehouseRepository->delete($warehouse->id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->warehouseRepository->datatable($request);
        }
    }
}
