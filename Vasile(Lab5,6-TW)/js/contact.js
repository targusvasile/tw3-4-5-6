function contact_msg(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal_msg = document.getElementById("mod_msg");

    modal_msg.innerHTML = "Message sent! Wait for us to contact you!";
    modal.style.visibility = "visible";
    modal.style.opacity = 1;
}

function ok_contact(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal.style.opacity = 0;
    modal.style.visibility = "hidden";
}

function clearContact(){
    document.getElementById("contact-us").reset();
}

function numberCompl(){
    numberInput = document.getElementsByName("mobile-code")[0];
    if(numberInput.value.length == 0)
        numberInput.value = "+";
}

function numberClear(){
    numberInput = document.getElementsByName("mobile-code")[0];
    if(numberInput.value.length == 1)
        numberInput.value = "";
}

function checkCode(){
    numberInput = document.getElementsByName("mobile-code")[0];
    if(isNaN(numberInput.value[numberInput.value.length-1])){
        numberInput.value = numberInput.value.slice(0, numberInput.value.length-1);
    }

}

function checkNumber(){
    mobileNumberInput = document.getElementsByName("mobile-number")[0];
    if(isNaN(mobileNumberInput.value[mobileNumberInput.value.length-1])){
        mobileNumberInput.value = mobileNumberInput.value.slice(0, mobileNumberInput.value.length-1);
    }

}

function incorrect_contact_msg(){
    modal = document.getElementsByClassName("modal__window")[0];
    modal_msg = document.getElementById("mod_msg");

    modal_msg.innerHTML = "Fields can't be blank!";
    modal.style.visibility = "visible";
    modal.style.opacity = 1;
}

function sendContact(){
    uname = document.getElementsByName("uname")[0].value.length;
    stateCode = document.getElementsByName("mobile-code")[0].value.length;
    phone = document.getElementsByName("mobile-number")[0].value.length;
    textproblem = document.getElementsByName("text-problem")[0].value.length;

    if (uname == 0 || stateCode == 0 || phone == 0 || textproblem == 0)
        incorrect_contact_msg();
    else {
        data = $("#contact-us").serialize();

        $.ajax({
            type: "POST",
            data: data,
            url: "../php/contact.php",
            success: function () {
                $("#contact-us").trigger("reset");
                contact_msg();
            }
        });
    }
}