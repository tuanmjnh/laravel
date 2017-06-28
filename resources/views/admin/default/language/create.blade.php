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
        {{--<div class="page-title">--}}
        {{--<div class="title_left">--}}
        {{--                <h3>{{$lang['title_new']}}</h3>--}}
        {{--</div>--}}
        {{--<div class="title_right">--}}
        {{--@include('default/_partials/search')--}}
        {{--</div>--}}
        {{--</div>--}}
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
                            {{--<small>different form elements</small>--}}
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a href="{{route($route_create)}}" data-toggle="tooltip"
                                   title="{{$lang['button_new']}}"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </li>
                            {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                            {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Settings 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Settings 2</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            <li>
                                <a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}">
                                    <i class="fa fa-chevron-up"></i></a>
                            </li>
                            {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
                        </ul>
                        {{--                        <a href="{{route($route_create)}}" class="btn btn-primary btn-sm pull-right">{{$lang['button_new']}}</a>--}}
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group-extra">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12 item">
                                    <input type="text" id="title" name="title" required=""
                                           class="form-control" placeholder="{{$lang['entry_lang_name']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_lang_name']}}"
                                           value="{{isset($form_data->title)?$form_data->title:''}}">
                                    <i class="fa fa-asterisk" aria-hidden="true"></i>
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    {{--<input type="text" id="lang_code" name="lang_code" required=""--}}
                                    {{--class="form-control" placeholder="{{$lang['entry_lang_code']}}"--}}
                                    {{--data-toggle="tooltip" data-placement="right"--}}
                                    {{--title="{{$lang['entry_lang_code']}}"--}}
                                    {{--value="{{isset($form_data['lang_code'])?$form_data['lang_code']:''}}">--}}
                                    {{--<i class="fa fa-asterisk" aria-hidden="true"></i>--}}
                                    {{--lang_list--}}
                                    <div id="select-dropdown" role="presentation" class="dropdown btn-dropdown">
                                        <a href="#" class="dropdown-toggle" id="drop4" data-toggle="dropdown"
                                           role="button" aria-haspopup="true" aria-expanded="false"> ... <span
                                                    class="caret"></span> </a>
                                        <ul class="dropdown-menu" id="menu1" aria-labelledby="drop4">
                                            @foreach($lang_list as $ll)
                                                <li><a data-value="{{$ll}}" href="javascript:;">{{$ll}}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-extra">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="native_name" name="native_name"
                                           class="form-control" placeholder="{{$lang['entry_native_name']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_native_name']}}"
                                           value="{{isset($form_data->native_name)?$form_data->native_name:''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="post_code" name="post_code"
                                           class="form-control" placeholder="{{$lang['entry_lang_post_code']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_lang_post_code']}}"
                                           value="{{isset($form_data->post_code)?$form_data->post_code:''}}">
                                </div>
                            </div>
                            <div class="form-group-extra">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="country_code" name="country_code"
                                           class="form-control" placeholder="{{$lang['entry_lang_country_code']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_lang_country_code']}}"
                                           value="{{isset($form_data->country_code)?$form_data->country_code:''}}">
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12 item">
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i>
                                        </div>
                                        <input type="number" id="currency" name="currency" required=""
                                               class="form-control" placeholder="{{$lang['entry_lang_currency']}}"
                                               data-toggle="tooltip" data-placement="right"
                                               title="{{$lang['entry_lang_currency']}}"
                                               value="{{isset($form_data->currency)?$form_data->currency:0}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-extra">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    @include('admin/common/icon_list')
                                </div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12 item">
                                    <input type="number" id="orders" name="orders" required="" data-validate-minmax="0,"
                                           class="form-control" placeholder="{{$lang['entry_order']}}"
                                           data-toggle="tooltip" data-placement="right"
                                           title="{{$lang['entry_order']}}"
                                           value="{{isset($form_data->orders)?$form_data->orders:0}}">
                                    <i class="fa fa-asterisk " aria-hidden="true"></i>
                                </div>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<div class="col-md-12 col-sm-12 col-xs-12">--}}
                            {{--<div id="alerts"></div>--}}
                            {{--<div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i--}}
                            {{--class="fa fa-font"></i><b class="caret"></b></a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i--}}
                            {{--class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>--}}
                            {{--<ul class="dropdown-menu">--}}
                            {{--<li>--}}
                            {{--<a data-edit="fontSize 5">--}}
                            {{--<p style="font-size:17px">Huge</p>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a data-edit="fontSize 3">--}}
                            {{--<p style="font-size:14px">Normal</p>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--<li>--}}
                            {{--<a data-edit="fontSize 1">--}}
                            {{--<p style="font-size:11px">Small</p>--}}
                            {{--</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i--}}
                            {{--class="fa fa-bold"></i></a>--}}
                            {{--<a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i--}}
                            {{--class="fa fa-italic"></i></a>--}}
                            {{--<a class="btn" data-edit="strikethrough" title="Strikethrough"><i--}}
                            {{--class="fa fa-strikethrough"></i></a>--}}
                            {{--<a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i--}}
                            {{--class="fa fa-underline"></i></a>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i--}}
                            {{--class="fa fa-list-ul"></i></a>--}}
                            {{--<a class="btn" data-edit="insertorderedlist" title="Number list"><i--}}
                            {{--class="fa fa-list-ol"></i></a>--}}
                            {{--<a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i--}}
                            {{--class="fa fa-dedent"></i></a>--}}
                            {{--<a class="btn" data-edit="indent" title="Indent (Tab)"><i--}}
                            {{--class="fa fa-indent"></i></a>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i--}}
                            {{--class="fa fa-align-left"></i></a>--}}
                            {{--<a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i--}}
                            {{--class="fa fa-align-center"></i></a>--}}
                            {{--<a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i--}}
                            {{--class="fa fa-align-right"></i></a>--}}
                            {{--<a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i--}}
                            {{--class="fa fa-align-justify"></i></a>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i--}}
                            {{--class="fa fa-link"></i></a>--}}
                            {{--<div class="dropdown-menu input-append">--}}
                            {{--<input class="span2" placeholder="URL" type="text"--}}
                            {{--data-edit="createLink"/>--}}
                            {{--<button class="btn" type="button">Add</button>--}}
                            {{--</div>--}}
                            {{--<a class="btn" data-edit="unlink" title="Remove Hyperlink"><i--}}
                            {{--class="fa fa-cut"></i></a>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i--}}
                            {{--class="fa fa-picture-o"></i></a>--}}
                            {{--<input type="file" data-role="magic-overlay" data-target="#pictureBtn"--}}
                            {{--data-edit="insertImage"/>--}}
                            {{--</div>--}}
                            {{--<div class="btn-group">--}}
                            {{--<a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i--}}
                            {{--class="fa fa-undo"></i></a>--}}
                            {{--<a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i--}}
                            {{--class="fa fa-repeat"></i></a>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--<div id="editor" class="editor-wrapper"></div>--}}
                            {{--<textarea name="descr" id="descr" style="display:none;"></textarea>--}}
                            {{--</div>--}}
                            {{--</div>--}}
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
                        <h2>{{$lang['title_publish']}}
                            {{--<small>different form elements</small>--}}
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                            {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Settings 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Settings 2</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            <li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i
                                            class="fa fa-chevron-up"></i></a></li>
                            {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="form-group">
                            <label class="control-label">{{$lang['text_status']}}:</label>
                            <div class="radio">
                                <label class="pl10 mb5">
                                    <div class="iradio_flat-green">
                                        <input type="radio" class="flat" name="flag" value="1"
                                                {{isset($form_data->flag) ?($form_data->flag==1?'checked':''):'checked'}}>
                                    </div>
                                    {{$lang['radio_show']}}
                                </label>
                                <label class="pl10 mb5">
                                    <div class="iradio_flat-green">
                                        <input type="radio" class="flat" name="flag" value="2"
                                                {{isset($form_data->flag) && $form_data->flag==2?'checked':''}}>
                                    </div>
                                    {{$lang['radio_draft']}}
                                </label>
                            </div>
                        </div>
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

                {{--Category panel--}}
                {{--<div class="x_panel">--}}
                {{--<div class="x_title">--}}
                {{--<h2>{{$lang['title_category']}}--}}
                {{--<small>different form elements</small>--}}
                {{--</h2>--}}
                {{--<ul class="nav navbar-right panel_toolbox">--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                {{--<li><a href="#">Settings 1</a>--}}
                {{--</li>--}}
                {{--<li><a href="#">Settings 2</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i class="fa fa-chevron-up"></i></a></li>--}}
                {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
                {{--</ul>--}}
                {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="x_content">--}}

                {{--</div>--}}
                {{--</div>--}}

                {{--Format panel--}}
                {{--<div class="x_panel">--}}
                {{--<div class="x_title">--}}
                {{--<h2>{{$lang['title_format']}}--}}
                {{--<small>different form elements</small>--}}
                {{--</h2>--}}
                {{--<ul class="nav navbar-right panel_toolbox">--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                {{--<li><a href="#">Settings 1</a>--}}
                {{--</li>--}}
                {{--<li><a href="#">Settings 2</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i class="fa fa-chevron-up"></i></a></li>--}}
                {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
                {{--</ul>--}}
                {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="x_content">--}}

                {{--</div>--}}
                {{--</div>--}}

                {{--Tag panel--}}
                {{--<div class="x_panel">--}}
                {{--<div class="x_title">--}}
                {{--<h2>{{$lang['title_tag']}}--}}
                {{--<small>different form elements</small>--}}
                {{--</h2>--}}
                {{--<ul class="nav navbar-right panel_toolbox">--}}
                {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                {{--<ul class="dropdown-menu" role="menu">--}}
                {{--<li><a href="#">Settings 1</a>--}}
                {{--</li>--}}
                {{--<li><a href="#">Settings 2</a>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
                {{--<li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i class="fa fa-chevron-up"></i></a></li>--}}
                {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
                {{--</ul>--}}
                {{--<div class="clearfix"></div>--}}
                {{--</div>--}}
                {{--<div class="x_content">--}}

                {{--</div>--}}
                {{--</div>--}}

                {{--Images panel--}}
                <div class="x_panel">
                    <div class="x_title">
                        <h2>{{$lang['title_images']}}
                            {{--<small>different form elements</small>--}}
                        </h2>
                        <ul class="nav navbar-right panel_toolbox">
                            {{--<li class="dropdown">--}}
                            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"--}}
                            {{--aria-expanded="false"><i class="fa fa-wrench"></i></a>--}}
                            {{--<ul class="dropdown-menu" role="menu">--}}
                            {{--<li><a href="#">Settings 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#">Settings 2</a>--}}
                            {{--</li>--}}
                            {{--</ul>--}}
                            {{--</li>--}}
                            <li><a class="collapse-link" data-toggle="tooltip" title="{{$lang['button_collapse']}}"><i
                                            class="fa fa-chevron-up"></i></a></li>
                            {{--<li><a class="close-link"><i class="fa fa-close"></i></a></li>--}}
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