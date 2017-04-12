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
        $base = '/admin/permission/';
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
                <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                    <label for="model">数据实例</label>
                    <input type="text" name="model" value="{{ (old('model') != null ? old('model') : (isset($item) ? $item->model : '')) }}" class="form-control" id="model">
                    <p class="help-block">请勿随意更改!</p>
                    @if ($errors->has('model'))
                        <span class="help-block">
                            <strong>{{ $errors->first('model') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                    <label for="url">URL</label>
                    <input type="text" name="url" value="{{ (old('url') != null ? old('url') : (isset($item) ? $item->url : '')) }}" class="form-control" id="url">
                    @if ($errors->has('url'))
                        <span class="help-block">
                            <strong>{{ $errors->first('url') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_url_enabled" @if((isset($item) && $item['is_url_enabled']) || old('is_url_enabled')) checked @endif> 启用 URL
                    </label>
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
@endsection