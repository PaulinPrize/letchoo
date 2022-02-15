<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Repositories\RoleRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends AppBaseController
{
    /** @var  RoleRepository */
    private $roleRepository;

    public function __construct(RoleRepository $roleRepo)
    {
        $this->roleRepository = $roleRepo;
    }

    /**
     * Display a listing of the Role.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $roles = $this->roleRepository->all();

        return view('roles.index', compact('roles'));
        
    }

    /**
     * Show the form for creating a new Role.
     *
     * @return Response
     */
    public function create()
    {
        // Récupérer toutes les permissions
        $allPermissions = Permission::all();

        return view('roles.create', compact('allPermissions'));
    }

    /**
     * Store a newly created Role in storage.
     *
     * @param CreateRoleRequest $request
     *
     * @return Response
     */
    public function store(CreateRoleRequest $request)
    {
        $input = $request->all();

        $role = $this->roleRepository->create($input);

        $role->syncPermissions($request->input('permission'));

        Flash::success('Role saved successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Display the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)->get();
        return view('roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified Role.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();

        return view('roles.edit', compact('role', 'permission', 'rolePermissions'));
    }

    /**
     * Update the specified Role in storage.
     *
     * @param int $id
     * @param UpdateRoleRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRoleRequest $request)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $role = $this->roleRepository->update($request->all(), $id);

        $role->syncPermissions($request->input('permission'));

        Flash::success('Role updated successfully.');

        return redirect(route('roles.index'));
    }

    /**
     * Remove the specified Role from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $role = $this->roleRepository->find($id);

        if (empty($role)) {
            Flash::error('Role not found');

            return redirect(route('roles.index'));
        }

        $this->roleRepository->delete($id);

        Flash::success('Role deleted successfully.');

        return redirect(route('roles.index'));
    }
}
