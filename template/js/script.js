$(document).on('af_complete', function (event, response) {
	if (response.success === true) {
		var modal = response.form.parents('.modal-body');
		modal.text('Ваше сообщение успешно отправлено');
	}
});

$('.categories-readmore').on('click', function toggleMenu() {
	$('.categories').slideToggle();
	$('.categories-readmore').text(function (i, text) {
		return text === 'Смотреть категории' ? 'Свернуть' : 'Смотреть категории';
	});
});

$('.js-prodcomments').on('click', function (e) {
	e.preventDefault();
	$('html, body').animate({
		scrollTop: $('.prod_comment').offset().top
	}, 2000);
});

/*timer*/

function renderTimer(time) {
	var $calc = $('.timer');
	var $days = $calc.find('.timer__days');
	var $hours = $calc.find('.timer__hours');
	var $minutes = $calc.find('.timer__minutes');
	var $seconds = $calc.find('.timer__seconds');

	time.days < 10 ? $days.html('0' + time.days) : $days.html(time.days);
	time.hours < 10 ? $hours.html('0' + time.hours) : $hours.html(time.hours);
	time.minutes < 10 ? $minutes.html('0' + time.minutes) : $minutes.html(time.minutes);
	time.seconds < 10 ? $seconds.html('0' + time.seconds) : $seconds.html(time.seconds);
}

function calcTimer(unix) {
	var t = unix - Date.parse(new Date());
	var seconds = Math.floor((t / 1000) % 60);
	var minutes = Math.floor((t / 1000 / 60) % 60);
	var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
	var days = Math.floor(t / (1000 * 60 * 60 * 24));

	return {
		'total': t,
		'days': days,
		'hours': hours,
		'minutes': minutes,
		'seconds': seconds
	};
}

window.updateTimer = function () {
	var timeRemain = $('.timer').data('time') * 1000;
	var time = calcTimer(timeRemain);
	renderTimer(time);
};

var popup = {
	close: function () {
		$('.popup').fadeOut().removeClass('js-isShowed');
	},
	open: function ($obj) {
		$obj.fadeToggle().toggleClass('js-isShowed');
	},
	toggle: function (obj) {
		var $obj = $(obj);
		if ($obj.hasClass('js-isShowed')) {
			this.close();
		} else {
			this.open($obj);
		}
	}
};
var handleOverlayClose = function (evt) {
	var target = evt.target;
	if ($('.js-isShowed').length > 0) {
		if (target !== document.querySelector('.popup__body') && target === document.querySelector('.js-isShowed').querySelector('.popup__overlay')) {
			popup.close();
			$('body').removeClass('overflow');
		}
	}

};
$(function () {
	$('#photo').change(function (e) {
		if (!window.FileReader) {
			console.log('Браузер не поддерживает File API');
			return;
		}
		var file = e.target.files[0];
		if (!((file.type === 'image/png') || (file.type === 'image/jpeg'))) {
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
			var photo = $('#img-photo');
			photo.attr('src', event.target.result);
			if (photo.width() >= photo.height()) {
				photo.css('height', '100px');
				photo.css('margin-left', -(photo.width() - 100) / 2);
			} else {
				photo.css('widht', '100px');
				photo.css('margin-top', -(photo.height() - 100) / 2);
			}
		});
		reader.readAsDataURL(file);
	});
	$('#updateProfile').submit(function (e) {
		if ($('#photo').val() === '') {
			return;
		}
		if ((($('#img-error').text()).length > 0)) {
			e.preventDefault();
		}
	});
	var timerInterval = setInterval(window.updateTimer, 1000);
	$('[data-modal]').click(function () {
		if (!$(this).hasClass('noneCoupons')) {
			if ($('.' + $(this).data('modal')).length) {
				popup.close();
				popup.toggle('.' + $(this).data('modal'));
				$('body').toggleClass('overflow');
			}
		}
	});
	$('.js-closePopup').click(function () {
		popup.close();
		$('body').removeClass('overflow');
	});

	$('.js-watchPopup').click(function (evt) {
		handleOverlayClose(evt);
	});

	$('#msCart .product-quantity').change(function () {
		var quantity = parseInt($(this).val()),
			basketItem = $(this).parents('.cart-item'),
			price = parseFloat(basketItem.find('.block.price .currency-content span').text()),
			newPrice = price * quantity;
		basketItem.find('.block.summ .currency-content.summ-price').html(newPrice);

	});
});




