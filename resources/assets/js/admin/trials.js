$('.assign-team').on('click', function(){
    let id = $(this).attr('data-id');

    $.get('/templates/assign_team.html', function(template){

        $.ajax({
            type : 'GET',
            url : '/admin/trial',
            data : {
                id : id,
                planned : true
            },
            success : function(data){
                renderModal(Mustache.render(template, {
                    sport : data.trial.sport,
                    user : data.trial.user,
                    teams : data.teams,
                    id : id
                }));
                attachAssignTeamHandlers();

            }
        });

    });
});

function attachAssignTeamHandlers(){
    $('#assign-team').on('click', function(e){
        e.preventDefault();
        let team_id = $('#assign-team-id').val(),
            trial_id = $(this).attr('data-id');

        if(team_id.length){
            $.ajax({
                type : 'POST',
                url : '/admin/players/assign',
                data : {
                    trial_id : trial_id,
                    team_id : team_id,
                    _token : getCsrfToken()
                },
                success: function(assigned){
                    if(assigned){
                        closeModal();
                        $('.trials').find('.trial[data-id='+trial_id+']').slideUp(function(e){
                            $(this).remove();
                        });
                        toastr.success('Team successfully assigned');
                    }
                }
            })
        }else{
            $('.error').html('Error : Please select a team from dropdown');
        }
    });

    $('#assign-team-id').on('change', function(e){
        $('.error').html('');
    });
}


$('.reject-player').on('click', function(e){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: `Are you sure you want to reject this player?`,
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
                        planned : true,
                        _token : getCsrfToken()
                    },
                    success : function(done){
                        if(done){
                            $(this).parents('.trial').slideUp().then(function(){
                                $(this).remove();
                            });
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });
});
