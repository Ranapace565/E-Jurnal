document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");
    const showPasswordCheckbox = document.getElementById("show-password");

    showPasswordCheckbox.addEventListener("change", function () {
        if (showPasswordCheckbox.checked) {
            passwordInput.type = "text"; // Tampilkan password
        } else {
            passwordInput.type = "password"; // Sembunyikan password
        }
    });
});
