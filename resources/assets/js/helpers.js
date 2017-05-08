function getDOMAttribute(selector, attribute){
    return $(selector).attr(attribute);
}

function getCsrfToken(){
    return $("meta[name=token]").attr('content');
}

function registerModalCloseHanlder(){
    $('.overlay-model').on('hidden.bs.modal', function(){
        $(this).remove();
    });
}

function renderModal(rendered){
    $('#modal').html(rendered);
    $('.overlay-model').modal('show');
    registerModalCloseHanlder();
}

function closeModal(){
    $('.overlay-model').modal('hide');
}