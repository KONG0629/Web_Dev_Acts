
function previewIcon(event) {
    const preview = document.getElementById('iconPreview');
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result; // Update the image source
        };
        reader.readAsDataURL(file); // Read the image file
    }
}

