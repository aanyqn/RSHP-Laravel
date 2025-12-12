<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    public function index(Request $request)
    {
        $groupedRoleUser = \DB::table('user as u')
                        ->leftJoin('role_user as ru', 'u.iduser', '=', 'ru.iduser')
                        ->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')
                        ->select(
                            'u.iduser',
                            'u.nama',
                            'u.email',
                            'r.idrole',
                            'r.nama_role',
                            'ru.status',
                            'ru.idrole_user'
                        )
                        ->get()
                        ->groupBy('iduser')
                        ->map(function ($items) {
                            return [
                                'iduser' => $items->first()->iduser,
                                'nama'   => $items->first()->nama,
                                'email'  => $items->first()->email,
                                'roles'  => $items->map(function ($role) {
                                    return [
                                        'idrole'     => $role->idrole,
                                        'nama_role' => $role->nama_role,
                                        'status'    => $role->status,
                                        'idrole_user' => $role->idrole_user,
                                    ];
                                })->values()
                            ];
                        })
                        ->values();

        if($request->filled('search')){
            $groupedRoleUser = \DB::table('user as u')
                        ->whereLike('u.nama', '%' . $request->search . '%')
                        ->orWhereLike('r.nama_role', '%' . $request->search . '%')
                        ->leftJoin('role_user as ru', 'u.iduser', '=', 'ru.iduser')
                        ->leftJoin('role as r', 'ru.idrole', '=', 'r.idrole')
                        ->select(
                            'u.iduser',
                            'u.nama',
                            'u.email',
                            'r.idrole',
                            'r.nama_role',
                            'ru.status',
                            'ru.idrole_user'
                        )
                        ->get()
                        ->groupBy('iduser')
                        ->map(function ($items) {
                            return [
                                'iduser' => $items->first()->iduser,
                                'nama'   => $items->first()->nama,
                                'email'  => $items->first()->email,
                                'roles'  => $items->map(function ($role) {
                                    return [
                                        'idrole'     => $role->idrole,
                                        'nama_role' => $role->nama_role,
                                        'status'    => $role->status,
                                        'idrole_user' => $role->idrole_user,
                                    ];
                                })->values()
                            ];
                        })
                        ->values();
        }
        
        return view('admin.role-user.index', compact('groupedRoleUser'));
        // $roleUsers = RoleUser::with('role', 'user')->get();
        // return view('admin.role-user.index', compact('roleUsers'));
    }
    public function create()
    {
        $role = Role::all();
        return view('admin.role-user.create', compact('role'));
    }

    public function store(Request $request)
    {
        $validatedData = $this->validateUser($request);
        $pemilik = $this->createUser($validatedData);
        return redirect()->route('admin.role-user.index')
                        ->with('success', 'User berhasil ditambahkan.');
    }

    protected function validateUser(Request $request, $id = null)
    {
        $uniqueRule = $id ?
            'unique:user,email,' . $id . ',iduser' :
            'unique:user,email';

        return $request->validate([
            'nama' => [
                'required',
                'string',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                $uniqueRule
            ],
            'password' => [
                'required',
            ],
            'idrole' => [
                'required',
                'numeric',
            ],
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus dengan format yang benar',
            'email.unique' => 'Email sudah ada',

        ]);
    }

    protected function createUser(array $data)
    {
        
        try {
            $hashed = \Hash::make($data['password']);
            $user = User::create([
                'nama' => $this->formatNama($data['nama']),
                'email' => $data['email'],
                'password' => $hashed,
            ]);

            $iduser = \DB::table('user')->where('email', $data['email'])->select('iduser')->first();

            $role_user = $user->roleUser()->create([
                'iduser' => $iduser,
                'idrole' => $data['idrole'],
                'status' => 1,
            ]);
            
        return [
            'user' => $user,
            'role_user' => $role_user,
        ];

        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data: ' . $e->getMessage()));
        }
    }

    public function edit($id)
    {
        $roles = \DB::table('role')
                    ->whereNotIn('idrole', function ($query) use ($id) {
                        $query->select('idrole')
                            ->from('role_user')
                            ->where('iduser', $id);
                    })->get();
        $roleUsers = \DB::table('user')->where('user.iduser', $id)->leftJoin('role_user', 'user.iduser', '=', 'role_user.iduser')->leftJoin('role', 'role_user.idrole', '=', 'role.idrole')->select('user.nama','user.email','user.iduser', 'role.idrole', 'role.nama_role', 'role_user.idrole_user', 'role_user.status')->get();
        return view('admin.role-user.edit', compact('id', 'roleUsers', 'roles'));
    }

    public function update(Request $request)
    {
        $validatedData = $this->validateRole($request, $request['idrole']);
        $jenisHewan = $this->updateRole($validatedData);
        return redirect()->route('admin.role.index')
                        ->with('success', 'Role berhasil ubah.');
    }
    public function EditRoleUser(Request $request) {
        $uniqueRule = $request->iduser ?
            'unique:user,email,' . $request->iduser . ',iduser' :
            'unique:user,email';
        $request->validate([
            'nama' => [
                'required',
                'string',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                $uniqueRule
            ],
            'iduser' => [
                'numeric',
                'required'
            ]
        ]);
        if($request->filled('idrole')) {
            \DB::table('role_user')->insert([
                'idrole' => $request->idrole,
                'iduser' => $request->iduser,
                'status' => 0
            ]);
            return redirect()->route('admin.role-user.edit', [$request->iduser])->with('success', 'Sukses menambah role');
        }
        \DB::table('user')->where('iduser', $request->iduser)->update([
                'nama' => $request->nama,
                'email' => $request->email,
        ]);
        return redirect()->route('admin.role-user.index')->with('success', 'Sukses mengedit user');
    }
    protected function updateRole(array $data)
    {
        try {
            $role = \DB::table('role')->where('idrole', $data['idrole'])->update([
                'nama_role' => $this->formatNamaRole($data['nama_role'])
            ]);
            return $role;
        } catch (\Exception $e) {
            throw new \Exception(('Gagal menyimpan data role: ' . $e->getMessage()));
        }
    }

    protected function formatNama($nama)
    {
        return trim(ucwords(strtolower($nama)));
    }

    public function activateRole($id, $status) {
        try {
            if($status == 1) {
                RoleUser::where('idrole_user', $id)->update(['status' => 0]);
                return redirect()->route('admin.role-user.index')->with('succes', 'Status role berhasil diupdate');
            }
            RoleUser::where('idrole_user', $id)->update(['status' => 1]);
            return redirect()->route('admin.role-user.index')->with('succes', 'Status role berhasil diupdate');
        } catch (\Exception $e) {
            throw new \Exception(('Gagal update role: ' . $e->getMessage()));
        }
    }
    public function deleteRoleUser($idrole_user, $iduser) {
        try {
            \DB::table('role_user')->where('idrole_user', $idrole_user)->delete();
            return redirect()->route('admin.role-user.edit', [$iduser])->with('success', 'Sukses menambah role');

        } catch (\Exception $e) {
            throw new \Exception(('Gagal delete role: ' . $e->getMessage()));
        }
    }
}
