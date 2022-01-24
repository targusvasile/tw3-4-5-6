function cancelBtnLog(){
  document.getElementById("login").reset();
  document.getElementById("userErr").innerHTML = "";
  document.getElementById("passErr").innerHTML = "";
}
function cancelBtnReg(){
  document.getElementById("register").reset();
  document.getElementById("userErr").innerHTML = "";
  document.getElementById("passErr").innerHTML = "";
  document.getElementById("pass2Err").innerHTML = "";
  document.getElementById("emailErr").innerHTML = "";
}

var mybutton;
window.onload = function(){
    mybutton = document.getElementById("myBtn");
    try{
      pagesCheck();
    }catch{}
}

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}