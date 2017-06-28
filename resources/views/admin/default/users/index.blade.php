@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">users</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('users.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($users->isEmpty())
                <div class="well text-center">No users found.</div>
            @else
                <table class="table">
                    <thead>
                    
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($users as $users)
                        <tr>
                            
                            <td>
                                <a href="{!! route('users.edit', [$users->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('users.delete', [$users->id]) !!}" onclick="return confirm('Are you sure wants to delete this users?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection