$(function(){
    var from = 0,
        to = 0,
        current = 0,
        animateRate = 0;

    from = $('#money-progress').data('from');
    to = $('#money-progress').data('to');
    current = $('#money-progress').data('current'),

    animateRate = current / to;
    animateRate = animateRate < 1 ? animateRate : 1;

    var lineBar = new ProgressBar.Line('#money-progress', {
        strokeWidth: 4,
        from: {
            color: '#ff4d00'
        },
        to: {
            color: '#00ff5b'
        },
        step: (state, shape) => {
            shape.path.setAttribute("stroke", state.color);
        }
    });

    lineBar.animate(animateRate, {
        duration: 1000
    });
})

$('#bonus-promocode').submit(function(e){
    e.preventDefault();
    var url = $(this).attr('action');
    $.ajax({
        method: 'POST',
        url: url,
        data: $(this).serialize(),
        success: function(data){
            var result = JSON.parse(data);
            $('#user-bonus-balance').html(result.balance);
            $('.client-promocode__form-response').addClass(result.status).html(result.message);
            console.log(result);
        }
    });
});