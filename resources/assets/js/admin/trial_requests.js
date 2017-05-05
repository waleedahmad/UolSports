$('.schedule-trial').on('click', function(){
    let id = $(this).attr('data-id');

    $.get('/templates/trial_request.html', function(template){

        $.ajax({
            type : 'GET',
            url : '/admin/trial/request',
            data : {
                id : id,
            },
            success : function(data){
                console.log(data);
            }
        });
        var rendered = Mustache.render(template, {name: "Luke"});
        $('#modal').html(rendered);
        $('.overlay-model').modal('show');
        registerModalCloseHanlder();
    });
});

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
                    url : '/admin/trial/request',
                    data : {
                        id : id,
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