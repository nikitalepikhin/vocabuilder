const usernameInput = document.getElementsByClassName("username-input")[0];
const passwordInput = document.getElementsByClassName("password-input")[0];
const form = document.getElementsByClassName("form")[0];

form.addEventListener("submit", (e) => {
    function validateUsername() {
        if (usernameInput.value.length === 0) {
            throw new Error("Username or email is required to proceed.");
        }
        if (usernameInput.value.length > 100) {
            throw new Error("The username that you have entered exceeds the allowed length.");
        }
    }

    function validatePassword() {
        if (passwordInput.value.length === 0) {
            throw new Error("Password is required to proceed.")
        }
        if (passwordInput.value.length > 100) {
            throw new Error("The password that you have entered exceeds the allowed length.");
        }
    }

    function createErrorMessageBox(text) {
        const element = document.createElement("div");
        element.classList.add("message");
        element.classList.add("error-message");
        element.innerText = text;
        return element;
    }

    try {
        validateUsername();
        validatePassword();
    } catch (error) {
        const errorBox = createErrorMessageBox(error);
        const existingErrorBox = form.getElementsByClassName("error-message")[0];
        if (existingErrorBox !== undefined) {
            form.removeChild(existingErrorBox);
        }
        form.appendChild(errorBox);
        e.preventDefault();
    }
})