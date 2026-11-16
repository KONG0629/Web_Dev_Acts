function updateFileName() {
    const fileInput = document.getElementById('file-input');
    const fileNameContainer = document.getElementById('file-name');
    
    if (fileInput.files.length > 0) {
        const fileName = fileInput.files[0].name;
        fileNameContainer.textContent = fileName;
    } else {
        fileNameContainer.textContent = 'No image uploaded';
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const table = document.querySelector('table'); // Get the table element
    const display = document.getElementById('display'); // Where the content will be shown

    // Event delegation: Listen for clicks on any link with the class 'edit-draft' within the table
    table.addEventListener('click', function (e) {
        // Check if the clicked element is an 'a' tag with the class 'edit-draft'
        if (e.target && e.target.matches('a.edit-draft')) {
            e.preventDefault(); // Prevent default link behavior

            // Get draft data from the data-* attributes
            const draftId = e.target.dataset.draftId;
            const title = e.target.dataset.title;
            const text = e.target.dataset.text;
            const tag = e.target.dataset.tag;
            const attachment = e.target.dataset.attachment; // this is the file path

            // Use Fetch API to load the content for editing the draft
            fetch("edit-draft.php")
                .then(response => response.text())
                .then(data => {
                    // Insert the content into the display container
                    display.innerHTML = data;

                    // Now that the overlay content is loaded, add the event listeners
                    const overlay = document.getElementById('overlay');
                    const exitButton = document.getElementById('exit-button');

                    // Check if elements exist
                    if (!overlay || !exitButton) {
                        console.error("Overlay or Exit button not found in the dynamically loaded content!");
                        return;
                    }

                    // Populate form fields with draft data
                    document.querySelector('input[name="title"]').value = title;
                    document.querySelector('textarea[name="body"]').value = text;
                    document.querySelector('select[name="tags"]').value = tag;
                    
                    // Display the image if it exists
                    const fileNameContainer = document.getElementById('file-name');
                    if (attachment) {
                        fileNameContainer.textContent = attachment.split('/').pop(); // Display just the file name
                    } else {
                        fileNameContainer.textContent = 'No image uploaded';
                    }

                    // Show the overlay
                    overlay.style.display = 'flex';

                    // Close the overlay when the exit button is clicked
                    exitButton.addEventListener('click', function () {
                        overlay.style.display = "none";  // Hide the overlay
                    });
                })
                .catch(error => alert("Error loading content:", error));
        }
    });
});

document.querySelectorAll('.edit-draft').forEach(function (draftLink) {
    draftLink.addEventListener('click', function (e) {
        e.preventDefault();

        const draftId = this.dataset.draftId;
        const title = this.dataset.title;
        const text = this.dataset.text;
        const tag = this.dataset.tag;
        const attachment = this.dataset.attachment;  // Get the attachment URL

        // Set the form values
        document.querySelector('[name="title"]').value = title;
        document.querySelector('[name="body"]').value = text;
        document.querySelector('[name="tags"]').value = tag;
        
        // Set the hidden input for the image path
        document.querySelector('[name="image_path"]').value = attachment; // Set the image path

        // Display the filename in the UI
        const fileNameContainer = document.getElementById('file-name');
        if (attachment) {
            fileNameContainer.textContent = attachment.split('/').pop();
        } else {
            fileNameContainer.textContent = 'No image uploaded';
        }

        // Optionally, you can display the image in the preview area if desired
        const previewImage = document.getElementById('preview-image');
        if (attachment) {
            previewImage.src = attachment;
            previewImage.style.display = 'block';
        }
    });
});