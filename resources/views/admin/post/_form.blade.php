<div class="row">
    <div class="col-md-8">
        <div class="form-group row">
            <label for="title" class="col-md-2 col-form-label">
                标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" autofocus id="title" value="{{ $title }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="subtitle" class="col-md-2 col-form-label">
                副标题
            </label>
            <div class="col-md-10">
                <input type="text" class="form-control" name="subtitle" autofocus id="subtitle" value="{{ $subtitle }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="page_image" class="col-md-2 col-form-label">
                缩略图
            </label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="page_image" autofocus id="page_image" onchange="handle_image_change()" alt="Image thumbnail" value="{{ $page_image }}">
                    </div>
                    <script>
                        function handle_image_change() {
                            $("#page-image-preview").attr("src",function() {
                                var value=$("#page_image").val();
                                if(!value) {
                                    value = {!! json_encode(config('blog.page_image')) !!};
                                    if(value == null) {
                                        value = "";
                                    }
                                }
                                if(value.substr(0,4) != 'http' && value.substr(0,1) != '/') {
                                    value = {!! json_encode(config('blog.uploads.webpath'))  !!} + "/" + value;
                                }
                                return value;
                            })
                        }
                    </script>
                    <div class="visible-sm space-10"></div>
                    <div class="col-md-4 text-right">
                        <img src="{{ page_image($page_image) }}" class="img img_responsive" id="page-image-preview" style="max-height:40px" alt="Image thumbnail">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-group row">
            <label for="content" class="col-md-2 col-form-label">内容</label>
            <div class="col-md-10">
                <textarea name="content" id="content" class="form-control" rows="14">{{ $content }}</textarea>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group row">
            <label for="publish_date" class="col-md-3 col-form-label">发布日期</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="publish_date" id="publish_date" value="{{ $publish_date }}">
            </div>
        </div>
        <div class="form-group row">
            <label for="publish_time" class="col-md-3 col-form-label">发布时间</label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="publish_time" id="publish_time" value="{{ $publish_time }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-8 col-md-offset-3">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="is_draft" {{ checked($is_draft) }}>
                        草稿？
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="tags" class="col-md-3 col-form-label">标签</label>
            <div class="col-md-8">
                <select name="tags[]" id="tags" class="form-control" multiple>
                    @foreach($allTags as $tag)
                        <option value="{{$tag}}" @if(in_array($tag,$tags)) selected @endif>
                            {{$tag}}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="layout" class="col-md-3 col-form-label">
                布局
            </label>
            <div class="col-md-8">
                <input type="text" class="form-control" name="layout" id="layout" value="{{$layout}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="meta_description" class="col-md-3 col-form-label">摘要</label>
            <div class="col-md-8">
                <textarea name="meta_description" class="form-control" id="meta_description" rows="6">{{$meta_description}}</textarea>
            </div>
        </div>
    </div>
</div>