const urlBase = 'http://mattct027.xyz/API';
const extension = 'php';

let userID = 0;
let firstName = "";
let lastName = "";

// Window onload to ensure event listeners are added after DOM is ready
window.onload = function() {
    document.getElementById('login-link').addEventListener('click', showLoginForm);
    document.getElementById('signup-link').addEventListener('click', showSignupForm);

    // Initially hide both forms but prepare for animation
    document.getElementById('login-section').classList.add('hidden');
    document.getElementById('signup-section').classList.add('hidden');

    // Animation for header and form entrance on page load
    setTimeout(() => {
        document.querySelector('header').classList.add('show');
    }, 100);
};

// Function to show login form and hide signup form with animation
function showLoginForm() {
    const loginSection = document.getElementById('login-section');
    const signupSection = document.getElementById('signup-section');
    
    // Trigger the animation by adding/removing classes
    signupSection.classList.remove('show');
    loginSection.classList.remove('hidden');
    setTimeout(() => {
        loginSection.classList.add('show');
        signupSection.classList.add('hidden');
    }, 10); 
}

// Function to show signup form and hide login form with animation
function showSignupForm() {
    const loginSection = document.getElementById('login-section');
    const signupSection = document.getElementById('signup-section');
    
    // Trigger the animation by adding/removing classes
    loginSection.classList.remove('show');
    signupSection.classList.remove('hidden');
    setTimeout(() => {
        signupSection.classList.add('show');
        loginSection.classList.add('hidden');
    }, 10); 
}

// Function to sign up a new user
function signup() {
    let newEmail = document.getElementById('new-email').value;
    let newPassword = document.getElementById('new-password').value;

    let data = {
        email: newEmail,
        password: newPassword
    };

    fetch(`${urlBase}/Signup.${extension}`, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(response => {
        if (response.error) {
            alert('Signup failed: ' + response.error);
        } else {
            alert('Signup successful! Please log in.');
            showLoginForm(); // Switch to login form after signup
        }
    })
    .catch(error => console.error('Error:', error));
}

// Function to log in the user
function login() {
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    let data = {
        email: email,
        password: password
    };

    fetch(`${urlBase}/Login.${extension}`, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(response => response.json())
    .then(response => {
        if (response.error) {
            alert('Login failed: ' + response.error);
        } else {
            userID = response.userID;
            firstName = response.firstName;
            lastName = response.lastName;
            alert('Login successful!');
        }
    })
    .catch(error => console.error('Error:', error));
}
