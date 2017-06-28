{{--MASTER PAGE--}}
@extends('admin/default.master')
{{--OTHER CSS--}}
@section('css')
@endsection
{{--OTHER JS--}}
@section('js')
@endsection
{{--OTHER JS-INIT--}}
@section('js-init')
    @include('admin/common/validator')
    @include('admin/common/tinymce')
    <script>
        $('#select-dropdown').SelectDropdownParent({
            data: ['lang_code'],
            selected: '{{isset($form_data->lang_code)?$form_data->lang_code:''}}'
        });
    </script>
@endsection
{{--Title Heading--}}
@section('title_heading',$lang['title_heading'])
{{--CONTENT--}}
@section('content')
    <div class="container">
        <div class="clearfix"></div>
        <div class="row">
            @if(isset($form_data->id))
                {!! Form::open(['route' => [$route_form,$form_data->id],'method' => 'put','enctype'=>'multipart/form-data','class'=>'form-horizontal form-label-left','novalidate'=>'','data-parsley-validate'=>'']) !!}
            @else
                {!! Form::open(['route' => $route_form,'enctype'=>'multipart/form-data','class'=>'form-horizontal form-label-left','novalidate'=>'','data-parsley-validate'=>'']) !!}
            @endif
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>
                            @if(isset($form_data->id))
                                {{$lang['title_update']}}
                            @else
                                {{$lang['title_new']}}
                            @endif
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{{route($route_create)}}" data-toggle="tooltip"
                                   title="{{$lang['button_new']}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}">
                                    <i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group-extra">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 item">
                                    <input type="text" id="value" name="value" required=""
                                           class="form-control" placeholder="{{$lang['entry_roles_value']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_roles_value']}}"
                                           value="{{isset($form_data->value)?$form_data->value:''}}">
                                </div>
                            </div>
                            <div class="form-group-extra">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    @include('admin/common/icon_list')
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                <textarea id="description"
                                          name="description">{{isset($form_data->description)?$form_data->description:''}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12">
                {{--Publish panel--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$lang['title_publish']}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i
                                            class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label">{{$lang['title_options_publish']}}</label>
                            <div class="radio">
                                <label class="pl10 mb5">
                                    <div class="iradio_flat-green">
                                        <input type="radio" class="flat" name="publish" value="1"
                                                {{isset($form_data['publish']) ?($form_data['publish']==1?'checked':''):'checked'}}>
                                    </div>
                                    {{$lang['radio_change_index']}}
                                </label>
                                <label class="pl10 mb5">
                                    <div class="iradio_flat-green">
                                        <input type="radio" class="flat" name="publish" value="2"
                                                {{isset($form_data['publish']) && $form_data['publish']==2?'checked':''}}>
                                    </div>
                                    {{$lang['radio_change_continues']}}
                                </label>
                                @if(!isset($form_data->id))
                                    <label class="pl10 mb5">
                                        <div class="iradio_flat-green">
                                            <input type="radio" class="flat" name="publish" value="3"
                                                    {{isset($form_data['publish']) && $form_data['publish']==3?'checked':''}}>
                                        </div>
                                        {{$lang['radio_change_save']}}
                                    </label>
                                @endif
                            </div>
                            @if(isset($form_data->id))
                                <div class="form-group">
                                    <label class="control-label">{{$lang['title_info_publish']}}</label>
                                    <div class="info-date">
                                <span class="label label-primary">
                                    <i class="fa fa-user-secret" aria-hidden="true"></i>:
                                    <b>{{$form_data->created_by}}</b>
                                </span>
                                        <span class="label label-primary">
                                    <i class="fa fa-clock-o" aria-hidden="true"
                                       title="{{$lang['text_date_publish']}}"></i>:
                                <i>{{$form_data->created_at->format('d/m/Y')}}</i>
                                </span>
                                    </div>
                                    <div class="info-date">
                                <span class="label label-success">
                                    <i class="fa fa-user-secret" aria-hidden="true"></i>:
                                    <b>{{$form_data->updated_by}}</b>
                                </span>
                                        <span class="label label-success">
                                    <i class="fa fa-clock-o" aria-hidden="true"
                                       title="{{$lang['text_date_update']}}"></i>:
                                    <i>{{$form_data->updated_at->format('d/m/Y')}}</i>
                                </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @if(isset($form_data->id))
                                    <button type="submit"
                                            class="btn btn-success">{{$lang['button_update']}}</button>
                                    <a href="../" class="btn btn-info">{{$lang['button_back']}}</a>
                                @else
                                    <button type="submit" class="btn btn-success">{{$lang['button_publish']}}</button>
                                    <a href="./" class="btn btn-info">{{$lang['button_back']}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{--Format panel--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$lang['title_format']}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i
                                            class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                    </div>
                </div>


                {{--Images panel--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$lang['title_images']}}</h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i
                                            class="fa fa-chevron-up"></i></a></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                @if(isset($form_data->id))
                                    <div class="row">
                                        <div class="width-100 display-table mb15">
                                            <div class="images-extra">
                                                <img src="{{$images_path.$form_data->images}}"
                                                     alt="{{$form_data->title}}">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <input type="file" id="images" name="images[]"> {{--multiple="multiple"--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection