const login_menu = document.getElementById('login_menu');
const signup_menu = document.getElementById('signup_menu');

const login_form = document.getElementById('login-form');
const signup_form = document.getElementById('signup-form');

function active_login() {
    login_menu.classList.add('active')
    signup_menu.classList.remove('active')
    login_form.style.display = "flex";
    signup_form.style.display = "none";
}

function active_signup() {
    login_menu.classList.remove('active')
    signup_menu.classList.add('active')
    login_form.style.display = "none";
    signup_form.style.display = "flex";
}

login_menu.addEventListener("click", active_login);
signup_menu.addEventListener("click", active_signup);
