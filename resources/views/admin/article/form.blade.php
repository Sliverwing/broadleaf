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
        $base = '/admin/article/';
        $actionUrl = isset($item) ? $base . $item->id : $base;
        $method = isset($item) ? 'PUT' : 'POST';
        @endphp
        <form action="{{ $actionUrl }}" method="POST">
            <input type="hidden" name="_method" value="{{ $method }}">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title">文章标题</label>
                    <input type="text" name="title" value="{{ (old('title') != null ? old('title') : (isset($item) ? $item->title : '')) }}" class="form-control" id="title">
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('is_direct_link') ? ' has-error' : '' }}">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_direct_link" <?php echo ( old('is_direct_link') != null ?  "checked" :  ( isset($item) ? ( $item->is_direct_link == 1 ? "checked" : "") : "" )
                            )?> > 是否为直接链接
                        </label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('is_top') ? ' has-error' : '' }}">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="is_top" <?php echo ( old('is_top') != null ? "checked" : ( isset($item) ? ( $item->is_top == 1 ? "checked" : "") : "" )
                            )?> > 是否为置顶文章
                        </label>
                    </div>
                </div>
                <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
                    <label for="slug">简介</label>
                    <input type="text" name="intro" value="{{ (old('intro') != null ? old('intro') : (isset($item) ? $item->intro : '')) }}" class="form-control" id="intro">
                    @if ($errors->has('intro'))
                        <span class="help-block">
                            <strong>{{ $errors->first('intro') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('reference_link') ? ' has-error' : '' }}">
                    <label for="slug">文章来源</label>
                    <input type="text" name="reference_link" value="{{ (old('reference_link') != null ? old('reference_link') : (isset($item) ? $item->reference_link : '')) }}" class="form-control" id="reference_link">
                    <p class="help-block">请填写 URL 。</p>
                @if ($errors->has('reference_link'))
                        <span class="help-block">
                            <strong>{{ $errors->first('reference_link') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('views_count') ? ' has-error' : '' }}">
                    <label for="slug">点击量</label>
                    <input type="text" name="views_count" value="{{ (old('views_count') != null ? old('views_count') : (isset($item) ? $item->views_count : '')) }}" class="form-control" id="views_count">
                    <p class="help-block">请填写数字。</p>
                    @if ($errors->has('views_count'))
                        <span class="help-block">
                            <strong>{{ $errors->first('views_count') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('banner') ? ' has-error' : '' }}">
                    <label for="banner">文章标题图</label>
                    @if(isset($item))
                        <a href="{{ $item->banner }}">预览</a>
                    @endif
                    <input type="file" name="banner" id="banner">
                    @if ($errors->has('banner'))
                        <span class="help-block">
                            <strong>{{ $errors->first('banner') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                    <label for="content">内容</label>
                    <textarea id="content" class="form-control" name="content">
                        {{ (old('content') != null ? old('content') : (isset($item) ? $item->content : '')) }}
                    </textarea>

                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                    <label for="category_id">分类</label>
                    <select name="category_id" id="category_id" class="form-control">
                        <option value="">尚未分类</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @if(isset($item) && $item->category_id == $category->id ) selected @endif>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('category_id'))
                        <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
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
@push('scripts')
<script>
    $(function() {
        $('textarea#content').froalaEditor({
            language: 'zh_cn',
            heightMin: 200,
            toolbarButtons: ['bold', 'italic', 'underline', 'align', 'formatOL', 'formatUL',
                'color', 'fontFamily', 'fontSize', 'quote', 'insertImage', 'insertLink', 'insertTable', 'undo', 'redo', 'fullscreen'],
            pluginsEnabled: ['align', 'image', 'link', 'draggable', 'fontFamily', 'fontSize', 'table', 'fullscreen', 'lists'],
            imageAllowedTypes: ['jpeg', 'jpg', 'png'],
            imageEditButtons: ['imageReplace', 'imageAlign', 'imageRemove'],
            imageUploadParam: 'image',
            imageUploadParams: {
                _token: window.Laravel.csrfToken
            },
            imageUploadURL: '/admin/upload/image?from=article_editor'
        })
    });
</script>
@endpush