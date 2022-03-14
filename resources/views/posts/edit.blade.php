@extends('layouts.app')
@section('title')
Edit Post
@endsection
@section('content')
<script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
<script type="text/javascript">
  tinymce.init({
    selector : "textarea",
    plugins : ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
    toolbar : "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
  }); 
</script>
<form method="post" action='{{ url("/update") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="post_id" value="{{ $post->id }}{{ old('post_id') }}">
  <div class="col-md-12 text-right">
    <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
  </div>
  <div class="form-group">Title
    <input required="required" placeholder="Enter title here" type="text" name = "title" class="form-control" value="@if(!old('title')){{$post->title}}@endif{{ old('title') }}"/>
  </div>
  <div class="form-group">Description
    <textarea name='body'class="form-control">
      @if(!old('body'))
      {!! $post->body !!}
      @endif
      {!! old('body') !!}
    </textarea>
  </div>
   <div class="form-group">Image
     <input id="file-1" type="file" name="image" class="file" data-min-file-count="1">
  </div>
 

 
  <input type="submit" name='publish' class="btn btn-success" value = "Update"/>
 
  <a href="{{ route('home')  }}" class="btn btn-danger">Cancel</a>
</form>
<script src="{{ asset('/js/image.js') }}"></script>
<script type="text/javascript">
$("#file-1").fileinput({
    theme: 'fa',
    showUpload:false,
    showRemove:false,     
    uploadUrl: "/image-view",
    uploadExtraData: function() {
      return {
        _token: $("input[name='_token']").val(),
      };
    },            
    remove :false,
    allowedFileExtensions: ['jpg','jpeg', 'png',],
    initialPreview:"{{asset('images/'.$post->image)}}",
    initialPreviewAsData:true,
    overwriteInitial: true,
    maxFileSize:2000,
    maxFilesNum: 1,
  });
</script>
@endsection