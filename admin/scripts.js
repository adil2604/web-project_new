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
        userToTable(user);

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
function userToTable(user) {

    let tr="<tr>";
    for(let i=0;i<4;i++){
        let cell="<td class=\"tg-8q56\">"+user[data_cell[i]]+"</td>\n";
        tr+=cell;
    }
    tr+=`<td class="tg-8q56" style="display: flex;justify-content: center">
                    <div class="edit"></div>
                    <div class="delete"></div>
                </td>`
    tr+="<td class=\"tg-8q56\">"+countTasks(user)+"</td>\n";
    tr+="</tr>";
    table.innerHTML+=tr;
}


function countTasks(user) {
    let data=xmlrequest('count_tasks='+user['user_id'],URL,1,1);
    return data['COUNT(*)'];
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