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
        $base = '/admin/user/';
        $actionUrl = isset($item) ? $base . $item->id : $base;
        $method = isset($item) ? 'PUT' : 'POST';
        @endphp
        <form action="{{ $actionUrl }}" method="POST">
            <input type="hidden" name="_method" value="{{ $method }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">用户名</label>
                    <input type="text" name="name" value="{{ (old('name') != null ? old('name') : (isset($item) ? $item->name : '')) }}" class="form-control" id="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="slug">Email</label>
                    <input type="text" name="email" value="{{ (old('email') != null ? old('email') : (isset($item) ? $item->email : '')) }}" class="form-control" id="email">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="description">密码</label>
                    <input type="password" name="password" class="form-control" id="password">
                    <p class="help-block">如需修改用户密码，请填写此项，原密码不显示。</p>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="level">确认密码</label>
                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation">
                </div>
                @permission('user.role.edit')
                <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                    <label for="role">用户组</label>
                    <select name="role[]" id="role" class="form-control">
                        @foreach($roles as $role)
                            <option class="form-control" value="{{ $role->id }}" @if (isset($item) && $item->hasRole($role->id)) selected @endif> {{ $role->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('role'))
                        <span class="help-block">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                    @endif
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