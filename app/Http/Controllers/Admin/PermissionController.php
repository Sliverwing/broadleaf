<?php

namespace App\Http\Controllers\Admin;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Permission::paginate(20);
        return view('admin.permission.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.permission.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->parseData($request);
        Permission::create($data);
        return redirect('/admin/permission')->with('status', 'success')->with('title', '已保存');
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
        $item = Permission::findOrFail($id);
        return view('admin.permission.form', compact('item'));
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
        $item = Permission::findOrFail($id);
        $data = $this->parseData($request, $id);
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
        Permission::destroy($id);
        return parent::destroy($id);
    }

    private function doValidate(Request $request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required|unique:permissions,slug,' . $id
        ]);
    }

    private function parseData(Request $request, $id = null)
    {
        $this->doValidate($request, $id);
        $data = $request->all();
        if ($request->input('is_url_enabled') == 'on')
        {
            $data['is_url_enabled'] = true;
        } else {
            $data['is_url_enabled'] = false;
        }
        return $data;
    }
}
