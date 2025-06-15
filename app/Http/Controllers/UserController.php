<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('created_at', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('role_name', function ($row) {
                    return $row->role->name ?? '-';
                })
                ->addColumn('actions', function ($row) {
                    $editUrl = route('users.edit', $row->uuid);
                    $deleteUrl = route('users.destroy', $row->uuid);

                    return view('components.table.actions', compact('editUrl', 'deleteUrl'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('dashboard.pages.users.index');
    }

    public function create()
    {
        $roleOptions = Role::orderBy('name', 'asc')->pluck('name', 'id')->toArray();

        return view('dashboard.pages.users.create', compact('roleOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'role_id'  => $request->role_id,
        ]);

        return redirect()->route('users.index')->with('success', 'Data created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        $roleOptions = Role::orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Data not found.');
        }
        return view('dashboard.pages.users.edit', compact('user', 'roleOptions'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Data updated successfully.');
    }

    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Data not found.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Data deleted successfully.');
    }
}
