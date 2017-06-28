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
            <h1 class="pull-left">groups_groups</h1>
            <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('groupsGroups.create') !!}">Add New</a>
        </div>

        <div class="row">
            @if($groupsGroups->isEmpty())
                <div class="well text-center">No groups_groups found.</div>
            @else
                <table class="table">
                    <thead>
                    
                    <th width="50px">Action</th>
                    </thead>
                    <tbody>
                     
                    @foreach($groupsGroups as $groupsGroups)
                        <tr>
                            
                            <td>
                                <a href="{!! route('groupsGroups.edit', [$groupsGroups->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                                <a href="{!! route('groupsGroups.delete', [$groupsGroups->id]) !!}" onclick="return confirm('Are you sure wants to delete this groups_groups?')"><i class="glyphicon glyphicon-remove"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection