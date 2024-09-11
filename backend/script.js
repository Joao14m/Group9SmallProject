const urlBase = 'http://mattct027.xyz/API';
const extension = 'php';

let userId = 0;
let firstName = "";
let lastName = "";

function signup() {
    userId = 0;
    firstName = document.getElementById("firstName").value;
    lastName = document.getElementById("lastName").value;

    let login = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    // document.getElementById("signupResult").innerHTML = "";

    let tmp = {firstName:firstName, lastName:lastName, login:login, password:password};
    let jsonPayload = JSON.stringify(tmp);

    let url = urlBase + '/Signup.' + extension;
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    try{
        xhr.onreadystatechange = function() {
            if(this.readyState = 4 && this.status == 200){
                let jsonObject = JSON.parse(xhr.responseText);
                userId = jsonObject.id;

                if(userId < 1){
                    return;
                }
            
                window.location.href = "index.html";
            }
        };
        xhr.send(jsonPayload);
    }

    catch(err){
        document.getElementById("signupResult").innerHTML = err.message;
    }
}

function login() {
    userId = 0;
    firstName = "";
    lastName = "";

    let login = document.getElementById("email").value;
    let password = document.getElementById("password").value;

    // document.getElementById("loginResult").innerHTML = "";

    let tmp = {login:login, password:password};
    let jsonPayload = JSON.stringify(tmp);

    let url = urlBase + '/Login.' + extension;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    
    try{
        xhr.onreadystatechange = function(){
            if(this.readyState = 4 && this.status == 200){
                let jsonObject = JSON.parse(xhr.responseText);
                userId = jsonObject.id;

                if(userId < 1){
                    return;
                }

                firstName = jsonObject.firstName;
                lastName = jsonObject.lastName;

                window.location.href = "index.html";
            }
        };
        xhr.send(jsonPayload);
    }

    catch(err){
        document.getElementById("loginResult").innerHTML = err.message;
    }
}

function logout() {
    userId = 0;
    firstName = "";
    lastName = "";
    window.location.href = "index.html";
}

function createContact() {

}

function retrieveContact() {
    
}

function updateContact() {
    
}

function deleteContact() {
    
}