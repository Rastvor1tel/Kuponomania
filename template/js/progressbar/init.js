$(function(){
    var from = 0,
        to = 0,
        current = 0,
        animateRate = 0;

    from = $('#money-progress').data('from');
    to = $('#money-progress').data('to');
    current = $('#money-progress').data('current'),

    animateRate = current / to;
    console.log(animateRate);

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