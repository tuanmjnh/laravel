{{--MASTER PAGE--}}
@extends('admin.default.master')
{{--Title Heading--}}
@section('title_heading',$lang['title_heading']))
{{--OTHER CSS--}}
@section('css')
@endsection
{{--OTHER JS--}}
@section('js')
@endsection
{{--OTHER JS-INIT--}}
@section('js-init')
@endsection
{{--CONTENT--}}
@section('content')
    <div class="container">

        @include('flash::message')

        <div class="row">
            <h1 class="pull-left">members</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('members.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($members->isEmpty())
                <div class="well text-center">No members found.</div>
            @else
                <table class="table">
                    <thead>
                    
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($members as $members)
                        <tr>
                            
                            <td>
                                <a href="{!! route('members.edit', [$members->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('members.delete', [$members->id]) !!}" onclick="return confirm('Are you sure wants to delete this members?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection