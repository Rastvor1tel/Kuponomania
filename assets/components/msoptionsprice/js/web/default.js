/*Параметры по размерам*/

var optionListner = function (element) {
	var price = 0;
	var priceCheched = 0;
	var priceSelect = 0;
	var spval = element.val();
	if (spval === 0) return false;
	$.each(msoptionsprice, function (key, value) {
		var ajson = msoptionsprice[key] !== '' ? jQuery.parseJSON(msoptionsprice[key]) : {};
		$.each($('input[name^="options[' + key + ']"]:checkbox:checked'), function (key, value) {
			if (element.attr('data-count')) {
				priceCheched += parseInt(ajson[element.val()]['price']) * parseInt(element.attr('data-count'));
			} else {
				priceCheched += parseInt(ajson[element.val()]['price']);
			}
		});
		$.each($('input[name="options[' + key + '][]"]:radio:checked'), function (key, value) {
			if (ajson[element.val()]) {
				priceCheched += parseInt(ajson[element.val()]['price']);
			}
		});
		$.each($('select[name="options[' + key + ']"] option:selected'), function (key, value) {
			if (ajson[element.val()]) {
				priceSelect += parseInt(ajson[element.val()]['price']);
			}
		});
		price = parseInt(priceCheched) + parseInt(priceSelect);
	});
	$('.pr_change').html(parseInt(price));
};

var price = 0;
$.each(msoptionsprice, function (key, value) {
	var ajson = msoptionsprice[key] !== '' ? jQuery.parseJSON(msoptionsprice[key]) : {};
	$('select[name="options[' + key + ']"]').change(function () {
		optionListner($(this));
	});

	$('input[name^="options[' + key + ']"]').change(function () {
		optionListner($(this));
	});

	$('span.minus, span.plus').click(function () {
		var input = $(this).closest('.count').find('input[name^="options[' + key + ']"]');
		if ($(this).hasClass('plus')) {
			$(input).attr('data-count', parseInt(input.attr('data-count')) + parseInt(1));
		} else if ($(this).hasClass('minus')) {
			$(input).attr('data-count', parseInt(input.attr('data-count')) - parseInt(1));
		}
		if ($(input).attr('data-count') > 0) {
			$(this).closest('.count').find('input[name^="options[' + key + ']"]').attr('checked', true);
		} else {
			$(this).closest('.count').find('input[name^="options[' + key + ']"]').attr('checked', false);
		}
		$('input[name^="options[' + key + ']"]').change();
	});

	if (ajson[$('select[name="options[' + key + ']"] option:selected').val()]) {
		price = parseInt(price) + parseInt(ajson[$('select[name="options[' + key + ']"] option:selected').val()]['price']);
	}
});

$(function () {
	if ($('#option_size').length > 0) {
		$('.pr_change').html(parseInt(price));
	}

	$('.popup-item__price').each(function () {
		var key = $(this).data('option'),
			item = jQuery.parseJSON(msoptionsprice['size']);
		$(this).html(item[key]['price'] + ' руб.');
	});

	$('.popup-item__button').click(function () {
		var newValue = $(this).data('value'),
			hiddenSelect = $('.hidden-block__option select'),
			productForm = $('.form-horizontal.ms2_form');
		hiddenSelect.val(newValue);
		optionListner(hiddenSelect);
		productForm.submit();
	});
});
