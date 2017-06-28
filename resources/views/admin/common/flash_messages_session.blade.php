@if(Session::has('error_msg'))
    <div class="alert alert-danger alert-dismissible fade in">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        {{Session::get('error_msg')}}
    </div>
@endif
@if(Session::has('success_msg'))
    <div class="alert alert-dismissable alert-success">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        {{Session::get('success_msg')}}
    </div>
@endif
@if(Session::has('warning_msg'))
    <div class="alert alert-dismissable alert-warning">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        {{Session::get('warning_msg')}}
    </div>
@endif

@if(Session::has('notice_msg'))
    <div class="alert alert-dismissable alert-info">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span></button>
        {{Session::get('notice_msg')}}
    </div>
@endif