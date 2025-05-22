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
            $model = AdminUser::query();
            return DataTables::eloquent($model)
                ->editColumn('created_at', function ($admin_user) {
                    return Carbon::parse($admin_user->created_at)->format('Y-m-d H:i:s');
                })
                ->addColumn('action', function ($admin_user) {
                    return view('admin-user._action', compact('admin_user'));
                })
                ->addColumn('role', function ($admin_user) {
                    return $admin_user->role ? $admin_user->role->name : ''; // Return role name
                })
                ->addColumn('responsive-icon', function ($admin_user) {
                    return null;
                })
                ->toJson();
        }
    }

    public function create()
    {
        $roles = $this->adminUserRepository->getAllRoles();

        return view('admin-user.create', compact('roles'));
    }

    public function store(AdminUserStoreRequest $request)
    {
        try {
            AdminUser::create([
                'name' => $request->name,
                'email' => $request->email,
                'phno' => $request->phno,
                'role_id' => $request->role_id,
                'address' => $request->address,
                'password' => Hash::make($request->password)
            ]);
            return redirect()->route('admin-user.index')->with('success', 'Successfully Created');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $admin_user = $this->adminUserRepository->find($id);
        $roles = $this->adminUserRepository->getAllRoles();

        return view('admin-user.edit', compact('admin_user', 'roles'));
    }

    public function update(AdminUser $admin_user, AdminUserUpdateRequest $request)
    {
        try {

            dd($request->all());

            $admin_user->name = $request->name;
            $admin_user->email = $request->email;
            $admin_user->phno = $request->phno;
            $admin_user->role_id = $request->role_id;
            $admin_user->address = $request->address;
            $admin_user->password = $request->password ? Hash::make($request->password) : $admin_user->password;
            $admin_user->update();
            return redirect()->route('admin-user.index')->with('success', 'Successfully Updated');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(AdminUser $admin_user)
    {
        try {
            $admin_user->delete();

            return ResponseService::success([], 'Successfully Deleted');
        } catch (Exception $e) {
            return ResponseService::fail($e->getMessage());
        }
    }
}
