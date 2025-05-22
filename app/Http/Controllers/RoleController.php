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
use App\Services\ResponseService;

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

    public function update($id, UserRoleStoreRequest $request)
    {
        try {
            $this->userRoleRepository->update($id, [
                'name' => $request->name,
            ]);
            return redirect()->route('role-createPage.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRoleRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->userRoleRepository->datatable($request);
        }
    }
}
