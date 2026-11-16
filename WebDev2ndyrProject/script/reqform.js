//requestForm
// para gumana yung upload tulad ng normal na file upload
const fileUploadArea = document.getElementById('fileUploadArea');
const fileInput = document.getElementById('fileUpload');

fileUploadArea.addEventListener('click', () => {
    fileInput.click();
});