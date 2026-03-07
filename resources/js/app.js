import "./bootstrap";

import jQuery from "jquery";
window.$ = window.jQuery = jQuery;

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import EasyMDE from "easymde";
import "easymde/dist/easymde.min.css";
import toastr from "toastr";
import "toastr/build/toastr.min.css";



// resources/js/app.js
import ApexCharts from "apexcharts";

// Make them global so you can access in Blade inline scripts if needed
window.ApexCharts = ApexCharts;
window.EasyMDE = EasyMDE;
window.toastr = toastr;


document.addEventListener("DOMContentLoaded", function () {
    const registerBtnEL = document.querySelector("#btn-register");
    const loginFormEL = document.querySelector(".login-form");
    const registerTextEL = document.querySelector(".register-text");
    const loginTextEL = document.querySelector(".login-text");
    const registerFormEL = document.querySelector(".register-form");
    const loginBtnEL = document.querySelector("#btn-login");

    if (registerBtnEL) {
        registerBtnEL.addEventListener("click", function () {
            loginFormEL.classList.add("d-none");
            registerTextEL.classList.add("d-none");
            registerFormEL.classList.remove("d-none");
            loginTextEL.classList.remove("d-none");
        });
    }

    if (loginBtnEL) {
        loginBtnEL.addEventListener("click", function () {
            loginFormEL.classList.remove("d-none");
            registerTextEL.classList.remove("d-none");
            registerFormEL.classList.add("d-none");
            loginTextEL.classList.add("d-none");
        });
    }

    const editor = document.getElementById("editor");

    if (editor) {
        new EasyMDE({
            element: editor,
            spellChecker: true,
            toolbar: [
                "bold",
                "italic",
                "heading",
                "|",
                "quote",
                "unordered-list",
                "ordered-list",
                "|",
                "link",
                "preview",
                "side-by-side",
                "fullscreen",
            ],
            maxHeight: "250px",
        });
    }

    if (window.flash) {
        toastr[window.flash.type](window.flash.message, window.flash.title);
    }
});
