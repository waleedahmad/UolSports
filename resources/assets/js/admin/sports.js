$('.sport-checkbox').on('change', function(e){
    if($(this).is(':checked')){
        enableSport($(this).val());
    }else{
        disableSport($(this).val());
    }
});

function disableSport(sport){
    $.ajax({
        type : 'POST',
        url : '/admin/sports/disable',
        data : {
            sport : sport,
            _token : getCsrfToken()
        },
        success : function(res){
            if(res.disabled){
                toastr.success(`Sport ${sport} disabled`);
            }
        }.bind(this)
    });
}

function enableSport(sport){
    $.ajax({
        type : 'POST',
        url : '/admin/sports/enable',
        data : {
            sport : sport,
            _token : getCsrfToken()
        },
        success : function(res){
            if(res.enabled){
                toastr.success(`Sport ${sport} enabled`);
            }
        }.bind(this)
    });
}