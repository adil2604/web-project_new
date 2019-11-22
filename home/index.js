var prevId = null;
setActive(parseInt(getCookie('tab_new')));
function resize(id) {
    if (prevId != null) {
        document.getElementById(prevId).style.backgroundColor = 'white';
    }
    var content = document.querySelector(".content");
    var main = document.querySelector(".main-content");
    main.style.width = '63%';
    document.getElementById(id).style.backgroundColor = 'rgba(0,120,215,0.14 )';
    main.style.borderRight = '1px solid rgba(0,0,0,0.2)';
    var edit = document.querySelector(".edit");
    edit.style.display = 'block';
    console.log(id);
    prevId = id;

}

function done(id) {
    let req = new XMLHttpRequest();
    let url = 'done.php';
    let vars = 'data=' + id;
    req.open('POST', url, true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.onreadystatechange = function () {
        if (!(req.readyState === 4 && req.status === 200)) {
            return;
        }
        let data = req.responseText;
        data = JSON.parse(data);
        updateTask(id, data['done'])
    };
    req.send(vars);


}

function updateTask(id, code) {
    let radio = document.querySelector('#check' + id);
    let task = document.getElementById(id);
    if (code === '0') {
        radio.className = 'check done';
        task.className = 'completed';
    } else {
        radio.className = 'check';
        task.className = '';
    }
    let req = new XMLHttpRequest();
    let url = 'done.php';
    let vars = 'done=' + id + "&code=" + code;
    req.open('POST', url, true);
    req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    req.send(vars);

}
function search_in() {
    let request=new XMLHttpRequest();
    let vars='search='+document.getElementById("search-in").value;
    let url='done.php';
    console.log(vars);
    request.open('POST', url, true);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.onreadystatechange = function () {
        if (request.readyState === 4 && request.status === 200) {
            let data = request.responseText;
            data = JSON.parse(data);
            console.log(data)
        }
    };
    request.send(vars);
}

function setClass(div, className) {
    for (let j = 0; j < div.length; j++) {
        div[j].className = className
    }
}

function setCookie(name, value, expires, path, domain, secure) {
    document.cookie = name + "=" + escape(value) +
        ((expires) ? "; expires=" + expires : "") +
        ((path) ? "; path=" + path : "") +
        ((domain) ? "; domain=" + domain : "") +
        ((secure) ? "; secure" : "");
}

function getCookie(name) {
    var cookie = " " + document.cookie;
    let search = " " + name + "=";
    var setStr = null;
    let offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset);
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return (setStr);
}

function xmlrequest(vars,url,data,json) {
    let request=new XMLHttpRequest();
    request.open('POST', url, false);
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(data===1){
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                if(json===1){
                    let data = request.responseText;
                    data = JSON.parse(data);
                    return data;
                }
                else{
                    let data=request.responseText
                    console.log(1)
                    return  data;
                }
            }
        };
    }
    request.send(vars);
    return request.onreadystatechange();
}
var btns = document.querySelectorAll(".tabs-box button");

function setTab(i, location) {
    switch (i) {
        case 0:
            var d=xmlrequest('tab=important','done.php',1,0);
            document.querySelector('.main-content').innerHTML=d;
            history.pushState('Important','Important','?tab=important')
            break;
        case 1:
            d=xmlrequest('tab=today','done.php',1,0);
            document.querySelector('.main-content').innerHTML=d;
            history.pushState('Today','today','?tab=today');
            break;
        case 2:
            d=xmlrequest('tab=planned','done.php',1,0);
            document.querySelector('.main-content').innerHTML=d;
            history.pushState('Planned','planned','?tab=planned');
            break;
        default:
            break;

    }
}


function setActive(i) {
    var currentLocation = window.location;
    setCookie('tab_new', i, " 01-Jan-2020 00:00:00 GMT", '/');
    setTab(i, currentLocation);

}






