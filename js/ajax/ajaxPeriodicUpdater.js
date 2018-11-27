function makeAjaxPeriodicUpdaterPrototype(div, url, method, parameters, onSuccess, frequence){
    new Ajax.PeriodicalUpdater(div, url, {
        method: method,
        frequency: frequence,
        decay: 1,
        parameters: parameters,
        onSuccess: onSuccess,
        onFailure: function(xhrResponse){
            alert("Failed to update!"+xhrResponse.statusText);
        }, 
        
    });
}