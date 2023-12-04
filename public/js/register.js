const submitButton = document.getElementById("submit");

function validateEmail(email) {
    const regex = $regex =/@gmail\.com$/ ;
    return regex.test(email);
}


const emailInput = document.getElementById('registerEmail');
const errorMessage = document.getElementById('errorMessage');

emailInput.addEventListener('keyup', () => {
    const email = emailInput.value;
    const isValid = validateEmail(email);

    if (isValid) {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
        errorMessage.style.display = "none";
        submitButton.disabled = false;
    } else {
        appear("Email is not valid");
        submitButton.disabled = true;
        emailInput.classList.add('is-invalid');
        emailInput.classList.remove('is-valid');
    }
});
repeatPassword.addEventListener("keyup", async () => {
    const password = document.getElementById("registerPassword").value;
    const repeatPassword = document.getElementById("repeatPassword").value;
    if (password.length < 8) {
        console.log(password)
        appear("Password must be at least 8 characters long")
        submitButton.disabled = true;
    } else if (password === repeatPassword) {
        submitButton.disabled = false;
        errorMessage.style.display = 'none';

    } else {
        appear("Passwords do not match! Please try again.")
        submitButton.disabled = true;
    }
});
