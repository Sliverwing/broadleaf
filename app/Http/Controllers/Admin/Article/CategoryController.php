<?php

namespace App\Http\Controllers\Admin\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller as AdminBaseController;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;

class CategoryController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Category::paginate(20);
        return view('admin.category.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.form');
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
        $data = $request->all();
        if ($request->hasFile('image'))
        {
            $fileDist = $request->file('image')->store('public');
            $data['image'] = Storage::url($fileDist);
        }
        Category::create($data);
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
        $item = Category::findOrFail($id);
        return view('admin.category.form', compact('item'));
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
        $this->doValidate($request, $id);
        $data = $request->all();
        if ($request->hasFile('image'))
        {
            $fileDist = $request->file('image')->store('public');
            $data['image'] = Storage::url($fileDist);
        }
        Category::findOrFail($id)->update($data);
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
        Category::destroy($id);
        return parent::destroy($id);
    }

    public function doValidate(Request $request, $id=null)
    {
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'unique:categories,slug,' . $id,
            'image' => 'image'
        ]);
    }
}
