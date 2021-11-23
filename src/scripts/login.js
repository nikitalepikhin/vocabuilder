const usernameInput = document.getElementsByClassName("username-input")[0];
const passwordInput = document.getElementsByClassName("password-input")[0];
const form = document.getElementsByClassName("form")[0];

form.addEventListener("submit", (e) => {
    function controlUsername() {
        if (usernameInput.value.length === 0) {
            throw new Error("Username cannot be empty.");
        }
    }

    function controlPassword() {
        if (passwordInput.value.length === 0) {
            throw new Error("Password cannot be empty.")
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
        controlUsername();
        controlPassword();
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