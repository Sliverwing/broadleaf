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
        $base = '/admin/category/';
        $actionUrl = isset($item) ? $base . $item->id : $base;
        $method = isset($item) ? 'PUT' : 'POST';
        @endphp
        <form action="{{ $actionUrl }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="{{ $method }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">栏目名</label>
                    <input type="text" name="name" value="{{ (old('name') != null ? old('name') : (isset($item) ? $item->name : '')) }}" class="form-control" id="name">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                    <label for="slug">唯一标识</label>
                    <input type="text" name="slug" value="{{ (old('slug') != null ? old('slug') : (isset($item) ? $item->slug : '')) }}" class="form-control" id="slug">
                    <p class="help-block">如不需要，请留空。</p>
                    @if ($errors->has('slug'))
                        <span class="help-block">
                            <strong>{{ $errors->first('slug') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    <label for="image">栏目图片</label>
                    @if(isset($item))
                        <a href="{{ $item->image }}">预览</a>
                    @endif
                    <input type="file" name="image" id="image">
                    <p class="help-block">如需修改用户密码，请填写此项，原密码不显示。</p>
                    @if ($errors->has('image'))
                        <span class="help-block">
                            <strong>{{ $errors->first('image') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
    </div>
@endsection
