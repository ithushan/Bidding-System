console.log("forget password js is running");

const changePasswordForm = document.getElementById('changePassword');
let password;
function validateForm() {
    let password = document.getElementById('password').value.trim(); // Move password variable inside the function
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#~$%^&*()_+])[A-Za-z\d!@#~$%^&*()_+]{8,}$/;
  
    if (!passwordRegex.test(password)) {
        swal("Error", "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.", "error");
        return false;
    }

    return true;
}

changePasswordForm.addEventListener('submit', function(event) {
    // event.preventDefault(); 
    console.log("clicked");
    console.log(password);
    // Validate form fields before submission
    if (!validateForm()) {
        // If validation fails, prevent form submission
        return;
    } else {
        swal("Success", "Password changed!", "success");
    }
});
