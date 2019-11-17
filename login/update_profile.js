function save() {
    var name=document.getElementById('name').value;
    var surname=document.getElementById('surname').value;
    var pass=document.getElementById('pass').value;
    var newpass=document.getElementById('newPass').value
    if (name!=="" && surname!==""){
        sendR(name,surname,pass,newpass);
    }
}
function sendR(name,surname,pass,newpass) {
    var request=new XMLHttpRequest();
    var url='update.php';
    if (pass===''){
        var vars="firstname="+name+"&surname="+surname;
    }
    else{
        var vars="firstname="+name+"&surname="+surname+"&pass="+pass+"&newpass="+newpass;
    }

    console.log(vars);
    request.open('POST',url,true)
    request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    request.onreadystatechange = function() {
        if(request.readyState === 4 && request.status === 200) {
            document.getElementById("error").innerHTML = request.responseText;
        }
    };
    request.send(vars);
    document.getElementById('error').innerHTML='Processing..';

}