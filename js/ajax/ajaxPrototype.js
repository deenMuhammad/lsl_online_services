function makeAjaxPrototype(url, method, parameters, onSuccess){
    new Ajax.Request(url, {
        method: method,
        parameters:parameters,
        onSuccess: onSuccess,
        onFailure: function(xhrResponse){
            alert("There was a problem retrieving the data thtrough AJAX: \n"+xhrResponse.statusText);
        }
    });
}