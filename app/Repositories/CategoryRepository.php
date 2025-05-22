<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class CategoryRepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Category::class;
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
        $model = Category::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($category) {
                return view('category._action', compact('category'));
            })
            ->addColumn('responsive-icon', function ($category) {
                return null;
            })
            ->toJson();
    }
}
