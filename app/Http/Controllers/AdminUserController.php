<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use Exception;
use Carbon\Carbon;
use App\Models\AdminUser;
use App\Repositories\AdminUserRepository;
use App\Services\ResponseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminUserController extends Controller
{
    protected $adminUserRepository;
    public function __construct(AdminUserRepository $adminUserRepository)
    {
        $this->adminUserRepository = $adminUserRepository;
    }
    public function index()
    {
        return view('admin-user.index');
    }

    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            return $this->adminUserRepository->datatable($request);
        }
    }

    public function create()
    {
        return view('admin-user.create');
    }

    public function store(AdminUserStoreRequest $request)
    {
        try {
            $this->adminUserRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'phno' => $request->phno,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('admin-user.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $admin_user = $this->adminUserRepository->find($id);
        return view('admin-user.edit', compact('admin_user'));
    }

    public function update($id, AdminUserUpdateRequest $request)
    {
        try {
            $this->adminUserRepository->update($id, [
                'name' => $request->name,
                'email' => $request->email,
                'phno' => $request->phno,
                'password' => $request->password ? Hash::make($request->password) : $this->adminUserRepository->find($id)->password
            ]);
            return redirect()->route('admin-user.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->adminUserRepository->delete($id);

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
}
