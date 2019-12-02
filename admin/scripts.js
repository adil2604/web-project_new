function xmlrequest(vars, url, data, json) {
    let request = new XMLHttpRequest();
    request.open('POST', url, false);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (data === 1) {
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                if (json === 1) {
                    return JSON.parse(request.responseText);
                } else {
                    return request.responseText;
                }
            }
        };
    }
    request.send(vars);
    if (data === 1) {
        return request.onreadystatechange();
    }
}

let users=xmlrequest('get_users=all','../asserts/php/admin_helper.php',1,1);
console.log(users);


function userToTable() {
    
}