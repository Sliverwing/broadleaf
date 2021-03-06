@extends('admin.index')

@section('content')
    @include('components.message')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">文章表</h3>
        </div>
        <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>标题</th>
                    <th>分类</th>
                    <th>文章状态</th>
                    <th>置顶</th>
                    <th>操作者</th>
                    <th>查看次数</th>
                    <th>更新于</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <th>{{ $item->title }}</th>
                        <th>@if ($item->category !== null) {{ $item->category->name }} @else 尚未分类 @endif</th>
                        <th>@if ($item->status == 'published') <span class="label bg-green">已发布</span> @elseif($item->status == 'draft') <span class="label bg-yellow">草稿</span> @elseif($item->status == 'hidden') <span class="label bg-blue">隐藏</span> @endif</th>
                        <th>@if($item->is_top) <i class="fa fa-fw fa-check green"></i> @else <i class="fa fa-fw fa-remove red"></i> @endif</th>
                        <th>@if ($item->user !== null) {{ $item->user->name }} @endif</th>
                        <th>{{ $item->views_count }}</th>
                        <th>{{ $item->updated_at }}</th>
                        <th> @permission('article.edit') <a href="/admin/article/{{ $item->id }}/edit" class="btn btn-default">编辑</a>@endpermission
                        @permission('article.destroy') <a href="#" onclick="handleDeleteBtn('/admin/article/{{ $item->id }}')" id="delete-btn" class="btn btn-danger">删除</a>@endpermission</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin">
                @permission('article.create')
                <a href="/admin/article/create" class="btn btn-default new-btn">新建</a>
                @endpermission
                <div class="pull-right">
                    {{ $items->links() }}
                </div>
            </ul>
        </div>
    </div>
    @include('components.delete')
@endsection
