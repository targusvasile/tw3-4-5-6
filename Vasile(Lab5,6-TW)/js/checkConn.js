function pagesCheck(){
  nav = document.getElementsByClassName("scrollmenu")[0];

  if(sessionStorage.length != 0 ){
    nav.innerHTML = "<a href='../index.html'>Home</a>\
    <a href='contact.html'>Contact</a>\
    <a onclick='log_out();' id='log_out'>Log out</a>";
  }
}

//Log out part
function log_out() {
    if (window.confirm("Do you really want to logout?")) {
      sessionStorage.clear();
  
      //window.location.href = "./login.html";
      nav = document.getElementsByClassName("scrollmenu")[0];

      nav.innerHTML = "<a href='../index.html'>Home</a>\
      <a href='contact.html'>Contact</a>\
      <a href='../html/login.html'>Log in</a>\
      <a href=''../html/register.html'>Register</a>";
    }
}