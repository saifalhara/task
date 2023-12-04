
var errorMessage = document.getElementById("errorMessage");
var errorMessageAdd = document.getElementById("errorMessageAdd");

function csrfToken() {
    let csrfTokenElement = document.querySelector('input[name="_token"]');
    if (csrfTokenElement) {
        return csrfTokenElement.value;
    } else {
        return '';
    }
}

function appear(message) {
    errorMessage.innerHTML = message;
    errorMessage.style.display = 'flex';
}
function appearAdd(message) {
    errorMessageAdd.innerHTML = message;
    errorMessageAdd.style.display = 'flex';
}



function deleteUser(id) {
    $.ajax({
        url: "/delete/" + id,
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken(),
        },
        success: function(data) {
            console.log("User deleted successfully!");
            window.location.reload();
        },
        error: function(error) {
            console.error("Error deleting user:", error);
        },
    });
}
function addUser() {
    var username = document.getElementById("addUserName").value;
    var email = document.getElementById("addEmail").value;
    var password = document.getElementById("addPassword").value;
    if(password.length >= 8 && validateEmail(email)){
    var data = {
        username: username,
        email: email,
        password: password,
    };

    $.ajax({
        url: "/addUser",
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken(),
        },
        data: JSON.stringify(data),
        success: function (data) {
            alert(data.message);
            window.location.reload();
        },
        error: function (error) {
            alert(error.responseText);
            window.location.reload();
        },
    });}
}
const editbtn = document.getElementById('editbtn');
const addbtn = document.getElementById('addBtn');

const emailInput = document.getElementById('editEmail');
const emailInputAdd = document.getElementById('addEmail');

function validateEmail(email) {
    const regex = $regex = /@gmail\.com$/;
    return regex.test(email);
}
emailInputAdd.addEventListener('keyup', () => {
    const email = emailInputAdd.value;
    const isValid = validateEmail(email);
    if (isValid) {
        errorMessageAdd.style.display = "none";
        emailInputAdd.classList.remove('is-invalid');
        emailInputAdd.classList.add('is-valid');
        addbtn.disabled = false;
    } else {
        appearAdd("Email is not valid");
        emailInputAdd.classList.add('is-invalid');
        emailInputAdd.classList.remove('is-valid');
        addbtn.disabled = true;
    }
});
const passwordInput = document.getElementById("addPassword");
passwordInput.addEventListener("keyup", async () => {
    const password = passwordInput.value.trim();
    if (password.length < 8) {
        appearAdd("Password must be at least 8 characters long");
        addbtn.disabled = true;
    } else {
        errorMessageAdd.style.display = "none";
        addbtn.disabled = false;
    }
});
emailInput.addEventListener('keyup', () => {
    const email = emailInput.value;
    const isValid = validateEmail(email);

    if (isValid) {
        errorMessage.style.display = "none";
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
        editbtn.disabled = false;
    } else {
        appear("Email is not valid");

        emailInput.classList.add('is-invalid');
        emailInput.classList.remove('is-valid');
        editbtn.disabled = true;
    }
});

function editUser() {
    let id = document.getElementById('id').value;
    let username = document.getElementById('editUsername').value;
    let email = document.getElementById('editEmail').value;
    $.ajax({
        url: '/edit/' + id + '/' + username + '/' + email,
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken(),
        },
        success: function(data) {
            alert(data.message);
            window.location.reload();
        },
        error: function(error) {
            alert(error.responseText);
            window.location.reload();
        },
    });
}
function showAddFeild(){
    document.getElementById("addUserName").value = "";
    document.getElementById("addEmail").value = "";
    document.getElementById("addPassword").value = "";
    $('#addUserModal').modal('show');
}
function showEditFeild(id, username, email, val) {
    const editUsername = document.getElementById('editUsername');
    const editEmail = document.getElementById('editEmail');
    const editId = document.getElementById("id");
    editId.value = id;
    if (typeof email === "undefined" || typeof username === "undefined") {
        const clickedButton = event.target;
        email = clickedButton.dataset.email;
        username = clickedButton.dataset.username;
    }
    editUsername.value = username;
    editEmail.value = email;
    $('#editUserModal').modal('show');
}
document.addEventListener("DOMContentLoaded", function() {
    function csrfToken() {
        let csrfTokenElement = document.querySelector("input[name='_token']");
        if (csrfTokenElement) {
            return csrfTokenElement.value;
        } else {
            return "";
        }
    }
    $(".btn-danger").click(function() {
        let userId = $(this).closest("tr").find(".user-id").text();
        deleteUser(userId);
    });
});
