@extends('admin.index')

@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">权限表</h3>
        </div>
        <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>标识</th>
                    <th>显示名称</th>
                    <th>描述</th>
                    <th>URL</th>
                    <th>启用 URL</th>
                    <th>更新于</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <th>{{ $item->name }}</th>
                        <th>{{ $item->display_name }}</th>
                        <th>{{ $item->description }}</th>
                        <th>{{ $item->url }}</th>
                        <th>{{ $item->is_url_enabled }}</th>
                        <th>{{ $item->updated_at }}</th>
                        <th><a href="/admin/permission/{{ $item->id }}/edit" class="btn btn-default @permission('permission.edit') disabled @endpermission">编辑</a></th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin">
                @permission('permission.create')
                <a href="/admin/permission/create" class="btn btn-default new-btn">新建</a>
                @endpermission
                <div class="pull-right">
                    {{ $items->links() }}
                </div>
            </ul>
        </div>
    </div>
@endsection