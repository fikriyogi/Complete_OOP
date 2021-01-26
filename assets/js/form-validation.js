
$(document).ready(function() {

    $.validator.setDefaults({ ignore: '' });

    
    $('form#demo-form').each(function () {

        $(this).validate({

            
            rules: {
                "first_name": { required: true, regex: /^[a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*[a-zA-Z1-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-][a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*$/, regexDoesNotMatch: /(?:(?:https?|ftp):\/\/)?[\w\/\-?=%.]+\.[\w\/\-?=%.]+/im, maxlength: 63,  }, 
                "last_name": { required: true, regex: /^[a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*[a-zA-Z1-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-][a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*$/, regexDoesNotMatch: /(?:(?:https?|ftp):\/\/)?[\w\/\-?=%.]+\.[\w\/\-?=%.]+/im, maxlength: 63,  }, 
                "country": { required: true,  }, 
                "city": { required: true, regex: /^[a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*[a-zA-Z1-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-][a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*$/, regexDoesNotMatch: /(?:(?:https?|ftp):\/\/)?[\w\/\-?=%.]+\.[\w\/\-?=%.]+/im, minlength: 2, maxlength: 31,  }, 
                "country_phone_code": { required: true,  }, 
                "phone_number": { required: true, regex: /^[0-9]+$/, minlength: 5, maxlength: 25,  }, 
                "email": { required: true, regex: /^[a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*[a-zA-Z1-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-][a-zA-Z0-9\#\:\"\[\]\;\?\(\)\+\@\$\=\!\`\&\*\.'\,\/\s\\_-]*$/, emailRegex: /^([a-zA-Z0-9\+_\-]+)(\.[a-zA-Z0-9\+_\-]+)*@(?![\-])([a-zA-Z0-9\-]+\.)+[a-zA-Z]{2,12}$/, maxlength: 47,  }, 
                "preferred_language": { required: true,  }, 
                "trading_platform_type": { required: true,  }, 
                "account_type": { required: true,  }, 
                "account_currency": { required: true,  }, 
                "account_leverage": { required: true,  }, 
                "investment_amount": { required: true,  }, 
                "account_password": { required: true, is_valid_password: true, regex: /^[a-zA-Z0-9\#\[\]\(\)\@\$\&\*\!\?\|\,\.\^\/\\+_-]+$/, betweenlength: [8,15],  }, 
                "account_password_confirmation": { required: true, equalTo: '#account_password',  },             },

            messages: {
                "first_name": { 
                    required: "Kolom <strong>Nama depan</strong> dibutuhkan", 
                    regex: "Lengkapi kolom <strong>Nama depan</strong> dengan alfabet latin saja.", 
                    regexDoesNotMatch: "Mohon selalu gunakan spasi setelah simbol titik.", 
                    maxlength: "<strong>Nama depan</strong> tidak boleh lebih dari sepanjang <strong>63</strong> karakter.",  
                }, 
                "last_name": { 
                    required: "Kolom <strong>Nama belakang</strong> dibutuhkan", 
                    regex: "Lengkapi kolom <strong>Nama belakang</strong> dengan alfabet latin saja.", 
                    regexDoesNotMatch: "Mohon selalu gunakan spasi setelah simbol titik.", 
                    maxlength: "<strong>Nama belakang</strong> tidak boleh lebih dari sepanjang <strong>63</strong> karakter.",  
                }, 
                "country": { 
                    required: "Silahkan pilih <strong>Negara tempat menetap</strong>",  
                }, 
                "city": { 
                    required: "Kolom <strong>Kota</strong> dibutuhkan", 
                    regex: "Lengkapi kolom <strong>Kota</strong> dengan alfabet latin saja.", 
                    regexDoesNotMatch: "Mohon selalu gunakan spasi setelah simbol titik.", 
                    minlength: "<strong>Kota</strong> setidaknya harus sepanjang <strong>2</strong> karakter", 
                    maxlength: "<strong>Kota</strong> tidak boleh lebih dari sepanjang <strong>31</strong> karakter.",  
                }, 
                "country_phone_code": { 
                    required: "Silahkan pilih <strong>Kode</strong>",  }, 
                "phone_number": { 
                    required: "Kolom <strong>Telepon</strong> dibutuhkan", 
                    regex: "Kolom <strong>Telepon</strong> hanya dapat berisi angka", 
                    minlength: "<strong>Telepon</strong> setidaknya harus sepanjang <strong>5</strong> karakter", 
                    maxlength: "<strong>Telepon</strong> tidak boleh lebih dari sepanjang <strong>25</strong> karakter.",  
                }, 
                "email": { 
                    required: "Kolom <strong>E-mail</strong> dibutuhkan", 
                    regex: "Lengkapi kolom <strong>E-mail</strong> dengan alfabet latin saja.", emailRegex: "Kolom <strong>E-mail</strong> harus berisi alamat email yang valid", maxlength: "<strong>E-mail</strong> tidak boleh lebih dari sepanjang <strong>47</strong> karakter.",  }, "preferred_language": { required: "Silahkan pilih <strong>Pilihan Bahasa</strong>",  }, "trading_platform_type": { required: "Silahkan pilih <strong>Tipe Platform Trading</strong>",  }, "account_type": { required: "Silahkan pilih <strong>Tipe Akun</strong>",  }, "account_currency": { required: "Silahkan pilih <strong>Mata Uang dalam Akun</strong>",  }, "account_leverage": { required: "Silahkan pilih <strong>Leverage</strong>",  }, "investment_amount": { required: "Silahkan pilih <strong>Jumlah Investasi</strong>",  }, "account_password": { required: "Kolom <strong>Kata sandi akun</strong> dibutuhkan", is_valid_password: "Kolom<strong>Kata sandi akun</strong> harus berisikan tiga tipe karakter: huruf kecil, huruf besar, dan angka.", regex: "Kolom <strong>Kata sandi akun</strong> hanya dapat dimasukkan karakter alfabet Inggris, angka, dan karakter spesial berikut ini: # [ ] ( ) @ $ & * ! ? | , . ^ / \\ + _ -", betweenlength: "Kolom <strong>Kata sandi akun</strong> harus sepanjang 8 dan 15 karakter.",  }, "account_password_confirmation": { required: "Kolom <strong>Konfirmasi kata sandi</strong> dibutuhkan", equalTo: "Kata sandi harus cocok.",  },             },

            ignore: '.ignore_validation',

            highlight: function (element, errorClass, validClass) {
                $(element)
                    .addClass(errorClass)
                    .removeClass(validClass);

                if ($(element).hasClass('select2-search__field')) {

                }
                else if ($(element).attr('type') != 'checkbox' && $(element).attr('type') != 'radio') {
                    var selectClass = ($(element).prop('type') == 'select-one') ? ' select' : '',
                        icon = '<div class="glyphicon-wrapper"><span class="glyphicon glyphicon-remove form-control-feedback'+ selectClass +'" aria-hidden="true"></span></div>';
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-success')
                        .addClass('has-error')
                        .end()
                        .siblings('.glyphicon-wrapper').remove()
                        .end()
                        .before(icon);
                }

            },
            unhighlight: function (element, errorClass, validClass) {
                $(element)
                    .removeClass(errorClass)
                    .addClass(validClass);

                if ($(element).hasClass('select2-search__field')) {

                }
                else if ($(element).attr('type') != 'checkbox' && $(element).attr('type') != 'radio') {
                    var selectClass = ($(element).prop('type') == 'select-one') ? ' select' : '',
                        icon = '<div class="glyphicon-wrapper"><span aria-hidden="true" class="glyphicon glyphicon-ok form-control-feedback'+ selectClass +'"></span></div>';
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-error')
                        .addClass('has-success')
                        .end()
                        .siblings('.glyphicon-wrapper').remove()
                        .end()
                        .before(icon);

                    if ($(element).parents('.remove-valid').length) {

                        $(element)
                            .removeClass('valid')
                            .closest('.form-group')
                            .removeClass('has-success')
                            .end()
                            .siblings('.glyphicon-wrapper').remove();
                    }
                }
            },

            errorPlacement: function (error, element) {
                
                if (element.siblings('.input-group-addon').length > 0) {
                    $(element)
                        .closest('.input-group')
                        .after(error);
                }

                else if (element.closest('.form-group').find('.search-select').length > 0) {
                    $(element)
                        .closest('.form-group').find('.select2-container')
                        .after(error);
                }

                else if (element.closest('.form-group').find('.btn-group').length > 0) {
                    $(element)
                        .closest('.form-group').find('.btn-group')
                        .after(error);
                }

                else if (element.attr('type') == 'file') {
                    $(element)
                        .closest('.input-group')
                        .after(error);
                }
                else if (element.attr('type') == 'checkbox') {
                    $(element)
                        .closest('.form-group')
                        .append(error);
                }
                else if (element.attr('type') == 'radio') {
                    $(element)
                        .closest('label')
                        .siblings('span')
                        .after(error);
                }
                else if (typeof element.attr('data-select2-dropdown') != 'undefined') {
                    $(element)
                        .closest('.form-group')
                        .append(error);
                }
                else {
                    error.insertAfter(element);
                }
            },

            invalidHandler: function (form, validator) {
                scrollToObject($(validator.errorList[0].element));
                $(form.target).removeData('submitted').find('[type="submit"]').removeProp('disabled');
            },

            submitHandler: function (form) {
                                    $(form).find('button').text(pleaseWait);
                    $(form).find('button').attr('disabled', 'disabled');
                    form.submit();
                    return false;
                            }

        });

    });
    
    $('form#pre-chat-form,#pre-chat-form-member').each(function () {

        $(this).validate({

            
            rules: {
                "first_name": { required: true,  }, "last_name": { required: true,  }, "email": { required: true, email: true,  }, "user_id": { required: true, regex: /^[0-9]+$/,  }, "user_password": { required: true, regex: /^[a-zA-Z0-9\#\[\]\(\)\@$\&\*\!\?\|\,\.\^\/\\+_-]+$/,  }, "preferred_language": { required: true,  },             },

            messages: {
                "first_name": { required: "Kolom <strong>Nama depan</strong> dibutuhkan",  }, "last_name": { required: "Kolom <strong>Nama belakang</strong> dibutuhkan",  }, "email": { required: "Kolom <strong>E-mail</strong> dibutuhkan", email: "Kolom <strong>E-mail</strong> harus berisi alamat email yang valid",  }, "user_id": { required: "Kolom <strong>ID Pengguna</strong> dibutuhkan", regex: "Kolom ID Pengguna tidak valid",  }, "user_password": { required: "Kolom <strong>Kata Sandi:</strong> dibutuhkan", regex: "Kolom <strong>Kata Sandi:</strong> harus berisi alamat email yang valid",  }, "preferred_language": { required: "Kolom <strong>Pilihan Bahasa</strong> dibutuhkan",  },             },

            ignore: '.ignore_validation',

            highlight: function (element, errorClass, validClass) {
                $(element)
                    .addClass(errorClass)
                    .removeClass(validClass);

                if ($(element).hasClass('select2-search__field')) {

                }
                else if ($(element).attr('type') != 'checkbox' && $(element).attr('type') != 'radio') {
                    var selectClass = ($(element).prop('type') == 'select-one') ? ' select' : '',
                        icon = '<div class="glyphicon-wrapper"><span class="glyphicon glyphicon-remove form-control-feedback'+ selectClass +'" aria-hidden="true"></span></div>';
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-success')
                        .addClass('has-error')
                        .end()
                        .siblings('.glyphicon-wrapper').remove()
                        .end()
                        .before(icon);
                }

            },
            unhighlight: function (element, errorClass, validClass) {
                $(element)
                    .removeClass(errorClass)
                    .addClass(validClass);

                if ($(element).hasClass('select2-search__field')) {

                }
                else if ($(element).attr('type') != 'checkbox' && $(element).attr('type') != 'radio') {
                    var selectClass = ($(element).prop('type') == 'select-one') ? ' select' : '',
                        icon = '<div class="glyphicon-wrapper"><span aria-hidden="true" class="glyphicon glyphicon-ok form-control-feedback'+ selectClass +'"></span></div>';
                    $(element)
                        .closest('.form-group')
                        .removeClass('has-error')
                        .addClass('has-success')
                        .end()
                        .siblings('.glyphicon-wrapper').remove()
                        .end()
                        .before(icon);

                    if ($(element).parents('.remove-valid').length) {

                        $(element)
                            .removeClass('valid')
                            .closest('.form-group')
                            .removeClass('has-success')
                            .end()
                            .siblings('.glyphicon-wrapper').remove();
                    }
                }
            },

            errorPlacement: function (error, element) {
                
                if (element.siblings('.input-group-addon').length > 0) {
                    $(element)
                        .closest('.input-group')
                        .after(error);
                }

                else if (element.closest('.form-group').find('.search-select').length > 0) {
                    $(element)
                        .closest('.form-group').find('.select2-container')
                        .after(error);
                }

                else if (element.closest('.form-group').find('.btn-group').length > 0) {
                    $(element)
                        .closest('.form-group').find('.btn-group')
                        .after(error);
                }

                else if (element.attr('type') == 'file') {
                    $(element)
                        .closest('.input-group')
                        .after(error);
                }
                else if (element.attr('type') == 'checkbox') {
                    $(element)
                        .closest('.form-group')
                        .append(error);
                }
                else if (element.attr('type') == 'radio') {
                    $(element)
                        .closest('label')
                        .siblings('span')
                        .after(error);
                }
                else if (typeof element.attr('data-select2-dropdown') != 'undefined') {
                    $(element)
                        .closest('.form-group')
                        .append(error);
                }
                else {
                    error.insertAfter(element);
                }
            },

            invalidHandler: function (form, validator) {
                scrollToObject($(validator.errorList[0].element));
                $(form.target).removeData('submitted').find('[type="submit"]').removeProp('disabled');
            },

            submitHandler: function (form) {
                                    $(form).find('button').text(pleaseWait);
                    $(form).find('button').attr('disabled', 'disabled');
                    form.submit();
                    return false;
                            }

        });

    });
    });
