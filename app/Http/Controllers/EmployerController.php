<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployerCreateRequest;
use App\Http\Requests\EmployerUpdateRequest;
use App\Interfaces\PermissionInterface;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployerController extends Controller
{
    protected UserInterface $userRepository;
    protected PermissionInterface $permissionRepository;

    public function __construct(
        UserInterface $userRepository,
        PermissionInterface $permissionRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        if (!$this->can('index_employers')) {
            abort(403);
        }
        $page = $this->getPage();
        $limit = $this->getLimit();
        $users = $this->userRepository->findByOrderPaginate([
            'role' => 'employer',
        ], 'id', 'desc', $page, $limit);
        return view('employers.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        if (!$this->can('create_employer')) {
            abort(403);
        }
        $roles = [
            [
                'name' => 'مدیرکل',
                'id' => 'admin'
            ],
            [
                'name' => 'کارمند',
                'id' => 'employer'
            ]
        ];
        $permissions = $this->permissionRepository->all('*', 'id', 'asc');
        $success = false;
        $error = '';
        return view('employers.create', compact('roles', 'permissions', 'success', 'error'));
    }

    public function store(EmployerCreateRequest $request)
    {
        if (!$this->can('create_employer')) {
            abort(403);
        }
        $roles = [
            [
                'name' => 'مدیرکل',
                'id' => 'admin'
            ],
            [
                'name' => 'کارمند',
                'id' => 'employer'
            ]
        ];
        $permissions = $this->permissionRepository->all('*', 'id', 'asc');
        DB::beginTransaction();
        try {
            /** @var User $user */
            $user = $this->userRepository->create($request->only([
                'name',
                'last_name',
                'username',
                'role',
                'position',
                'password',
            ]));
            $user->permissions()->sync($request->get('permissions'));
            $success = true;
            $error = '';
            DB::commit();
            return view('employers.create', compact('roles', 'permissions', 'success', 'error'));
        } catch (\Exception $exception) {
            $success = false;
            $error = 'متاسفانه خطایی رخ داده است';
            DB::rollBack();
            return view('employers.create', compact('roles', 'permissions', 'success', 'error'));
        }
    }

    public function edit(int $id)
    {
        if (!$this->can('edit_employer')) {
            abort(403);
        }
        $user = $this->userRepository->findOneOrFail($id);
        $roles = [
            [
                'name' => 'مدیرکل',
                'id' => 'admin'
            ],
            [
                'name' => 'کارمند',
                'id' => 'employer'
            ]
        ];
        $permissions = $this->permissionRepository->all('*', 'id', 'asc');
        $success = false;
        $error = '';
        return view('employers.edit', compact('user', 'roles', 'permissions', 'success', 'error'));
    }

    public function update(EmployerUpdateRequest $request, int $id)
    {
        if (!$this->can('edit_employer')) {
            abort(403);
        }
        $roles = [
            [
                'name' => 'مدیرکل',
                'id' => 'admin'
            ],
            [
                'name' => 'کارمند',
                'id' => 'employer'
            ]
        ];
        $permissions = $this->permissionRepository->all('*', 'id', 'asc');
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'username' => $request->get('username'),
                'role' => $request->get('role'),
                'position' => $request->get('position'),
            ];
            if ($request->get('password')) {
                $data['password'] = Hash::make($request->get('password'));
            }
            $this->userRepository->update($data, $id);
            /** @var User $user */
            $user = $this->userRepository->findOneOrFail($id);
            $user->permissions()->sync($request->get('permissions'));
            $success = true;
            $error = '';
            DB::commit();
            return view('employers.edit', compact('user', 'roles', 'permissions', 'success', 'error'));
        } catch (\Exception $exception) {
            $user = $this->userRepository->findOneOrFail($id);
            $success = false;
            $error = 'متاسفانه خطایی رخ داده است';
            DB::rollBack();
            return view('employers.edit', compact('user', 'roles', 'permissions', 'success', 'error'));
        }
    }

    public function destroy(int $id)
    {
        if (!$this->can('delete_employer')) {
            abort(403);
        }
        $this->userRepository->delete($id);
        return redirect()->back();
    }
}
