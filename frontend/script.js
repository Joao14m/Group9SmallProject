const SignUpButton = document.getElementById("SignUp");
const SignInButton = document.getElementById("SignIn");
const container = document.getElementById("container");

SignUpButton.addEventListener('click', () => {
    container.classList.add("right-panel-active");
});

SignInButton.addEventListener('click', () => {
    container.classList.remove("right-panel-active");
});

function signup() {
    let name = document.getElementById('signup-name').value;
    let email = document.getElementById('signup-email').value;
    let password = document.getElementById('signup-password').value;

    // Your signup function here
    console.log("Signup with", name, email, password);
}

function login() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    // Your login function here
    console.log("Login with", email, password);
}
