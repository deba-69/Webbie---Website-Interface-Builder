const submitBtn = document.querySelector('.submit-btn');
const namE = document.querySelector('#name') || null;
const email = document.querySelector('#email');
const pass = document.querySelector('#password');
const cpass = document.querySelector('#c_password') || null;
const number = document.querySelector('#number') || null;

submitBtn.addEventListener('click', () => {

    if(namE!=null)
    {
        if(namE.value.length < 3)
        {
            showAlert('name must be atleast 3 letters long');
        }
        else if(!email.value.length)
        {
            showAlert('enter your email');
        }
        else if(pass.value.length < 8)
        {
            showAlert('password should be atleast 8 characters long');
        }
        else if(!cpass.value.length || cpass.value!=pass.value)
        {
            //document.write(cpass,"<br>",pass);
            showAlert('confirm password is not same as password');
        }
        else if(!Number(number.value) || number.value.length<10 || number.value.length > 10)
        {
            showAlert('invalid number, please enter valid number');
        }
        else
        {
        //submit
        }
    }
    else
    {
        if(!email.value.length || !pass.value.length)
        {
            showAlert('Fill all the inputs');
        }
    }
})

function showAlert(mssg)
{
    let alertBox = document.querySelector('.alert-box');
    let alertMssg = document.querySelector('.alert-msg');
    alertMssg.innerHTML = mssg;
    alertBox.classList.add('show');

    setTimeout(() => {
        alertBox.classList.remove('show');
    }, 3000)
}