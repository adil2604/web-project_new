var prevId=null
function resize(id) {
    if(prevId!=null){
        document.getElementById(prevId).style.backgroundColor='white';
    }
    var content = document.querySelector(".content")
    var main = document.querySelector(".main-content")
    main.style.width = '63%'
    document.getElementById(id).style.backgroundColor='rgba(0,120,215,0.14 )';
    main.style.borderRight = '1px solid rgba(0,0,0,0.2)'
    var edit = document.querySelector(".edit")
    edit.style.display = 'block'
    console.log(id)
    prevId=id;

}

function done(id) {
    alert(id)
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
    var search = " " + name + "=";
    var setStr = null;
    var offset = 0;
    var end = 0;
    if (cookie.length > 0) {
        offset = cookie.indexOf(search);
        if (offset != -1) {
            offset += search.length;
            end = cookie.indexOf(";", offset)
            if (end == -1) {
                end = cookie.length;
            }
            setStr = unescape(cookie.substring(offset, end));
        }
    }
    return (setStr);
}


var btns = document.querySelectorAll(".tabs-box button")

function setTab(i, location) {
    switch (i) {
        case 0:
            location.search = 'tab=important&';
            break;
        case 1:
            location.search = 'tab=today&';
            break;
        case 2:
            location.search = 'tab=planned&';
            break;
        default:
            break;

    }
}


function setActive(i) {
    var currentLocation = window.location
    setCookie('tab', i, " 01-Jan-2020 00:00:00 GMT", '/')
    setTab(i, currentLocation)
    console.log(document.cookie);
    // let content=document.querySelectorAll(".index")
    // setClass(content,'index');
    // //content[i].className='index showing'
    // setClass(btns,'');
    // btns[i].className='active'
}


function makeRequest(e, url) {
    e.preventDefault();
    var httpRequest = false;

    if (window.XMLHttpRequest) { // Mozilla, Safari, ...
        httpRequest = new XMLHttpRequest();
        if (httpRequest.overrideMimeType) {
            httpRequest.overrideMimeType('text/xml');
            // Читайте ниже об этой строке
        }
    } else if (window.ActiveXObject) { // IE
        try {
            httpRequest = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {
            }
        }
    }

    if (!httpRequest) {
        alert('Не вышло :( Невозможно создать экземпляр класса XMLHTTP ');
        return false;
    }
    httpRequest.onreadystatechange = function () {
        alertContents(httpRequest);
    };
    httpRequest.open('GET', url, true);
    httpRequest.send(null);

}

function alertContents(httpRequest) {

    if (httpRequest.readyState == 4) {
        if (httpRequest.status == 200) {
            alert(httpRequest.responseText);
        } else {
            alert('С запросом возникла проблема.');
        }
    }

}


/*

var tasks=document.querySelectorAll(".tasks .addTask")
for (var i = 0; i < tasks.length; i++) {
  tasks[i].addEventListener('keydown',function (e) {
    var keyCode = e.keyCode || e.which;
    if ( keyCode === 13 ) {
      alert(this.value)
      var btn=document.createElement('button')
      btn.appendChild(document.createTextNode(this.value))
      this.text= '';
      // this.removeChild(this.childNodes[1])

    }
  })
}*/
