<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class Warehouserepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Warehouse::class;
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
        $model = Warehouse::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($warehouse) {
                return Carbon::parse($warehouse->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($warehouse) {
                return view('warehouse._action', compact('warehouse'));
            })
            ->addColumn('responsive-icon', function ($warehouse) {
                return null;
            })
            ->toJson();
    }
}
