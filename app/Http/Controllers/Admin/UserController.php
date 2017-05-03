<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::paginate(20);
        return view('admin.user.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->doValidate($request);
        User::create(array_merge($request->except('password_confirmed'), ['password' => bcrypt($request->password)]));
        return parent::store($request);
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
    public function edit($id)
    {
        $item = User::findOrFail($id);
        $roles = Role::all();
        return view('admin.user.form', compact('item','roles'));
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
        $item = User::findOrFail($id);
        $this->doValidate($request, $id);
        $data = $request->all();
        if ($request->input('password', null) == null)
        {
            unset($data['password']);
        }
        else
        {
            $data['password'] = bcrypt($request->input('password'));
        }
        if (Auth::user()->hasPermission('user.role.edit'))
        {
            $item->syncRoles($data['role']);
        }
        $item->update($data);
        return parent::update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return parent::destroy($id);
    }

    protected function doValidate(Request $request, $id=null)
    {
        $rules = [
            'name' => 'required',
            'password' => 'nullable|min:6|confirmed'
        ];
        if (is_null($id))
        {
            $rules['email'] = 'required|email|unique:users,email';
        }
        else
        {
            $rules['email'] = 'required|email|unique:users,email,' . $id;
        }
        $this->validate($request, $rules);
    }
}
