<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Role::paginate(20);
        return view('admin.role.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $allPermissions = Permission::all();
        return view('admin.role.form', compact('allPermissions'));
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
        $role = Role::create($request->except('permission'));
        if (Auth::user()->hasPermission('role.permission.edit'))
        {
            $role->syncPermissions($request->input('permission'));
        }
        return redirect('/admin/role')->with('status', 'success')->with('title', '已保存');
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
        $item = Role::findOrFail($id);
        $allPermissions = Permission::all();
        $rolePermissions = $item->permissions;
        $rolePermissionsId = [];
        foreach ($rolePermissions as $rolePermission)
        {
            array_push($rolePermissionsId, $rolePermission->id);
        }
        return view('admin.role.form', compact('item', 'allPermissions', 'rolePermissionsId'));
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
        $item = Role::findOrFail($id);
        $this->doValidate($request, $id);
        $item->update($request->except('permission'));
        if (Auth::user()->hasPermission('role.permission.edit'))
        {
            $item->syncPermissions($request->input('permission'));
        }
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
        Role::destroy($id);
        return parent::destroy($id);
    }

    protected function doValidate(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required',
            'level' => 'required',
        ];
        if (!is_null($id))
        {
            $rules['slug'] = 'required|unique:roles,slug,' . $id;
        }
        $this->validate($request, $rules);
    }
}
