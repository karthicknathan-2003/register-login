const form = document.getElementById("form");
const name1 = document.getElementById("name1");
const email = document.getElementById("email");
const password = document.getElementById("pass");
const cpassword = document.getElementById("cpass");        
form.addEventListener('submit', e => {
    e.preventDefault();
    checkInput();
});
function checkInput() {
    const name1Value = name1.value.trim();
    const emailValue = email.value.trim();
    const passValue = password.value.trim();
    const cpassValue = cpassword.value.trim();
    if (name1Value === '') {
        setError(name1, 'Name cannot be blank');
    } else {
        setSuccess(name1);
    }
    if (emailValue === '') {
        setError(email, 'Email cannot be blank');
    }
    else if (!isEmail(emailValue)) {
        setError(email, 'Not a valid email');
    }
    else {
        setSuccess(email);
    }
    if (passValue === '') {
        setError(password, 'Password cannot be blank');
    } else {
        setSuccess(password);
    }
    if (cpassValue === '') {
        setError(cpassword, 'Password cannot be blank');
    } else if (cpassValue !== passValue) {
        setError(cpassword, 'Password not match');
    }
    else {
        setSuccess(cpassword);
    }
}
function isEmail(email) {
    //return /^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/.test(email);
    return /^([a-z0-9\+\-]+)(\.[a-z0-9\+\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/.test(email);
}
function setError(input, message) {
    const form1 = input.parentElement;
    const small = form1.querySelector('small');
    form1.className = 'form1 error';
    small.innerText = message;
}
function setSuccess(input) {
    const form1 = input.parentElement;
    form1.className = 'form1 success';
}