document.getElementById("create-post-on").addEventListener("click", function () {
    fetch("create-post.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("display").innerHTML = data;

            // After the content is loaded, attach the close overlay functionality
            const overlay = document.getElementById("overlay");
            const exitButton = document.getElementById("exit-button");

            // Add event listener to close the overlay when the exit button is clicked
            exitButton.addEventListener("click", function() {
                overlay.style.display = "none";  // Hide the overlay
            });
        })
        .catch(error => alert("Error loading content:", error));
});

function updateFileName() {
    const fileInput = document.getElementById('file-input');
    const fileNameContainer = document.getElementById('file-name');
    
    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        fileNameContainer.textContent = fileName;
    } else {
        fileNameContainer.textContent = 'No image uploaded'
    }
}