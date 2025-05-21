<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $model = Role::query();
            return DataTables::eloquent($model)
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($data) {
                    return null;
                })
                ->addColumn('responsive-icon', function ($data) {
                    return null;
                })
                ->toJson();
        }
    }
}
