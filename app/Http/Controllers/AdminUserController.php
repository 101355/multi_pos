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
use Intervention\Image\Laravel\Facades\Image;
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

            $admin_user->name = $request->name;
            $admin_user->email = $request->email;
            $admin_user->phno = $request->phno;
            $admin_user->role_id = $request->role_id;
            $admin_user->address = $request->address;

            if ($request->hasFile('photo')) {

                if ($admin_user->photo && file_exists(public_path($admin_user->photo))) {
                    unlink(public_path($admin_user->photo));
                }

                $avatar = $request->file('photo');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();

                // Ensure the directory exists
                $directory = public_path('admin_user');
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }

                // Resize and compress image (Intervention Image v3 style)
                Image::read($avatar)
                    ->resize(300, 300, fn($c) => $c->aspectRatio())
                    ->toJpeg(85) // reasonable quality
                    ->save($directory . '/' . $filename);

                // Save just the relative path
                $admin_user->photo = 'admin_user/' . $filename;
            }
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
