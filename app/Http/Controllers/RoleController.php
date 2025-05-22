<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\UserRoleRepository;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\UserRoleStoreRequest;
use Exception;

class RoleController extends Controller
{
    protected $userRoleRepository;
    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    public function index()
    {
        return view('role.index');
    }

    public function create()
    {
        return view('role.create');
    }

    public function store(UserRoleStoreRequest $request)
    {
        try {
            $this->userRoleRepository->create([
                'name' => $request->name,
            ]);
            return redirect()->route('role-createPage.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $role = $this->userRoleRepository->find($id);
        return view('role.edit', compact('role'));
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->userRoleRepository->datatable($request);
        }
    }
}
