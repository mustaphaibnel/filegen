@extends('layouts.app')
@section('content')
<div class="container">
  <form method="post" action="{{url('commands')}}">
    <div class="form-group row">
      {{csrf_field()}}
      <label for="Name" class="col-sm-2 col-form-label col-form-label-lg">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control form-control-lg" id="Name" placeholder="Name" name="Name">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-2"></div>
      <input type="submit" class="btn btn-primary">
    </div>
  </form>
</div>
@endsection