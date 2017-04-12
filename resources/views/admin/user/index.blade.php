@extends('admin.index')

@section('content')
    @include('components.message')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">用户表</h3>
        </div>
        <div class="box-body">
        <table class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>用户名</th>
                    <th>Email</th>
                    <th>创建于</th>
                    <th>更新于</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <th>{{ $item->id }}</th>
                        <th>{{ $item->name }}</th>
                        <th>{{ $item->email }}</th>
                        <th>{{ $item->created_at }}</th>
                        <th>{{ $item->updated_at }}</th>
                        <th> @permission('user.edit') <a href="/admin/user/{{ $item->id }}/edit" class="btn btn-default">编辑</a>@endpermission
                        @permission('role.destroy') <a href="#" onclick="handleDeleteBtn('/admin/user/{{ $item->id }}')" id="delete-btn" class="btn btn-danger">删除</a>@endpermission</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin">
                @permission('user.create')
                <a href="/admin/user/create" class="btn btn-default new-btn">新建</a>
                @endpermission
                <div class="pull-right">
                    {{ $items->links() }}
                </div>
            </ul>
        </div>
    </div>
    @include('components.delete')
@endsection
