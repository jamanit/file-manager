<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users index')->only('index');
        $this->middleware('can:users create')->only(['create', 'store']);
        $this->middleware('can:users edit')->only(['edit', 'update']);
        $this->middleware('can:users delete')->only('destroy');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('created_at', 'desc');

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('roles', function ($row) {
                    return $row->getRoleNames()->implode(', ');
                })
                ->addColumn('actions', function ($row) {
                    $editUrl        = route('users.edit', $row->uuid);
                    $deleteUrl      = route('users.destroy', $row->uuid);
                    $permissionBase = 'users';

                    return view('components.table.actions', compact('editUrl', 'deleteUrl', 'permissionBase'))->render();
                })
                ->rawColumns(['roles', 'actions'])
                ->make(true);
        }

        return view('dashboard.pages.users.index');
    }

    public function create()
    {
        $roleOptions = collect(Role::pluck('name', 'name')->toArray())
            ->map(fn($text, $value) => ['value' => $value, 'text' => $text])
            ->values()
            ->toArray();

        return view('dashboard.pages.users.create', compact('roleOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles'    => 'required|array',
            'roles.*'  => 'exists:roles,name',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($request->filled('roles')) {
            $user->assignRole($request->roles);
        }

        return redirect()->route('users.index')->with('success', 'Data created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(User $user)
    {
        if (!$user) {
            return redirect()->route('users.index')->with('error', 'Data not found.');
        }

        $roleOptions = collect(Role::pluck('name', 'name')->toArray())
            ->map(fn($text, $value) => ['value' => $value, 'text' => $text])
            ->values()
            ->toArray();

        $selectedRoles = $user->roles->pluck('name')->toArray();

        return view('dashboard.pages.users.edit', compact('user', 'roleOptions', 'selectedRoles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles'    => 'nullable|array',
            'roles.*'  => 'exists:roles,name',
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        if ($request->filled('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->syncRoles([]);
        }

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
