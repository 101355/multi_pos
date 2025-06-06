<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class UnitRepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Unit::class;
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
        $model = Unit::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($unit) {
                return Carbon::parse($unit->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($unit) {
                return view('unit._action', compact('unit'));
            })
            ->addColumn('responsive-icon', function ($unit) {
                return null;
            })
            ->toJson();
    }
}
