document.getElementById('backButton').addEventListener('click', function () {
    const previousPage = localStorage.getItem('previousPage');
    if (previousPage) {
        // Redirect to the previous page
        window.location.href = previousPage;
    } else {
        // Handle the case when there is no previous page
        // For example, return to the app's main page
        window.location.href = 'index.html'; // Replace with your main page URL
    }
});
