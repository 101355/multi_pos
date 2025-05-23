<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Repositories\SupplierRepository;
use App\Services\ResponseService;
use Exception;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function index()
    {

        return view('supplier.index');
    }

    public function create()
    {

        return view('supplier.create');
    }

    public function store(SupplierRequest $request)
    {
        try {
            Supplier::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone, // changed from 'phno'
                'url' => $request->url,
                'city' => $request->city,
                'region' => $request->region,
                'country' => $request->country,
                'description' => $request->description,
                'supplier_code' => $request->supplier_code,
                'opening_balance' => $request->opening_balance,
                'balance' => $request->balance,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }




    public function edit($id)
    {
        $suppliers = $this->supplierRepository->find($id);
        return view('supplier.edit', compact('suppliers'));
    }

    public function update(Supplier $supplier, SupplierRequest $request)
    {
        try {
            $supplier->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'url' => $request->url,
                'city' => $request->city,
                'region' => $request->region,
                'country' => $request->country,
                'description' => $request->description,
                'supplier_code' => $request->supplier_code,
                'opening_balance' => $request->opening_balance,
                'balance' => $request->balance,
            ]);

            return redirect()->route('supplier.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->supplierRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->supplierRepository->datatable($request);
        }
    }
}
