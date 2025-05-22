<?php

namespace App\Repositories;

use App\Models\AdminUser;
use App\Models\Role;
use App\Repositories\Contracts\BaseRepository;

class AdminUserRepository implements BaseRepository
{
    protected $model;
    protected $roleModel;

    public function __construct()
    {
        $this->model = AdminUser::class;
        $this->roleModel = Role::class;
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

    // get all roles
    public function getAllRoles()
    {
        return $this->roleModel::all();
    }
}
