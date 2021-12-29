@extends('contacts.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Contact</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('contacts.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('contacts.store') }}" method="POST">
    @csrf
  
     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email Address:</strong>
                <input type="text" class="form-control"  name="email" placeholder="Email Address">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Phone Number:</strong>
                <input type="text" class="form-control" name="phone" placeholder="Phone Number">
            </div>
        </div>
        <div class="form-group">
            <label for="group_id">Group</label>
            <select class="form-control" name="group_id" required>
                <option value="">Select a Group</option>
        
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ $group->id === old('group_id') ? 'selected' : '' }}>{{ $group->name }}</option>
                    @if ($group->children)
                        @foreach ($group->children as $child)
                            <option value="{{ $child->id }}" {{ $child->id === old('group_id') ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                        @endforeach
                    @endif
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection