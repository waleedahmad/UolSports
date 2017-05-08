$('.players-list').on('click', function(e){
    let id = $(this).attr('data-id');

    $.get('/templates/players_list.html', function(template){

        $.ajax({
            type : 'GET',
            url : '/admin/team',
            data : {
                id : id,
                planned : true
            },
            success : function(data){
                renderModal(Mustache.render(template, {
                    team : data
                }));
                registerPlayerListEventHandlers();
            }
        });

    });
});

function registerPlayerListEventHandlers(){
    $('.remove-player').on('click', function(){
        let id = $(this).attr('data-id');

        bootbox.confirm({
            message: `Are you sure you want to delete this team?`,
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
                        url : '/admin/players/remove',
                        data : {
                            id : id,
                            _token : getCsrfToken()
                        },
                        success : function(removed){
                            if(removed){
                                $(this).parents('.player').slideUp().then(function(){
                                    $(this).remove();
                                });
                            }
                        }.bind(this)
                    })
                }
            }.bind(this)
        });
    });
}

$('.delete-team').on('click', function(e){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: `Are you sure you want to delete this team?`,
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
                    url : '/admin/team',
                    data : {
                        id : id,
                        _token : getCsrfToken()
                    },
                    success : function(deleted){
                        if(deleted){
                            $(this).parents('.team').slideUp().then(function(){
                                $(this).remove();
                            });
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });

});

$('.cancel-team').on('click', function(e){
    e.preventDefault();
    window.location = $(this).attr('href');
})