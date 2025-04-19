if (window.location.search) {
    const url = window.location.origin + window.location.pathname; // Get the base URL
    window.history.replaceState({}, document.title, url); // Replace URL without reloading
}