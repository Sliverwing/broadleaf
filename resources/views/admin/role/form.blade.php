@extends('admin.index')

@section('content')
    @include('components.message')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">编辑</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        @php
        $base = '/admin/role/';
        $actionUrl = isset($item) ? $base . $item->id : $base;
        $method = isset($item) ? 'PUT' : 'POST';
        @endphp
        <form action="{{ $actionUrl }}" method="POST">
            <input type="hidden" name="_method" value="{{ $method }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">名称</label>
                    <input type="text" name="name" value="{{ (old('name') != null ? old('name') : (isset($item) ? $item->name : '')) }}" class="form-control" id="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                    <label for="slug">标识符</label>
                    <input type="text" name="slug" value="{{ (old('slug') != null ? old('slug') : (isset($item) ? $item->slug : '')) }}" class="form-control" id="slug">
                    <p class="help-block">请勿随意更改!</p>
                    @if ($errors->has('slug'))
                        <span class="help-block">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description">描述</label>
                    <input type="text" name="description" value="{{ (old('description') != null ? old('description') : (isset($item) ? $item->description : '')) }}" class="form-control" id="description">
                    @if ($errors->has('description'))
                        <span class="help-block">
                            <strong>{{ $errors->first('description') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('level') ? ' has-error' : '' }}">
                    <label for="level">角色等级</label>
                    <input type="text" name="level" value="{{ (old('level') != null ? old('level') : (isset($item) ? $item->level : '')) }}" class="form-control" id="level">
                    <p class="help-block">请勿随意更改! 0 为最小值</p>
                    @if ($errors->has('level'))
                        <span class="help-block">
                            <strong>{{ $errors->first('level') }}</strong>
                        </span>
                    @endif
                </div>
                @permission('role.permission.edit')
                <div class="form-group{{ $errors->has('permission') ? ' has-error' : '' }}">
                    <label for="permission">权限</label>
                        <div class="row">
                            <div class="col-xs-5">
                                <select multiple="multiple" name="from[]" class="form-control" id="multiselect" size="8">
                                    @foreach($allPermissions as $permission)
                                        @if (isset($rolePermissionsId))
                                            @if(!in_array($permission->id, $rolePermissionsId))
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-xs-1">
                                <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
                                <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
                                <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
                                <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
                            </div>
                            <div class="col-xs-5">
                                <select multiple="multiple" class="form-control" id="multiselect_to" name="permission[]" size="8">
                                    @if(isset($rolePermissionsId))
                                        @foreach($allPermissions as $permission)
                                            @if(in_array($permission->id, $rolePermissionsId))
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                </div>
                @endpermission
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
<script>
    $('#multiselect').multiselect();
</script>
@endpush