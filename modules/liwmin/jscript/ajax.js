function ajaxCreateRequest() {
    try {
        var request = new XMLHttpRequest();
    } catch (trymicrosoft) {
        try {
            var request = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (othermicrosoft) {
            try {
                var request = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (failed) {
                var request = false;
            }
        }
    }

    return request;
}

function isArray(obj) 
{
    return obj.constructor == Array;
}


function ajaxGet(url, callback_function)
{
    request = ajaxCreateRequest();
    request.open("GET", url, true);
    request.onreadystatechange = function() {
        
        
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            callback_function(response);
        }
    };
    request.send(null);
}

function ajaxPost(url, params, callback_function)
{
    request = ajaxCreateRequest();
    request.open("POST", url, true);
    request.onreadystatechange = function() {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            callback_function(response);
        }
    };
    
    var str = '';
    for (var key in params)
    {
        if (isArray(params[key]))
        {
            for (var subkey in params[key])
                str += encodeURIComponent(key) + '['+subkey+']=' + encodeURIComponent(params[key][subkey]) + '&';
        }
        else
        {
            str += encodeURIComponent(key) + '=' + encodeURIComponent(params[key]) + '&';
        }
    }
        
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.send(str);
}