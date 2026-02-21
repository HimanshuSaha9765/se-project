function validateImage(input) {
    if (input.files && input.files[0]) {
        const fileName = input.files[0].name;
        const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.test(fileName)) {
            alert("Please select an image file (jpg, jpeg, png, or gif).");
            input.value = "";
            return false;
        }
    }
    return true;
}