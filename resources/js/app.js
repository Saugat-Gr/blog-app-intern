import './bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

document.addEventListener('DOMContentLoaded', function () {

    const registerBtnEL = document.querySelector('#btn-register');
    const loginFormEL = document.querySelector('.login-form');
    const registerTextEL = document.querySelector('.register-text');
    const loginTextEL = document.querySelector('.login-text');
    const registerFormEL = document.querySelector('.register-form');
    const loginBtnEL = document.querySelector('#btn-login');

    if (registerBtnEL) {
        registerBtnEL.addEventListener('click', function () {
            loginFormEL.classList.add('d-none');
            registerTextEL.classList.add('d-none');
            registerFormEL.classList.remove('d-none');
            loginTextEL.classList.remove('d-none');
        });
    }

    if (loginBtnEL) {
        loginBtnEL.addEventListener('click', function () {
            loginFormEL.classList.remove('d-none');
            registerTextEL.classList.remove('d-none');
            registerFormEL.classList.add('d-none');
            loginTextEL.classList.add('d-none');
        });
    }

});

