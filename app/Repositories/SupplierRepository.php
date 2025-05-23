<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Subcategory;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class SupplierRepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Supplier::class;
    }

    public function find($id)
    {
        $record = $this->model::find($id);

        return $record;
    }

    public function create(array $data)
    {
        $record = $this->model::create($data);

        return $record;
    }

    public function update($id, array $data)
    {
        $record = $this->model::find($id);
        $record->update($data);

        return $record;
    }

    public function delete($id)
    {
        $record = $this->model::find($id);
        $record->delete();
    }

    public function datatable(Request $request)
    {
        $model = Supplier::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($supplier) {
                return Carbon::parse($supplier->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($supplier) {
                return view('supplier._action', compact('supplier'));
            })
            ->addColumn('responsive-icon', function ($supplier) {
                return null;
            })
            ->toJson();
    }
}
