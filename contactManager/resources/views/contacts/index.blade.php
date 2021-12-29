@extends('contacts.layout')
 
@section('content')
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid" background>
      <a class="navbar-brand">Admin Dashboard</a>
      <a href="/admin">Home</a>
      <a href="/contacts">Contacts</a>
      <a href="/group">Groups</a>
      <a href="/admin/logout">Logout</a>
    </div>
  </nav>    
<div class="row">
        <div class="col-lg-12 margin-tb">
            {{-- <div class="pull-left">
                <h2>Contact Manager</h2>
            </div>
            <div class="">
                <a class="btn btn-success" href="/admin"> Home</a>
            </div> --}}
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('contacts.create') }}"> Create New Contact</a>
            </div>
            
            
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Phone Number</th>
            <th>Group</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($contacts as $contact)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $contact->name }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->phone }}</td>
            <td>{{ $contact->group ? $contact->group->name : 'Uncategorized' }}</td>


            <td>
                <form action="{{ route('contacts.destroy',$contact->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('contacts.show',$contact->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('contacts.edit',$contact->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $contacts->links() !!}
      
@endsection

