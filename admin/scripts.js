let URL="../asserts/php/admin_helper.php";
let input=document.getElementById('search-in');
let users=xmlrequest('get_users=all',URL,1,1);
let table = document.getElementById('table');
let data_cell=['user_login','user_email','admin','date_registration']
toAdmin(users)
show_all_users()
input.onkeyup=function () {
    if (input.value.length>2)
        search_in_users();
    else
        show_all_users();
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
}console.log(users);
function show_all_users() {
    create_table()
    for(let user of users){
        userToTable(user,user['user_id']);

    }
}


function toAdmin(users) {
    for(let user of users){
        if(user['admin']==="1")
            user['admin']='Admin';
        else {
            user['admin'] = 'User';
        }
    }
}

function create_table() {
    table.innerHTML="<tr style=\"border-bottom: 1px solid rgba(0, 120, 215, 0.2)\">\n" +
        "                <th class=\"tg-8q56\">User Name</th>\n" +
        "                <th class=\"tg-8q56\">User Email</th>\n" +
        "                <th class=\"tg-8q56\">Role</th>\n" +
        "                <th class=\"tg-8q56\">Date Registration</th>\n" +
        "                <th class=\"tg-8q56\">Actions</th>\n" +
        "                <th class=\"tg-8q56\">Tasks</th>\n" +
        "            </tr>"
}
function userToTable(user,user_id) {

    let tr="<tr>";
    for(let i=0;i<4;i++){
        let cell="<td class=\"tg-8q56\">"+user[data_cell[i]]+"</td>\n";
        tr+=cell;
    }
    tr+=`<td class="tg-8q56" style="display: flex;justify-content: center">
                    <div class="edit" onclick="edit()"></div>
                    <div class="trigger delete"></div>
                </td>`
    tr+="<td class=\"tg-8q56\">"+countTasks(user)+"</td>\n";
    tr+="</tr>";
    table.innerHTML+=tr;
}


function countTasks(user) {
    let data=xmlrequest('count_tasks='+user['user_id'],URL,1,1);
    return data['COUNT(*)'];
}   
function edit() {
    let main_box=document.querySelector('.admin-box');
    main_box.style.width='70%';
    let editBox=document.createElement('div')
    editBox.className='editbox';
    let main=document.querySelector('.admin-main');
    main.appendChild(editBox);
    let editbox=document.querySelector('.editbox')
    editbox.innerHTML = ''
    let name = "<div class='edit-container'><input type='text' class='edit-name'style='margin-left: 2vw' value=''></div>"
    editbox.innerHTML += name;
    let reminder = "<div class='edit-container' style='display: flex;flex-direction: column'><input type='text' value=''  placeholder='Reminder' onfocus=\"(this.type='date')\"  class='edit-name cat'><input type='text' value='' style='font-size: 1vw;text-align:left;height: 8vw;border-radius: 0.3vw'  placeholder='Description' class='edit-name cat'></div>"+"<div class='edit-container' style='height: 3vw;'><input type='text' placeholder='Add file' class='edit-name cat' style='padding-left: 2vw;background-image: url(\"../asserts/icons/add.png\");background-repeat: no-repeat;background-size: 1vw;height2vw;background-position: 0 50%;width: 80%'></div>"
    editbox.innerHTML += reminder

}



function search_in_users() {
    create_table();
    let data=xmlrequest('search='+document.getElementById('search-in').value, URL,1,1);
    console.log(data);
    toAdmin(data);
    for(let user of data){
        userToTable(user);
    }
}
var modal = document.querySelector(".modal");
var trigger = document.querySelector(".trigger");
var closeButton = document.querySelector(".close-button");

function toggleModal() {
    modal.classList.toggle("show-modal");
}
function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}

trigger.addEventListener("click", toggleModal);
closeButton.addEventListener("click", toggleModal);
window.addEventListener("click", windowOnClick);