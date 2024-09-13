const urlBase = 'http://mattct027.xyz/API';
const extension = 'php';

let userId = 0;
let firstName = "";
let lastName = "";

function signup() {
    userId = 0;
    firstName = document.getElementById("signup-first-name").value;
    lastName = document.getElementById("signup-last-name").value;

    let login = document.getElementById("signup-email").value;
    let password = document.getElementById("signup-password").value;

    // document.getElementById("signupResult").innerHTML = "";

    let tmp = {firstName:firstName, lastName:lastName, username:login, password:password};
    let jsonPayload = JSON.stringify(tmp);

    let url = urlBase + '/Signup.' + extension;
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    try{
        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
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

    let tmp = {username:login, password:password};
    let jsonPayload = JSON.stringify(tmp);

    let url = urlBase + '/Login.' + extension;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
    
    try{
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                let jsonObject = JSON.parse(xhr.responseText);
                userId = jsonObject.id;

                if(userId < 1){
                    return;
                }

                firstName = jsonObject.firstName;
                lastName = jsonObject.lastName;

                window.location.href = "home.html";
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
    let name = document.getElementById("name").value;
    let phone = document.getElementById("phone").value;
    let email = document.getElementById("email").value;

    // document.getElementById("createContactResult").innerHTML = "";

    let tmp = {userId:userId, name:name, phone:phone, email:email};
    let jsonPayload = JSON.stringify(tmp);

    let url = urlBase + '/CreateContact.' + extension;
    
    let xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");

    try{
        xhr.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("createContactResult").innerHTML = "Contact has been created";
            }
        };
        xhr.send(jsonPayload);
    }

    catch(err){
        document.getElementById("createContactResult").innerHTML = err.message;
    }
}

function retrieveContact() {
    
}

function updateContact() {
    
}

function deleteContact() {
    
}