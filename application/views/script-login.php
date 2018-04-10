<script type="text/javascript">
    $(function() {
        if (localStorage.chkbx && localStorage.chkbx != '') {
            $('#remember_me').attr('checked', 'checked');
            $('#username').val(localStorage.usrname);
            $('#password').val(localStorage.password);
        } else {
            $('#remember_me').removeAttr('checked');
            $('#username').val('');
            $('#password').val('');
        }

        $('#remember_me').click(function() {

            if ($('#remember_me').is(':checked')) {
                // save username and password
                localStorage.usrname = $('#username').val();
                localStorage.password = $('#password').val();
                localStorage.chkbx = $('#remember_me').val();
            } else {
                localStorage.usrname = '';
                localStorage.password = '';
                localStorage.chkbx = '';
            }
        });

        if($('#username').val() != ''){
            $('.form-group:eq( 0 )').addClass('do-float');
        }
        if($('#password').val() != ''){
            $('.form-group:eq( 1 )').addClass('do-float');
        }
        $('#username').on('focus', function(){
            $('#username').removeClass('is-invalid');
        });
        $('#password').on('focus', function(){
            $('#password').removeClass('is-invalid');
        });
        $('#confirm_password').on('focus', function(){
            $('#confirm_password').removeClass('is-invalid');
        });
        $('#username').bind("change keyup",function(){
            $('.form-group:eq( 1 )').addClass('do-float');
        });
    });
    
    $("#form-login").submit(function(e) {
        var valid = true;
        
        $('#username').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
        $('.invalid-feedback').remove();
        if($('#username').val() == ''){
            $('#username').addClass('is-invalid');
            $('<div class="invalid-feedback">Nama user harus diisi.</div>').insertAfter('label[for="username"]');
            valid = false;
        }
        
        if($('#password').val() == ''){
            $('#password').addClass('is-invalid');
            $('<div class="invalid-feedback">Kata sandi harus diisi.</div>').insertAfter('label[for="password"]');
            valid = false;
        }

        if(valid == false){
            return false; //is superfluous, but I put it here as a fallback
        }
    });

    $('#confirm_password').keyup(function(e){
        if ($('#password').val() != '') {
            if ($('#confirm_password').val() != $('#password').val()) {
                $('#confirm_password').removeClass('is-valid is-invalid').addClass('is-invalid');
                $('.confirm').remove();
                $('<div class="invalid-feedback confirm">Password yang diulangi tidak sesuai.</div>').insertAfter('label[for="confirm_password"]');
            } else {
                $('#confirm_password').addClass('is-valid');
                $('.confirm').remove();
            }
        }
    });

    $('#form-reset').submit(function(e) { 
        var valid = true;
        $('#username').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
        $('#confirm_password').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        $('.invalid-feedback').removeClass();
        if($('#username').val() == ''){
            $('#username').addClass('is-invalid');
            $('<div class="invalid-feedback">Username harus diisi.</div>').insertAfter('label[for="username"]');
            valid = false;
        }
        
        if($('#password').val() == ''){
            $('#password').addClass('is-invalid');
            $('<div class="invalid-feedback">Password baru harus diisi.</div>').insertAfter('label[for="password"]');
            valid = false;
        }

        if ($('#confirm_password').val() == '') {
            $('#confirm_password').addClass('is-invalid');
            $('<div class="invalid-feedback confirm">Ulangi password baru.</div>').insertAfter('label[for="confirm_password"]');
            valid = false;
        } else if ($('#confirm_password').val() != $('#password').val()) {
            $('#confirm_password').addClass('is-invalid');
            $('<div class="invalid-feedback confirm">Password yang diulangi tidak sesuai.</div>').insertAfter('label[for="confirm_password"]');
            valid = false;
        }

        if (valid == false) {
            return false;
        }
    });
</script>