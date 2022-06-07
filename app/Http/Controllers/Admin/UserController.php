<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Fortify\CreateNewUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        if (Gate::denies('logged-in')){
//            dd('no access ');
//        }
        if (Gate::allows('is-admin')){
            $users = User::paginate(10);
            return view('admin.users.index')->with(['users' => $users]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', ['roles' => Role::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //dd($request);
        //$validatedDate = $request->validated();

       // $user = User::create($validatedDate);
      // $user = User::create($request->except(['_token', 'roles']));
        $avatar = $request->file('avatar');
        $newUser = new CreateNewUser();
        $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMedia($avatar)->toMediaCollection();
        }

        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'you have created the user');

       return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        try {
            $user = (new UserService())->findById($id);
        }catch (ModelNotFoundException $exception ){
            return view('admin.users.notfound', ['error' => $exception->getMessage()]);
        }

        return view('admin.users.edit',
            ['roles' => Role::all(),
             'user'  => User::find($id)
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = (new UserService())->findById($id);
        }catch (ModelNotFoundException $exception ){
            return view('admin.users.notfound', ['error' => $exception->getMessage()]);
        }

        $avatar = $request->file('avatar');
        if (!$user){
            $request->session()->flash('error', 'You can not edit this user.');
            return redirect(route('admin.users.index'));
        }
        $user->update($request->except(['_token', 'roles']));

        if($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMedia($avatar)->toMediaCollection();
        }

        $user->roles()->sync($request->roles);

        $request->session()->flash('success', 'you have edited the user');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        try {
            $user = (new UserService())->findById($id);
        }catch (ModelNotFoundException $exception ){
            return view('admin.users.notfound', ['error' => $exception->getMessage()]);
        }
        
        User::destroy($id);

        $request->session()->flash('success', 'you have deleted the user');
        return redirect(route('admin.users.index'));
    }
}
