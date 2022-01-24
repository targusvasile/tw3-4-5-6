function reg_msg() {
  modal = document.getElementsByClassName("modal__window")[0];
  modal_msg = document.getElementById("mod_msg");

  modal_msg.innerHTML = "Succes Register!";
  modal.style.visibility = "visible";
  modal.style.opacity = 1;
}

function ok_reg() {
  modal = document.getElementsByClassName("modal__window")[0];
  modal.style.opacity = 0;
  modal.style.visibility = "hidden";

  window.location.href = "./login.php";
}

//Login part
function login_msg(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal_msg = document.getElementById("mod_msg");

    modal_msg.innerHTML = "Succes Authentification!";
    modal.style.visibility = "visible";
    modal.style.opacity = 1;
}

function ok_auth(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal.style.opacity = 0;
    modal.style.visibility = "hidden";

    window.location.href = "../index.html"
}

function clearBtnLog(){
  document.getElementById("login").reset();
  document.getElementById("userErr").innerHTML = "";
  document.getElementById("passErr").innerHTML = "";
}

function clearBtnReg(){
  document.getElementById("register").reset();
  document.getElementById("userErr").innerHTML = "";
  document.getElementById("passErr").innerHTML = "";
  document.getElementById("pass2Err").innerHTML = "";
  document.getElementById("emailErr").innerHTML = "";
}

