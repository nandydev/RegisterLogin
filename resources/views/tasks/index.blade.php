@extends('admin.dashboard')

@section('title', 'Manage Tasks')

@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Task Management</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('tasks.create') }}"> Create New Task</a>
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
        <th>Title</th>
        <th>Description</th>
        <th>User</th>
        <th>Status</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($tasks as $task)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->user->name }}</td>
        <td>{{ $task->status }}</td>
        <td>
            <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
    
                <a class="btn btn-primary" href="{{ route('tasks.edit',$task->id) }}">Edit</a>
   
                @csrf
                @method('DELETE')
      
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
  
{!! $tasks->links() !!}
      
@endsection
