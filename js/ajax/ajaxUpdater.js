function makeAjaxUpdaterPrototype(div, url, method, parameters, onSuccess){
    new Ajax.Updater(div, url, {
        method: method,
        parameters: parameters,
        onSuccess: onSuccess,
        onFailure: function(xhrResponse){
            alert("Failed to update!"+xhrResponse.statusText);
        }
    });
}