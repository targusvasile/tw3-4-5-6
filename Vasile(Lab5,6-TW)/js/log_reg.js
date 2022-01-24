function register() {
  form = document.getElementById("register");
  username = form[0];
  password = form[1];
  password_conf = form[2];
  email = form[3];

  userErr = document.getElementById("userErr");
  passErr = document.getElementById("passErr");
  pass2Err = document.getElementById("pass2Err");
  emailErr = document.getElementById("emailErr");
  user_reg = false;
  pass_reg = false;
  pass2_reg = false;
  email_reg = false;

  if (username.value.length < 5) {
    userErr.innerHTML = "Needed length of minimum 6 characters.";
    user_reg = false;
  } else {
    userErr.innerHTML = "";
    user_reg = true;
  }

  if (password.value.length < 8) {
    passErr.innerHTML = "Password must be at least 8 characters length.";
    pass_reg = false;
  } else if (password.value.match(/^(?=.*\d)(?=.*[a-z]).{8,50}$/)) {
    passErr.innerHTML = "";
    pass_reg = true;
  } else {
    passErr.innerHTML = "Password must contain letters and numbers.";
    pass_reg = false;
  }

  if (password_conf.value.length === 0) {
    pass2_reg = false;
    pass2Err.innerHTML = "Can't be empty.";
  } else if (password_conf.value != password.value) {
    pass2Err.innerHTML = "Passwords do not match.";
    pass2_reg = false;
  } else {
    pass2Err.innerHTML = "";
    pass2_reg = true;
  }

  if (email.value.length === 0) {
    emailErr.innerHTML = "Can't be empty!";
    email_reg = false;
  } else if (email.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    emailErr.innerHTML = "";
    email_reg = true;
  } else {
    emailErr.innerHTML = "Incorrect e-mail format.";
    email_reg = false;
  }

  //console.log(user_reg, pass_reg, pass2_reg, email_reg);
  if (user_reg && pass_reg && pass2_reg && email_reg) {
    data = $("#register").serialize();
    console.log(data);
    $.ajax({
      type: "POST",
      url: "../php/register.php",
      data: data,
      success: function (resp) {
        if (resp == "false") 
          userErr.innerHTML = "User already exists!";
        else if(resp == "true"){
          reg_msg();
        }
        else{
          userErr.innerHTML = resp;
        }
      },
    });
  }
}

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

  window.location.href = "./login.html";
}

//Login part
function login() {
  form = document.getElementById("login");
  username = form[0];
  password = form[1];
  
  userErr = document.getElementById("userErr"); 
  passErr = document.getElementById("passErr");

  user_log = false;
  pass_log = false

  if (username.value.length < 5) {
    userErr.innerHTML = "Incorrect username length.";
    user_log = false;
  } else {
    userErr.innerHTML = "";
    user_log = true;
  }

  if (username.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    userErr.innerHTML = "";
    user_log = true;
  }

  if (password.value.length < 8) {
    passErr.innerHTML = "Incorrect password length.";
    pass_log = false;
  } else if (password.value.match(/^(?=.*\d)(?=.*[a-z]).{8,50}$/)) {
    passErr.innerHTML = "";
    pass_log = true;
  } else {
    passErr.innerHTML = "Password must contain letters and numbers.";
    pass_log = false;
  }

  if (user_log && pass_log) {
    data = $("#login").serialize();
    $.ajax({
      type: "POST",
      url: "../php/login.php",
      data: data,
      success: function (resp) {
        if (resp == "false") 
            passErr.innerHTML = "Incorrect user or password";
        else if(resp != "Database error!"){
          login_msg();
          sessionStorage.setItem("id", resp);
        }
        else{
          userErr.innerHTML = resp;
        }
      },
    });
  }
}

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
