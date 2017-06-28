@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'itemsSubs.store']) !!}

        @include('itemsSubs.fields')

    {!! Form::close() !!}
</div>
@endsection
