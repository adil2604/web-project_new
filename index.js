function resize() {
  var content=document.querySelector(".content")
  var main=document.querySelector(".main-content")
  main.style.width='63%'
  main.style.borderRight='1px solid rgba(0,0,0,0.2)'
  var edit=document.querySelector(".edit")
  edit.style.display='block'

}

function setClass(div, className) {
  for(let j=0;j<div.length;j++){
    div[j].className=className
  }
}



var btns=document.querySelectorAll(".tabs-box button")



function setActive(i) {
let content=document.querySelectorAll(".index")
setClass(content,'index');
content[i].className='index showing'
setClass(btns,'');
btns[i].className='active'
}




function makeRequest(url) {
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
                } catch (e) {}
            }
        }

        if (!httpRequest) {
            alert('Не вышло :( Невозможно создать экземпляр класса XMLHTTP ');
            return false;
        }
        httpRequest.onreadystatechange = function() { alertContents(httpRequest); };
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
}
