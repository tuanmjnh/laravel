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

    @include('common.errors')

    {!! Form::open(['route' => 'items.store']) !!}

        @include('items.fields')

    {!! Form::close() !!}
</div>
@endsection
