@extends('layouts.app')
@section('title')

@endsection
@section('title-meta')

@endsection
@section('content')
<div class="">
  <div class="list-group" style="margin-bottom: 30px;">
    <div class="list-group-item">
      <div class="row">
        <div class="col-md-12 text-right">
          <a href="{{ route('home') }}" class="btn btn-danger">Back</a>
        </div>

        <div class="col-md-12">
          {!! $showDescription->body !!}
        </div>
      </div>
  </div>
</div>
</div>

@endsection
