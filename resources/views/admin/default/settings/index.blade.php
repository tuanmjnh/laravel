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
    <div class="row">
        <h1 class="pull-left">settings</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route($route_create) !!}">Add New</a>
    </div>
    <div class="row">
        @if($settings->isEmpty())
        <div class="well text-center">No settings found.</div>
        @else
        <table class="table">
            <thead>
                <th>Sub Application</th>
                <th>Application Key</th>
                <th>Sub Key</th>
                <th>Value</th>
                <th>Sub Value</th>
            </thead>
            <tbody>
                @foreach($settings as $setting)
                <tr>
                    <td>{{$setting->app}}</td>
                    <td>{{$setting->app_key}}</td>
                    <td>{{$setting->sub_key}}</td>
                    <td>{{$setting->value}}</td>
                    <td>{{$setting->sub_value}}</td>
                    <td>
                        <a href="{!! route('admin.settings.edit', [$setting->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="{!! route('settings.delete', [$setting->id]) !!}" onclick="return confirm('Are you sure wants to delete this setting?')"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection