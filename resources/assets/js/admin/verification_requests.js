$('.approve-user').on('click', function(){
    let req_id = getDOMAttribute(this, 'data-id');

    bootbox.confirm({
        message: "Are you sure you want to approve this user?",
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
                    url : '/admin/approve/user',
                    context: this,
                    data : {
                        req_id : req_id,
                        _token : getCsrfToken()
                    },
                    success : function(res){
                        if(res.approved){
                            $(this).parents('.request').slideUp(function(){
                               $(this).remove();
                               toastr.success('User approved');
                            });
                        }else{
                            bootbox.alert('Unable to approve user');
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });

});

$('.disapprove-user').on('click', function(){
    let req_id = getDOMAttribute(this, 'data-id');
    bootbox.confirm({
        message: "Are you sure you want to disapprove this user?",
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
                    url : '/admin/disapprove/user',
                    data : {
                        req_id : req_id,
                        _token : getCsrfToken()
                    },
                    success : function(res){
                        if(res.disapproved){
                            $(this).parents('.request').slideUp(function(){
                                $(this).remove();
                                toastr.success('User disapproved');
                            });
                        }else{
                            bootbox.alert('Unable to disapprove user');
                        }
                    }.bind(this)
                });
            }
        }.bind(this)
    });
});