$('.request-trial').on('click', requestTrial);

function requestTrial(e){
    let sport_id = $(this).attr('data-id'),
        sport_name = $(this).attr('data-name');

    $(this).off('click', requestTrial);

    bootbox.confirm({
        message: `Are you sure you want to submit trial request for ${sport_name}`,
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if(result){
                $.ajax({
                    type : 'POST',
                    url : '/sport/trial/request',
                    data : {
                        _token : getCsrfToken(),
                        sport_id : sport_id
                    },
                    success : function (res) {
                        if(res.created){
                            $(this).removeClass('request-trial').addClass('waiting-approval').text('Waiting approval').bind('click', waitingApproval);
                        }
                    }.bind(this)
                });
            }else{
                $(this).on('click', requestTrial);
            }
        }.bind(this)
    });
}

$('.waiting-approval').on('click', waitingApproval);

function waitingApproval(e){
    let sport_name = $(this).attr('data-name');
    bootbox.alert(`Your request for sport ${sport_name} is pending, please wait for approval.`);
}
