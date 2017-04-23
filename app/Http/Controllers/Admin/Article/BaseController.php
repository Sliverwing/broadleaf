<?php

namespace App\Http\Controllers\Admin\Article;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\Controller as AdminBaseController;
use Illuminate\Support\Facades\Auth;


class BaseController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Article::with('user')->with('category')->paginate(20);
        return view('admin.article.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.article.form', compact('categories'));
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
        Article::create(array_merge($data, [ 'user_id' => Auth::id()]));
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
        $item = Article::findOrFail($id);
        $categories = Category::all();
        return view('admin.article.form', compact('item', 'categories'));
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
        $data = $this->parseData($request);
        Article::findOrFail($id)->update($data);
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
        //
    }

    protected function parseData(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'views_count' => 'nullable|integer',
            'reference_link' => 'nullable|url'
        ]);
        $data = $request->all();
        $data['is_direct_link'] = array_has($data, 'is_direct_link');
        $data['is_top'] = array_has($data, 'is_top');
        return $data;
    }
}
