$(document).ready(function () {

    $('#btn_save').click(function (e) {
        e.preventDefault();

        if (validate()) {
            loading_show();
            remove_alert();
            $.ajax({
                type: 'POST',
                url: 'controller/paymentCtr?option=4',
                data: $('form[name="form-payment"]').serialize(),
                error: function (jqXHR, textStatus, errorThrown) {
                    //*Ocurrió un eror en la petición ajax
                    console.log(textStatus + '\n' + errorThrown);
                },
                success: function (result) {
                    var data = JSON.parse(result);

                    if (data.status) {
                        alert_result(1, data.msg);

                        setTimeout(function () {
                            window.location = data.res;
                        }, 1000);
                    } else {
                        alert_result(4, data.msg);
                    }
                    loading_hide();
                }
            });
        }
    });
});

function validate() {

    remove_alert();
    $('#el_type_payment').removeClass('has-error');
    $('#el_bank_id').removeClass('has-error');
    $('#el_type_document').removeClass('has-error');
    $('#el_document').removeClass('has-error');
    $('#el_name').removeClass('has-error');
    $('#el_last_name').removeClass('has-error');
    $('#el_company').removeClass('has-error');
    $('#el_email_address').removeClass('has-error');
    $('#el_address').removeClass('has-error');
    $('#el_province').removeClass('has-error');
    $('#el_city').removeClass('has-error');
    $('#el_phone').removeClass('has-error');
    $('#el_mobile').removeClass('has-error');

    if ($('select[name="x_type_payment"]').val() === '') {
        alert_result(4, 'Seleccione el tipo de pago');
        $('#el_type_payment').addClass('has-error');
        return false;
    }

    if ($('select[name="x_bank_id"]').val() == 0) {
        alert_result(4, 'Seleccione el banco');
        $('#el_bank_id').addClass('has-error');
        return false;
    }

    if ($('select[name="x_type_document"]').val() == 0) {
        alert_result(4, 'Seleccione el tipo de documento');
        $('#el_type_document').addClass('has-error');
        return false;
    }

    if ($('input[name="x_document"]').val() === '') {
        alert_result(4, 'Ingrese el número de documento');
        $('#el_document').addClass('has-error');
        return false;
    }

    if ($('input[name="x_name"]').val() === '') {
        alert_result(4, 'Ingrese el nombre completo');
        $('#el_name').addClass('has-error');
        return false;
    }

    if ($('input[name="x_last_name"]').val() === '') {
        alert_result(4, 'Ingrese los apellidos completos');
        $('#el_last_name').addClass('has-error');
        return false;
    }

    if ($('input[name="x_email_address"]').val() === '') {
        alert_result(4, 'Ingrese el correo electrónico');
        $('#el_email_address').addClass('has-error');
        return false;
    }

    if ($('input[name="x_address"]').val() === '') {
        alert_result(4, 'Ingrese la dirección postal completa');
        $('#el_address').addClass('has-error');
        return false;
    }

    if ($('select[name="x_province"]').val() === '') {
        alert_result(4, 'Seleccione el departamento de residencia');
        $('#el_province').addClass('has-error');
        return false;
    }

    if ($('select[name="x_city"]').val() === '') {
        alert_result(4, 'Seleccione la ciudad de residencia');
        $('#el_city').addClass('has-error');
        return false;
    }

    if ($('input[name="x_mobile"]').val() === '') {
        alert_result(4, 'Ingrese su número celular');
        $('#el_mobile').addClass('has-error');
        return false;
    }

    return true;
}

function load_back_list() {

    $.ajax({
        type: 'POST',
        url: 'controller/paymentCtr?option=1',
        data: {},
        error: function (jqXHR, textStatus, errorThrown) {
            //*Ocurrió un eror en la petición ajax
            console.log(textStatus + '\n' + errorThrown);
        },
        success: function (result) {
            var data = JSON.parse(result);
            if (data.status) {
                $('select[name="x_bank_id"]').append(data.res);
            } else
            {
                console.log(data.msg)
            }
            loading_hide();
        }
    });
}

function load_province_list() {

    $.ajax({
        type: 'POST',
        url: 'controller/paymentCtr?option=2',
        data: {},
        error: function (jqXHR, textStatus, errorThrown) {
            //*Ocurrió un eror en la petición ajax
            console.log(textStatus + '\n' + errorThrown);
        },
        success: function (result) {
            var data = JSON.parse(result);
            if (data.status) {
                $('select[name="x_province"]').append(data.res);
            } else
            {
                console.log(data.res)
            }
        }
    });
}

function load_city_list() {

    var province = $('select[name="x_province"]').val();
    $.ajax({
        type: 'POST',
        url: 'controller/paymentCtr?option=3',
        data: {province: province},
        error: function (jqXHR, textStatus, errorThrown) {
            //*Ocurrió un eror en la petición ajax
            console.log(textStatus + '\n' + errorThrown);
        },
        success: function (result) {
            var data = JSON.parse(result);
            if (data.status) {
                $('select[name="x_city"]').html(data.res);
            } else
            {
                console.log(data.msg)
            }
        }
    });
}

function payment_list() {

    loading_show();
    $.ajax({
        type: 'POST',
        url: 'controller/paymentCtr?option=5',
        data: {},
        error: function (jqXHR, textStatus, errorThrown) {
            //*Ocurrió un eror en la petición ajax
            console.log(textStatus + '\n' + errorThrown);
        },
        success: function (result) {
            var data = JSON.parse(result);

            $('.paymentList').html(data.res);
            loading_hide();
        }
    });
}

function payment_result() {

    loading_show();
    $.ajax({
        type: 'POST',
        url: 'controller/paymentCtr?option=6',
        data: {},
        error: function (jqXHR, textStatus, errorThrown) {
            //*Ocurrió un eror en la petición ajax
            console.log(textStatus + '\n' + errorThrown);
        },
        success: function (result) {
            var data = JSON.parse(result);

            if (data.status) {
                alert_result(1, data.msg);

                setTimeout(function () {
                    window.location = data.res;
                }, 3000);
            } else {
                alert_result(4, data.msg);

                setTimeout(function () {
                    window.location = data.res;
                }, 2000);
            }
            loading_hide();
        }
    });
}