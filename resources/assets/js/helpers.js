function getDOMAttribute(selector, attribute){
    return $(selector).attr(attribute);
}

function getCsrfToken(){
    return $("meta[name=token]").attr('content');
}