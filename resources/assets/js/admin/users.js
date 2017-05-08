$('.delete-user').on('click', function(e){
    let id = $(this).attr('data-id');

    bootbox.confirm({
        message: `Are you sure you want to delete this user?`,
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
                    url : '/admin/users',
                    data : {
                        id : id,
                        _token : getCsrfToken()
                    },
                    success : function(deleted){
                        if(deleted){
                            $(this).parents('.user').slideUp().then(function(){
                                $(this).remove();
                            });
                        }
                    }.bind(this)
                })
            }
        }.bind(this)
    });

});