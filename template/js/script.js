window.onload = function () {
    document.getElementById('toggler').onclick = function () {
        openbox('box', this);
        return false;
    };
};

function openbox(id, toggler) {
    var div = document.getElementById(id);
    if (div.style.display == 'block') {
        div.style.display = 'none';

    } else {
        div.style.display = 'block';
    }
}

$(document).on('af_complete', function (event, response) {
    if (response.success == true) {
        var modal = response.form.parents('.modal-body');
        modal.text('Ваше сообщение успешно отправлено');
    }
});

$('.categories-readmore').on("click", function toggleMenu() {
    $('.categories').slideToggle();
    $('.categories-readmore').text(function (i, text) {
        return text === "Смотреть категории" ? "Свернуть" : "Смотреть категории";
    });
});

$(function () {
    $('#photo').change(function (e) {
        if (!window.FileReader) {
            console.log('Браузер не поддерживает File API');
            return;
        }
        var file = e.target.files[0];
        if (!((file.type == 'image/png') || (file.type == 'image/jpeg'))) {
            $('#img-error').text('Загруженный файл не является изображением');
            return;
        }
        if (file.size >= 8388608) {
            $('#img-error').text('Размер файла больше чем 8Мб');
            return;
        }
        $('#img-error').text('');
        var reader = new FileReader();
        $(reader).on('load', function (event) {
            $('#img-photo').attr('src', event.target.result);
            if ($('#img-photo').width() >= $('#img-photo').height()) {
                $('#img-photo').css('height', '100px');
                $('#img-photo').css('margin-left', -($('#img-photo').width() - 100) / 2);
            } else {
                $('#img-photo').css('widht', '100px');
                $('#img-photo').css('margin-top', -($('#img-photo').height() - 100) / 2);
            }
        });
        reader.readAsDataURL(file);
    });
    $("#updateProfile").submit(function (e) {
        if ($('#photo').val() == '') {
            return;
        }
        if ((($('#img-error').text()).length > 0)) {
            e.preventDefault();
        }
    });
});