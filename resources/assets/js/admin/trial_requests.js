/**
 * Schedule a trial
 */
$('.schedule-trial').on('click', function(){
    let id = $(this).attr('data-id');

    $.get('/templates/trial_request.html', function(template){

        $.ajax({
            type : 'GET',
            url : '/admin/trial',
            data : {
                id : id,
                planned : false
            },
            success : function(data){
                renderModal(Mustache.render(template, {
                    sport : data.sport,
                    user : data.user,
                    id : id
                }));
                attachSchedulerHandlers();
            }
        });

    });
});

/**
 * Attach overlay handlers for trial scheduling
 */
function attachSchedulerHandlers(){
    let $schedule_time = $("#schedule-time"),
        $schedule_date = $("#schedule-date");
    $('#schedule-trial').on('click', processTrialSchedule);
    $($schedule_date).datepicker({
        onSelect : function(value){
            clearSchedulerError();
        },
        dateFormat: 'yy-mm-dd'
    });
    $($schedule_time).timepicker({
        step : function(i) {
            return 30;
        },
    }).keypress(function(e){
        e.preventDefault();
    });

    $($schedule_time).on('changeTime', function(){
        clearSchedulerError();
    });

    //console.log( moment("4:15PM", ["h:mmA"]).format("HH:mm:ss"));
    //console.log(moment(new Date()).format('YY-MM-DD'));
}


/**
 * Process trial scheduling form
 * @param e
 */
function processTrialSchedule(e){
    e.preventDefault();
    let date = getSchedulerDate(),
        time = getSchedulerTime(),
        id = getScheduleTrialID();

    if(date.length && time.length){
        if(validateDate(date, time)){
            $(this).off('click');
            scheduleTrial(id,date + ' ' + formatTimeTo24Hours(time));
        }else{
            $('.error').html('Error : The date or time has already passed');
        }
    }else{
        $('.error').html('Please provide a valid Date and Time to schedule a trial');
    }
}

/**
 * Schedule a trial
 * @param id
 * @param timestamp
 */
function scheduleTrial(id, timestamp){
    console.log(id, timestamp);

    $.ajax({
        type : 'POST',
        url : '/admin/trial',
        data : {
            id : id,
            timestamp : timestamp,
            _token : getCsrfToken()
        },
        success : function(processed){
            if(processed){
                closeModal();
                $('.trial-requests').find('.request[data-id='+id+']').slideUp(function(e){
                    $(this).remove();
                });
                toastr.success('Trial successfully scheduled');
            }
        }
    })
}

/**
 * Validate date
 * Check if value passed has already passed or not
 * @param date
 * @param time
 * @returns {boolean}
 */
function validateDate(date, time){
    let selected = moment(date + ' ' + formatTimeTo24Hours(time)),
        now = moment(new Date());
    return selected.diff(now) > 0;
}

/**
 * Format 12 hours time to 24 hours
 * @param time
 */
function formatTimeTo24Hours(time){
    return moment(time, ["h:mmA"]).format("HH:mm:ss");
}

/**
 * Get schedule date from overlay
 * @returns {*|jQuery}
 */
function getSchedulerDate(){
    return $('#schedule-date').val();
}

/**
 * Get schedule time from overlay
 * @returns {*|jQuery}
 */
function getSchedulerTime(){
    return $('#schedule-time').val();
}

/**
 * Clear schedule overlay error
 */
function clearSchedulerError(){
    $('.error').text('');
}

function getScheduleTrialID(){
    return $('#schedule-trial').attr('data-id');
}

/**
 * Delete trial request
 */
$('.delete-trial-request').on('click', function(){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: `Are you sure you want to delete this trial request`,
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
                    type  : 'DELETE',
                    url : '/admin/trial',
                    data : {
                        id : id,
                        planned : false,
                        _token : getCsrfToken()
                    },
                    success : function(done){
                        if(done){
                            $(this).parents('.request').slideUp().then(function(){
                                $(this).remove();
                            });
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});