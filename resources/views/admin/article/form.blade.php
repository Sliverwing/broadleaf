@extends('admin.index')

@section('content')
    @include('components.message')
    <div class="row">
        @php
            $base = '/admin/article/';
            $actionUrl = isset($item) ? $base . $item->id : $base;
            $method = isset($item) ? 'PUT' : 'POST';
        @endphp
        <form action="{{ $actionUrl }}" method="POST">
            <div class="col-md-9">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">编辑</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->

                    <input type="hidden" name="_method" value="{{ $method }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">文章标题</label>
                            <input type="text" name="title"
                                   value="{{ (old('title') != null ? old('title') : (isset($item) ? $item->title : '')) }}"
                                   class="form-control" id="title">
                            @if ($errors->has('title'))
                                <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('is_direct_link') ? ' has-error' : '' }}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="is_direct_link" <?php echo(old('is_direct_link') != null ? "checked" : (isset($item) ? ($item->is_direct_link == 1 ? "checked" : "") : "")
                                    )?> > 是否为直接链接
                                </label>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('is_top') ? ' has-error' : '' }}">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"
                                           name="is_top" <?php echo(old('is_top') != null ? "checked" : (isset($item) ? ($item->is_top == 1 ? "checked" : "") : "")
                                    )?> > 是否为置顶文章
                                </label>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('intro') ? ' has-error' : '' }}">
                            <label for="slug">简介</label>
                            <input type="text" name="intro"
                                   value="{{ (old('intro') != null ? old('intro') : (isset($item) ? $item->intro : '')) }}"
                                   class="form-control" id="intro">
                            @if ($errors->has('intro'))
                                <span class="help-block">
                            <strong>{{ $errors->first('intro') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('reference_link') ? ' has-error' : '' }}">
                            <label for="slug">文章来源</label>
                            <input type="text" name="reference_link"
                                   value="{{ (old('reference_link') != null ? old('reference_link') : (isset($item) ? $item->reference_link : '')) }}"
                                   class="form-control" id="reference_link">
                            <p class="help-block">请填写 URL 。</p>
                            @if ($errors->has('reference_link'))
                                <span class="help-block">
                            <strong>{{ $errors->first('reference_link') }}</strong>
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
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章属性</h3>
                    </div>
                    <div class="box-body">

                        <div class="form-group{{ $errors->has('views_count') ? ' has-error' : '' }}">
                            <label for="slug">点击量</label>
                            <input type="text" name="views_count"
                                   value="{{ (old('views_count') != null ? old('views_count') : (isset($item) ? $item->views_count : '')) }}"
                                   class="form-control" id="views_count">
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
                                <img src="{{ $item->banner }}" class="img-responsive" id="banner_img" alt="预览图">
                            @else
                                <img src="" class="img-responsive" id="banner_img" alt="预览图" style="display: none;">
                            @endif
                            <input type="hidden" name="banner" id="banner_path">
                            <input type="file" id="banner">
                            @if ($errors->has('banner'))
                                <span class="help-block">
                            <strong>{{ $errors->first('banner') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                            <label for="category_id">分类</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="">尚未分类</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            @if(isset($item) && $item->category_id == $category->id ) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="help-block">
                            <strong>{{ $errors->first('category_id') }}</strong>
                        </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                            <label for="status">文章状态</label>
                            <select name="status" id="status" class="form-control">
                                    <option value="published"
                                            @if(isset($item) && $item->status == 'published' ) selected @endif>已发布</option>
                                    <option value="draft"
                                            @if(isset($item) && $item->status == 'draft' ) selected @endif>草稿</option>
                                    <option value="hidden"
                                            @if(isset($item) && $item->status == 'hidden' ) selected @endif>隐藏</option>
                            </select>
                            @if ($errors->has('status'))
                                <span class="help-block">
                            <strong>{{ $errors->first('status') }}</strong>
                        </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>

        </form>
    </div>
@endsection
@push('scripts')
<script>
    $(function () {
        $('textarea#content').summernote({
            lang: 'zh_cn',
            height: 300,
            minHeight: null,
            maxHeight: 200,
            focus: true,
            callbacks: {
                onImageUpload: function(files) {
                    data = new FormData();
                    data.append('image', files[0]);
                    data.append('_token', window.Laravel.csrfToken);
                    $.ajax({
                        data: data,
                        type: "POST",
                        url: "/admin/upload/image?from=article_editor",
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function(resp) {
                            $('textarea#content').summernote("insertImage", resp.link);
                        }
                    });
                }
            }
        });
        $('#banner').on('change', function () {
            var data = new FormData();
            data.append('image', $('#banner').prop('files')[0]);
            data.append('_token', window.Laravel.csrfToken);
            $.ajax({
                url: '/admin/upload/image?from=article_banner',
                type: 'POST',
                data: data,
                cache: false,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(data, textStatus)
                {
                    $('#banner_img').show();
                    $('#banner_img').prop('src', data['link']);
                    $('#banner_path').val(data['link']);
                },
                error: function(jqXHR, textStatus)
                {
                    console.log('ERRORS: ' + textStatus);
                },
                statusCode: {
                    422: function () {
                        alert("请选择图片文件！");
                    }
                }
            });
        });
    });
</script>
@endpush