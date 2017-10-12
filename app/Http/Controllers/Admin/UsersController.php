<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Session;

class UsersController extends Controller
{
    private $roles = [
        'client' => 'Client',
        'admin' => 'Admin',
        'superadmin' => 'Super Administrator',
    ];

    /**
     * Display Users
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;

        if (!empty($keyword)) {
            $users = User::where('first_name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
                ->orWhere('last_name', 'LIKE', "%$keyword%")
                ->paginate($perPage);
        } else {
            $users = User::paginate($perPage);
        }

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a User
     *
     * @return void
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => $this->roles]);
    }

    /**
     * Store a newly created User
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:191',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'zip' => 'required|string|max:15',
            'phone' => 'required|string|max:30',
        ]);

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $data['uuid'] = Uuid::uuid4()->toString();
        $user = User::create($data);

        Session::flash('flash_message', 'User added!');

        return redirect('admin/users');
    }

    /**
     * Display the User
     *
     * @param int $id User ID
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the User
     *
     * @param int $id User ID
     *
     * @return void
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = $this->roles;

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update User
     *
     * @param int $id User ID
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'address' => 'required|string|max:191',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:50',
            'zip' => 'required|string|max:15',
            'phone' => 'required|string|max:30',
        ]);

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        Session::flash('flash_message', 'User updated!');

        return redirect('admin/users');
    }

    /**
     * Remove User
     *
     * @param int $id User ID
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect('admin/users');
    }
}
