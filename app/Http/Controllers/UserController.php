<?php

namespace App\Http\Controllers;

use Event;
use App\Events\UserWasCreated;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * The User model
     */
    protected $users;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(User $users)
    {
        $this->middleware('auth');

        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->users->orderBy('name')
            ->paginate();

        return view('users.admin.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'region' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = $this->users->create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Event::fire(new UserWasCreated($user, $request->password));

        return redirect('admin/users')
            ->withSuccess('User added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.admin.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User                 $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'type' => 'required',
            'region' => 'required',
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
        ]);

        $user->fill($request->except(['password']));

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('admin/users')
            ->withSuccess('User updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User                 $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if ($request->user()->id == $user->id) {
            return redirect('admin/users')
                ->withError('You cannot delete your own User');
        }

        $user->delete();

        return redirect('admin/users')
            ->withSuccess('User deleted');
    }
}
