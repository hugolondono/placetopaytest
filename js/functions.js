$(document).ready(function () {


});

function loading_show()
{
    $('.ajax-loader').show();
    $('.wrapper').show();
}

function loading_hide()
{
    $('.ajax-loader').fadeOut('slow');
    $('.bg_load').fadeOut('slow');
    $('.wrapper').fadeOut('slow');
}

function modal(title, message)
{
    var modal = $('.modal');
    modal.find('.modal-title').text(title);
    modal.find('.modal-body').html(message);
    modal.modal('show');
}

function alert_result(type, message)
{
    var class_type = '';
    if (type === 1)
    {
        class_type = 'alert-success';
    } else if (type === 2)
    {
        class_type = 'alert-info';
    } else if (type === 3)
    {
        class_type = 'alert-warning';
    } else if (type === 4)
    {
        class_type = 'alert-danger';
    }

    var alert = $('.alert');
    alert.addClass(class_type);
    alert.find('.alert-text').text(message);
    alert.show();

    $('body,html').animate({scrollTop : 0}, 500);
}

function remove_alert()
{
    var alert = $('.alert');
    alert.removeClass();
    alert.addClass('alert alert-dismissable');
    alert.find('.alert-text').text('');
    alert.hide();
}