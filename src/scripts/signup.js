const firstNameInput = document.getElementsByClassName("first-name-input")[0];
const lastNameInput = document.getElementsByClassName("last-name-input")[0];
const usernameInput = document.getElementsByClassName("username-input")[0];
const emailInput = document.getElementsByClassName("email-input")[0];
const passwordInput = document.getElementsByClassName("password-input")[0];
const passwordRepeatInput = document.getElementsByClassName("password-repeat-input")[0];
const form = document.getElementsByClassName("form")[0];

form.addEventListener("submit", (e) => {
    function validateUsername() {
        if (usernameInput.value.length === 0) {
            throw new Error("The username is required to proceed.");
        }
        if (usernameInput.value.length > 50) {
            throw new Error("The username that you have entered exceeds the allowed length.");
        }
        if (usernameInput.value.match("([a-z0-9_]+\\.?[a-z0-9_]+)+\\.?([a-z0-9_]+\\.?[a-z0-9_]+)+")[0].length !== usernameInput.value.length) {
            throw new Error("The username that you have entered does not match the required format.");
        }
    }

    function validatePassword() {
        if (passwordInput.value.length === 0) {
            throw new Error("Password cannot be empty.");
        }
        if (passwordInput.value.length < 10) {
            throw new Error("The password must be at least 10 characters long.");
        }
        if (passwordInput.value.length > 100) {
            throw new Error("The password that you have entered exceeds the allowed length.")
        }
        if (passwordInput.value.match("[0-9]+") === null) {
            throw new Error("Password must contain at least one digit.");
        }
        if (passwordInput.value.match("[A-Z]+") === null) {
            throw new Error("Password must contain at least one capital letter.");
        }
        if (passwordInput.value.match("[a-z]+") === null) {
            throw new Error("Password must contain at least one small letter.");
        }
        if (passwordInput.value.match(/[\\~`!@#$%^&*()\-_+={}\[\]|/:;"'<>,.?]+/) === null) {
            throw new Error("Password must contain at least one special character.");
        }
        validatePasswordRepeat();
    }

    function validateFirstName() {
        if (firstNameInput.value.length > 0) {
            if (firstNameInput.value.length > 50) {
                throw new Error("The first name that you have entered exceeds the allowed length.")
            }
            if (firstNameInput.value.match("[a-zA-Z- ]+")[0].length !== firstNameInput.value.length) {
                throw new Error("Invalid first name.");
            }
        }
    }

    function validateLastName() {
        if (lastNameInput.value.length > 0) {
            if (lastNameInput.value.length > 50) {
                throw new Error("The last name that you have entered exceeds the allowed length.");
            }
            if (lastNameInput.value.match("[a-zA-Z- ]+")[0].length !== lastNameInput.value.length) {
                throw new Error("Invalid last name.");
            }
        }
    }

    function validateEmail() {
        if (emailInput.value.length > 100) {
            throw new Error("The email that you have entered exceeds the allowed length.");
        }
        const officialEmailRegex = "(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\\])";
        if (emailInput.value.match(officialEmailRegex)[0].length !== emailInput.value.length) {
            throw new Error("The email that you have entered does not match the required format.");
        }
    }

    function validatePasswordRepeat() {
        if (passwordRepeatInput.value.length > 100) {
            throw new Error("The repeated password that you have entered exceeds the allowed length.")
        }
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
        validateFirstName();
        validateLastName();
        validateEmail();
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