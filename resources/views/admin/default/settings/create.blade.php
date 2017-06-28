{{--MASTER PAGE--}}
@extends('default.master')
{{--OTHER CSS--}}
@section('css')
@endsection
{{--OTHER JS--}}
@section('js')
@endsection
{{--OTHER JS-INIT--}}
@section('js-init')
@endsection
{{--Title Heading--}}
@section('title_heading',$lang['title_heading'])
{{--CONTENT--}}
@section('content')
    <div class="container">
        {{--{{var_dump($errors)}}--}}
        {!! Form::open(['route' => 'admin.settings.store']) !!}
        <div class="form-group col-sm-12">
            <table>
                <tr>
                    <td>Applicaton</td>
                    <td><input type="text" name="application" value="" class="form-control" placeholder="Applicaton"></td>
                </tr>
                <tr>
                    <td>Sub Application</td>
                    <td><input type="text" name="app" value="" class="form-control" placeholder="Sub Application"></td>
                </tr>
                <tr>
                    <td>Application Key</td>
                    <td><input type="text" name="app_key" value="" class="form-control" placeholder="Application Key"></td>
                </tr>
                <tr>
                    <td>Sub Key</td>
                    <td><input type="text" name="sub_key" value="" class="form-control" placeholder="Sub Key"></td>
                </tr>
                <tr>
                    <td>Value</td>
                    <td><input type="text" name="value" value="" class="form-control" placeholder="Value"></td>
                </tr>
                <tr>
                    <td>Sub Value</td>
                    <td><input type="text" name="sub_value" value="" class="form-control" placeholder="Sub Value"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><textarea name="description" class="form-control" placeholder="Description"></textarea></td>
                </tr>
                <tr>
                    <td>Extra</td>
                    <td><input type="text" name="extra" value="" class="form-control" placeholder="Extra"></td>
                </tr>
            </table>
            <input type="submit" name="submit" value="Save" class="btn btn-primary">
            {{--<button class="btn btn-primary">Save</button>--}}
        </div>
        {!! Form::close() !!}
    </div>
@endsection
