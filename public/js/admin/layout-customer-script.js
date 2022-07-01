// Material
var authform = document.querySelector("#authformjs");
var modalmain = document.querySelector("#jsmodal");
var modaloverlay = document.querySelector("#jsmodaloverlay");
var openauthbtn = document.querySelector("#jsopenauth");
var openloginbtn = document.querySelector("#jsopenlogin");
var offauthbtn = document.querySelector("#jsauthcloseanything");
var offloginbtn = document.querySelector("#jslogincloseanything");
var loginform = document.querySelector("#jsloginform");
var changelogin = document.querySelector("#changetologinbtn");
var changeauth = document.querySelector("#changetoauth");
//Function
function openauth() {
    modalmain.classList.add("modal-open");
    modaloverlay.classList.add("modal-overlay-open");
    authform.style.display = "block";
}
function closeall() {
    modalmain.classList.remove("modal-open");
    modaloverlay.classList.remove("modal-overlay-open");
    authform.style.display = "none";
    loginform.style.display = "none";
}
function openlogin() {
    modalmain.classList.add("modal-open");
    modaloverlay.classList.add("modal-overlay-open");
    loginform.style.display = "block";
}
function changetologin() {
    authform.style.display = "none";
    loginform.style.display = "block";
}
function changetoauth() {
    loginform.style.display = "none";
    authform.style.display = "block";
}
// Add Event Listener
openauthbtn.addEventListener("click", openauth);
offauthbtn.addEventListener("click", closeall);
openloginbtn.addEventListener("click", openlogin);
offloginbtn.addEventListener("click", closeall);
changelogin.addEventListener("click", changetologin);
changeauth.addEventListener("click", changetoauth);
modaloverlay.addEventListener("click", closeall);
