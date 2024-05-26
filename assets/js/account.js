document.addEventListener('DOMContentLoaded', function() {
console.log("account section js is runnig");

// sections
const signInSection = document.querySelector('.sign-in');
const signUpSection = document.querySelector('.sign-up');

// buttons
const sign_in = document.querySelector('.signinBtn');
const sign_up = document.querySelector('.signupBtn');

// changePassword
const changePasswordBtn = document.getElementById('changePassword');

sign_up.addEventListener('click', function(event) {
  event.preventDefault();

  signInSection.style.display = 'none';
  signUpSection.style.display = 'block';
})

sign_in.addEventListener('click', function(event) {
  event.preventDefault();

  signUpSection.style.display = 'none';
  signInSection.style.display = 'block';
})


// sig up section panel



// validaion

function validateForm() {
  var Name = document.getElementById('name').value.trim();
  // var lastName = document.getElementById('lname').value.trim();
  var nic = document.getElementById('NIC').value.trim();
  var email = document.getElementById('email').value.trim();
  var password = document.getElementById('password').value.trim();
  var address1 = document.getElementById('inputAddress').value.trim();
  var address2 = document.getElementById('inputAddress2').value.trim();
  var city = document.getElementById('inputCity').value.trim();
  var zip = document.getElementById('inputZip').value.trim();
  var profilePic = document.getElementById('inputGroupFile').value.trim();

  var nameRegex = /^[a-zA-Z\s]+$/;
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/;
  var zipRegex = /^\d{5}$/;
  var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
  var maxSize = 5 * 1024 * 1024; // 5MB

  if(!nameRegex.test(Name)){
    swal("Please enter a valid name (letters and spaces only).", "", "error");
    // alert('Please enter a valid name (letters and spaces only).');
    return false;
  }
  else if(!emailRegex.test(email)){
    alert('Please enter a valid email address.');
    return false;
  }
  else if(!passwordRegex.test(password)){
    swal("Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.", "", "error");
    // alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.');
    return false;
  }
  else if(address1 === '' || address2 === ''){
    alert('Please enter both address lines.');
    return false;
  }
  else if(city.toLowerCase() !== 'vavuniya' && city.toLowerCase() !== 'jaffna'){
    alert('City must be either Vavuniya or Jaffna.');
    return false;
  }
  else if(!zipRegex.test(zip)){
    alert('Please enter a valid 5-digit zip code.');
    return false;
  }
  else if (profilePic !== '') {
    var fileSize = document.getElementById('inputGroupFile').files[0].size;
    if (fileSize > maxSize) {
      alert('Profile picture size exceeds the maximum allowed limit (5MB).');
      return false;
    }
    else if (!allowedExtensions.test(profilePic)) {
      alert('Please upload a valid profile picture (JPEG or PNG format only).');
      return false;
    }
  }

  alert("Success");
  return true;
}

document.getElementById('registrationForm').addEventListener('submit', function(event) {
  console.log("clicked");
  // Validate form fields before submission
  if (!validateForm()) {
      // If validation fails, prevent form submission
      event.preventDefault();
  }
});

changePasswordBtn.addEventListener('click', function(event) {
  console.log("Change password button clicked");
  // Validate form fields before submission
  if (!validatePassword()) {
    // If validation fails, prevent the default action (e.g., form submission)
    event.preventDefault();
  }
});
});

