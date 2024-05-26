document.addEventListener('DOMContentLoaded', function() {
    // Get the form element
    const form = document.querySelector('.pruducts-form');

    form.addEventListener('submit', function(event) {
        console.log("clicked");
        event.preventDefault(); // Prevent default form submission

        // Validate form fields
        const title = document.getElementById('title').value.trim();
        const reservePrice = document.getElementById('reservePrice').value.trim();
        const condition = document.getElementById('condition').value;
        const deliveryType = document.getElementById('deloveryType').value;
        const category = document.getElementById('category').value;
        const days = document.getElementById('days').value.trim();

        if (!title || !reservePrice || condition === 'Choose...' || deliveryType === 'Choose...' || category === 'Please select the auction category...') {
            swal("Please fill in all required fields.", "", "error");
            return;
        }

        // if (days >= 30) {
        //     swal("Maximum 29 days allowed", "", "error");
        // } else if (days <= 2) {
        //     swal("Minimum 3 days required", "", "error");
        // }
        

        // const fileInput = document.getElementById('imgMultiple');
        // if (!fileInput.files || fileInput.files.length < 3) {
        //     swal("Please upload at least 3 images.", "", "error");
        //     return;
        // }

        // Check file extensions
        // const allowedExtensions = ['jpg', 'jpeg', 'png'];
        // for (let i = 0; i < fileInput.files.length; i++) {
        //     const file = fileInput.files[i];
        //     const fileName = file.name.toLowerCase();
        //     const fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
        //     if (!allowedExtensions.includes(fileExtension)) {
        //         swal("Invalid file extension. Only JPG, JPEG, and PNG files are allowed.", "", "error");
        //         return;
        //     }
        // // }

        // If all validations pass, submit the form
        form.submit();
    });
});
