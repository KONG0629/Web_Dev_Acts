
function confirmDelete() {
    if (confirm("Are you sure you want to delete your account? This action cannot be undone.")) {
        // Redirect to the deleteAccount.php backend to handle account deletion
        window.location.href = "deleteAccount.php";
    }
}
