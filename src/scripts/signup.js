const firstNameInput = document.getElementsByClassName("first-name-input")[0];
const lastNameInput = document.getElementsByClassName("last-name-input")[0];
const usernameInput = document.getElementsByClassName("username-input")[0];
const emailInput = document.getElementsByClassName("email-input")[0];
const birthdateInput = document.getElementsByClassName("date-of-birth-input")[0];
const passwordInput = document.getElementsByClassName("password-input")[0];
const passwordRepeatInput = document.getElementsByClassName("password-repeat-input")[0];
const form = document.getElementsByClassName("form")[0];

form.addEventListener("submit", (e) => {
    function controlUsername() {
        if (usernameInput.value.length === 0) {
            throw new Error("Username cannot be empty.");
        }
        if (usernameInput.value.match("([a-z0-9_]+\\.?[a-z0-9_]+)+\\.?([a-z0-9_]+\\.?[a-z0-9_]+)+")[0].length !== usernameInput.value.length) {
            throw new Error("Invalid username format. Username should contain only letters, numbers, underscores and full stops. " +
                "Full stops are not allowed as the first or the last symbol.");
        }
    }

    function controlPassword() {
        if (passwordInput.value.length === 0) {
            throw new Error("Password cannot be empty.");
        }
        if (passwordInput.value.match("[0-9]+") === null) {
            throw new Error("Password should contain at least one digit.");
        }
        if (passwordInput.value.match("[A-Z]+") === null) {
            throw new Error("Password should contain at least one capital letter.");
        }
        if (passwordInput.value.match("[a-z]+") === null) {
            throw new Error("Password should contain at least one small letter.");
        }
        if (passwordInput.value.match("[~`!@#\$%\^&\*()-_\+=\{\}\[\]|\\/:;\"'<>,.\?]+") === null) {
            throw new Error("Password should contain at least one special character.");
        }
        controlPasswordRepeat();
    }

    function controlFirstName() {
        if (firstNameInput.value.match("[A-Za-z ]+")[0].length !== firstNameInput.value.length) {
            throw new Error("Invalid first name.");
        }
    }

    function controlLastName() {
        if (lastNameInput.value.match("[A-Za-z ]+")[0].length !== lastNameInput.value.length) {
            throw new Error("Invalid last name.");
        }
    }

    function controlEmail() {
        const officialEmailRegex = "(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\\])";
        if (emailInput.value.match(officialEmailRegex)[0].length !== emailInput.value.length) {
            throw new Error("Invalid email.");
        }
    }

    function controlPasswordRepeat() {
        if (passwordInput.value !== passwordRepeatInput.value) {
            throw new Error("Passwords do not match.");
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
        controlFirstName();
        controlLastName();
        controlEmail();
        controlUsername();
        controlPassword();
    } catch (error) {
        console.log(error);
        const errorBox = createErrorMessageBox(error);
        const existingErrorBox = form.getElementsByClassName("error-message")[0];
        if (existingErrorBox !== undefined) {
            form.removeChild(existingErrorBox);
        }
        form.appendChild(errorBox);
        e.preventDefault();
    }
})