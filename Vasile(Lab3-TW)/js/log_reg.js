function login_msg(){
  uname = document.getElementsByName("uname")[0].value;
  pass = document.getElementsByName("psw")[0].value;

  modal = document.getElementsByClassName("modal__window")[0];
  modal_msg = document.getElementById("mod_msg");

  if(uname.length > 0 && pass.length > 0){
    $("#userErr").html("");
    modal_msg.innerHTML = "Succes Authentification!";
    modal.style.visibility = "visible";
    modal.style.opacity = 1;

    sessionStorage.setItem("id", "0");
  }
  else{
    $("#userErr").html("Inputs can't be blank!");
  }
}

function ok_auth(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal.style.opacity = 0;
    modal.style.visibility = "hidden";

    window.location.href = "../index.html"
}

function reg_msg(){
  uname = document.getElementsByName("uname")[0].value;
  pass = document.getElementsByName("psw")[0].value;
  pass_conf = document.getElementsByName("psw-conf")[0].value;
  email = document.getElementsByName("email")[0].value;

  modal = document.getElementsByClassName("modal__window")[0];
  modal_msg = document.getElementById("mod_msg");

  if(uname.length > 0 && pass.length > 0 && pass_conf.length > 0 && email.length > 0){
    $("#userErr").html("");
    modal_msg.innerHTML = "Succes Register!";
    modal.style.visibility = "visible";
    modal.style.opacity = 1;

    sessionStorage.setItem("id", "0");
  }
  else{
    $("#userErr").html("Inputs can't be blank!");
  }
}

function ok_reg(){
  modal = document.getElementsByClassName("modal__window")[0];
  modal.style.opacity = 0;
  modal.style.visibility = "hidden";

  window.location.href = "login.html"
}