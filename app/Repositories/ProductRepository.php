<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Subcategory;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class ProductRepository implements BaseRepository
{
    protected $model;
    protected $warehouseModel;
    protected $cateogryModel;

    public function __construct()
    {
        $this->model = Product::class;
        $this->warehouseModel = Warehouse::class;
        $this->cateogryModel = Category::class;
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
        $model = Product::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($product) {
                return Carbon::parse($product->created_at)->format('Y-m-d H:i:s');
            })

            ->addColumn('action', function ($product) {
                return view('product._action', compact('product'));
            })
            ->addColumn('responsive-icon', function ($product) {
                return null;
            })
            ->toJson();
    }


    public function getAllWarehouse()
    {
        return $this->warehouseModel::all();
    }

    public function getAllCategory()
    {
        return $this->cateogryModel::all();
    }
}
