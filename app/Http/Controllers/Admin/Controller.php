<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct()
    {
        $this->middleware('acl');
    }

    public function update(Request $request, $id)
    {
        return back()->with('status', 'success')->with('title', '更新成功');
    }

    public function destroy($id)
    {
        return back()->with('status', 'success')->with('title', '删除成功');
    }
}
