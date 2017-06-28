<!-- validator -->
<script src="{{$asset_path}}vendors/validator/validator.js"></script>
<!-- validator -->
<script>
    // initialize the validator function
    validator.message.invalid = '{{$lang['msg_validate_invalid']}}';
    validator.message.checked = '{{$lang['msg_validate_checked']}}';
    validator.message.empty = '{{$lang['msg_validate_empty']}}';
    validator.message.min = '{{$lang['msg_validate_min']}}';
    validator.message.max = '{{$lang['msg_validate_max']}}';
    validator.message.number_min = '{{$lang['msg_validate_number_min']}}';
    validator.message.number_max = '{{$lang['msg_validate_number_max']}}';
    validator.message.url = '{{$lang['msg_validate_url']}}';
    validator.message.number = '{{$lang['msg_validate_number']}}';
    validator.message.email = '{{$lang['msg_validate_email']}}';
    validator.message.email_repeat = '{{$lang['msg_validate_email_repeat']}}';
    validator.message.password_repeat = '{{$lang['msg_validate_password_repeat']}}';
    validator.message.repeat = '{{$lang['msg_validate_repeat']}}';
    validator.message.complete = '{{$lang['msg_validate_complete']}}';
    validator.message.select = '{{$lang['msg_validate_select']}}';
    validator.message.date = '{{$lang['msg_validate_date']}}';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
            .on('blur', 'input[required], input.optional, select.required', validator.checkField)
            .on('change', 'select.required', validator.checkField)
            .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required').on('keyup blur', 'input', function () {
        validator.checkField.apply($(this).siblings().last()[0]);
    });
    $('form').submit(function (e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this)))
            submit = false;
        if (submit)
            this.submit();
        return false;
    });
</script>
<!-- /validator -->