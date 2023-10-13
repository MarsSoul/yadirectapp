document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById("loader");

    function showLoader() {
        // console.log('loa')
        loader.style.display = "block";
    }

    function hideLoader() {
        // console.log('X')
        loader.style.display = "none";
    }

    showLoader();

    window.addEventListener("load", function () {
        hideLoader();
    });
});