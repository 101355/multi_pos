<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class SubCategoryRepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Subcategory::class;
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
        $model = Subcategory::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($sub_category) {
                return Carbon::parse($sub_category->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('category_id', function ($data) {
                return $data->category ? $data->category->name : '-';
            })
            ->addColumn('warehouse_id', function ($data) {
                return $data->warehouse ? $data->warehouse->name : '-';
            })
            ->addColumn('action', function ($sub_category) {
                return view('sub-category._action', compact('sub_category'));
            })
            ->addColumn('responsive-icon', function ($sub_category) {
                return null;
            })
            ->toJson();
    }
}
