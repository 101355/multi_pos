<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Repositories\Contracts\BaseRepository;

class UserRoleRepository implements BaseRepository
{
    protected $model;
    public function __construct()
    {
        $this->model = Role::class;
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
        $model = Role::query();
        return DataTables::eloquent($model)
            ->editColumn('created_at', function ($role) {
                return Carbon::parse($role->created_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('action', function ($role) {
                return view('role._action', compact('role'));
            })
            ->addColumn('responsive-icon', function ($role) {
                return null;
            })
            ->toJson();
    }
}
