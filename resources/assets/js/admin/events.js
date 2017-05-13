let $date = $('#event-date'),
    $time = $('#event-time'),
    $event_sport = $('#event-sport'),
    $team1 = $('#event-sport-team1'),
    $team2 = $('#event-sport-team2'),
    $add_event = $('#add-event'),
    $event_errors =$('#event-errors'),
    event_errors = [];

$($date).datepicker({
    onSelect : function(value){
        clearSchedulerError();
    },
    dateFormat: 'yy-mm-dd'
});

$($time).timepicker({
    step : function(i) {
        return 30;
    },
}).keypress(function(e){
    e.preventDefault();
});

$($event_sport).on('change', function(e){
    let sport_id = $(this).val();
    if(sport_id.length){
        $.ajax({
            type : 'GET',
            url : '/admin/sports/teams',
            data : {
                sport_id : sport_id,
            },
            success : function(teams){
                if(teams.length){
                    renderSportTeams(teams);
                }else{
                    clearEventTeams();
                }
            }
        });
    }
});

function renderSportTeams(teams){
    clearEventTeams();
    teams.forEach(function(team){
        $($team1).append($("<option/>", {
            value: team.id,
            text: team.name + ' - ' + team.department
        }));
        $($team2).append($("<option/>", {
            value: team.id,
            text: team.name + '- ' + team.department
        }));
    });
}

function clearEventTeams(){
    $($team1).empty().append($("<option/>", {
        value: '',
        text: 'Select Team'
    }));
    $($team2).empty().append($("<option/>", {
        value: '',
        text: 'Select Team'
    }));
}

$($add_event).on('submit', function(e){
    let time = getEventTime(),
        date = getEventDate(),
        sport_id = getEventSport(),
        team_one = getTeamOne(),
        team_two = getTeamTwo();

    clearEventErrors();

    if( time.length &&
        date.length &&
        sport_id.length &&
        team_one.length &&
        team_two.length &&
        team_one !== team_two
    ){
        if(validateDate(date, time)){
            $(this).trigger('submit');
        }else{
            e.preventDefault();
            if(!validateDate(date, time)){
                event_errors.push('Date or time has passed');
            }
            renderEventErrors();
        }
    }else{
        e.preventDefault();
        if(!time.length){
            event_errors.push('Time required');
        }

        if(!date.length){
            event_errors.push('Date required');
        }

        if(!sport_id.length){
            event_errors.push('Sport required');
        }

        if(!team_one.length){
            event_errors.push('First team required');
        }

        if(!team_two.length){
            event_errors.push('Second team required');
        }



        if(team_one === team_two){
            event_errors.push('Select different teams to create event');
        }
        renderEventErrors();
    }
});

function getEventTime(){
    return $($time).val();
}

function getEventDate(){
    return $($date).val();
}

function getEventSport(){
    return $($event_sport).val();
}

function getTeamOne(){
    return $($team1).val();
}

function getTeamTwo(){
    return $($team2).val();
}

function renderEventErrors(){
    event_errors.forEach(function(error){
        $($event_errors).append(`<li>${error}</li>`)
    });
    $($event_errors).slideDown();
}

function clearEventErrors(){
    event_errors = [];
    $($event_errors).empty();
}

$('.delete-event').on('click', function(e){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: "Are you sure you want to delete this event?",
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
                    type : 'DELETE',
                    url : '/admin/event',
                    context: this,
                    data : {
                        id : id,
                        _token : getCsrfToken()
                    },
                    success : function(deleted){
                        if(deleted){
                            $(this).parents('.event').slideUp(function(){
                                $(this).remove();
                                toastr.success('Event deleted');
                            });
                        }else{
                            bootbox.alert('Unable to delete event');
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});



