$(function() {
    $('.popup-modal').magnificPopup({
    });
});

window.onload= function() {
    document.getElementById('toggler').onclick = function()
    {
        openbox('box', this);
        return false;
    };
};
function openbox(id, toggler) {
    var div = document.getElementById(id);
    if(div.style.display == 'block') {
        div.style.display = 'none';

    }
    else {
        div.style.display = 'block';


    }
}

$(document).on('af_complete', function(event, response) {
    if(response.success == true) {
        var modal = response.form.parents('.modal-body');
        modal.text('Ваше сообщение успешно отправлено');
    }
});