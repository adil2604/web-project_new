let prevId = null;
let prevTab = null;
let TYPES=3;
const tabs = document.querySelectorAll('.tabs-box button');
setActive(parseInt(getCookie('tab_new')));
setCount();
let pages=get_pagination_pages();
console.log(pages);

function setCount() {
    let tabs = [document.getElementById('important-count'), document.getElementById('today-count'), document.getElementById('planned-count')]
    for(let i=0;i<tabs.length;i++){
        tabs[i].innerHTML=getCountTasks(i)
    }
}

function resize(id) {
    if (prevId != null) {
        document.getElementById(prevId).style.backgroundColor = 'white';
    }
    var main = document.querySelector(".main-content");
    main.style.width = '59%';
    document.getElementById(id).style.backgroundColor = 'rgba(0,120,215,0.14 )';
    main.style.borderRight = '1px solid rgba(0,0,0,0.2)';
    var edit = document.querySelector(".edit");
    edit.style.display = 'block';
    let editTask = xmlrequest('edit=' + id, 'done.php', 1, 1);
    let nameclass = 'check';
    if (editTask['done'] === '1') {
        nameclass += ' done';
    }

    let editbox = document.querySelector('.edit-box')
    editbox.innerHTML = ''
    let name = "<div class='edit-container'><div class='" + nameclass + "'style='left: 5%' id='check" + id + "' onclick='done(" + id + ")' ></div><input type='text' class='edit-name'style='margin-left: 2vw' value=' " + editTask['task'] + "'></div>"
    editbox.innerHTML += name;
    let reminder = "<div class='edit-container' style='display: flex;flex-direction: column'><input type='text' value=''  placeholder='Reminder' onfocus=\"(this.type='date')\"  class='edit-name cat'><input type='text' value='' style='font-size: 1vw;text-align:left;height: 8vw;border-radius: 0.3vw'  placeholder='Description' class='edit-name cat'></div>" + "<div class='edit-container' style='height: 3vw;'><input type='text' placeholder='Add file' class='edit-name cat' style='padding-left: 2vw;background-image: url(\"../asserts/icons/add.png\");background-repeat: no-repeat;background-size: 1vw;height2vw;background-position: 0 50%;width: 80%'></div>"
    editbox.innerHTML += reminder


    prevId = id;

}

function done(id) {
    let data = xmlrequest('data=' + id, 'done.php', 1, 1)
    updateTask(id, data['done'])
}

function updateTask(id, code) {
    console.log(1);
    let radio = document.querySelectorAll('#check' + id);
    let task = document.getElementById(id);
    if (code === '0') {
        for (let r of radio)
            r.className = 'check done';
        task.className = 'completed';
    } else {
        for (let r of radio)
            r.className = 'check';
        task.className = '';
    }
    xmlrequest('done=' + id + '&code=' + code, 'done.php', 0, 0)
    console.log(data);
}

function search_in() {
    let request = new XMLHttpRequest();
    let q = document.getElementById("search-in").value;
    if (q.length > 2) {
        document.title = 'Search by ' + q;
        let vars = 'search=' + q;
        let url = 'done.php';
        console.log(vars);
        request.open('POST', url, true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.onreadystatechange = function () {
            if (request.readyState === 4 && request.status === 200) {
                document.querySelector('.main-content').innerHTML = request.responseText;

            }
        };
        request.send(vars);
    } else {
        setTab(parseInt(getCookie('tab_new')));
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

function setTab(i) {
    if (prevTab !== null) {
        tabs[prevTab].className = ''
    }
    prevTab = i;
    switch (i) {
        case 0:
            document.title = 'Important tasks';
            tabs[0].className = 'active';
            var d = xmlrequest('tab=important', 'done.php', 1, 0);
            document.querySelector('.main-content').innerHTML = d;
            history.pushState('Important', 'Important', '?tab=important')
            break;
        case 1:
            tabs[1].className = 'active';
            document.title = 'Today tasks';
            d = xmlrequest('tab=today', 'done.php', 1, 0);
            document.querySelector('.main-content').innerHTML = d;
            history.pushState('Today', 'today', '?tab=today');
            break;
        case 2:
            tabs[2].className = 'active';
            document.title = 'Planned tasks';
            d = xmlrequest('tab=planned', 'done.php', 1, 0);
            document.querySelector('.main-content').innerHTML = d;
            history.pushState('Planned', 'planned', '?tab=planned');
            break;
        default:
            break;

    }
}


function setActive(i) {
    setCookie('tab_new', i, " 01-Jan-2020 00:00:00 GMT", '/');
    setTab(i);
}


function add_task(type) {
    console.log("send");
    let task = document.getElementById('input' + type).value;
    xmlrequest('add=' + type + '&task=' + task, 'done.php', 0, 0)
    setCount()
    setActive(parseInt(getCookie('tab_new')));
}


function get_pagination_pages() {
    let ans=[];
    for (let i=0;i<TYPES;i++ ){
        let pages = xmlrequest("get=pages&type="+i , 'done.php', 1, 0)
        ans.push(pages)
    }
    return ans
}

function getCountTasks(type) {
    let count = xmlrequest('count=' + type, 'done.php', 1, 1)
    return count['COUNT(*)']
}


function getPage(type,page) {
    if(parseInt(pages[type])>=page && page>0){
        let tasks=xmlrequest('get=pageno&pageno='+page+"&type="+type,'done.php',1,0)
        let div=document.getElementById('main')
        div.innerHTML=tasks
    }
    else
        console.log('error')
}






