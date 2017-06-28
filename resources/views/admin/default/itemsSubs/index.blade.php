@extends('app')

@section('content')

    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">items_subs</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('itemsSubs.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($itemsSubs->isEmpty())
                <div class="well text-center">No items_subs found.</div>
            @else
                <table class="table">
                    <thead>
                    
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($itemsSubs as $itemsSub)
                        <tr>
                            
                            <td>
                                <a href="{!! route('itemsSubs.edit', [$itemsSub->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('itemsSubs.delete', [$itemsSub->id]) !!}" onclick="return confirm('Are you sure wants to delete this items_sub?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection