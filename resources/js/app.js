import './bootstrap';
const eyeIcon = document.getElementById("eye");
const eyeIcon2 = document.getElementById("eye2");
const passwordField = document.getElementById("password");
eyeIcon.addEventListener("click", () => {
  if (passwordField.type === "password" && passwordField.value) {
    passwordField.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");
  } else {
    passwordField.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
  }
});
const passwordFieldConfirmation = document.getElementById("password_confirmation");
eyeIcon2.addEventListener('click', () => {
    if (passwordFieldConfirmation.type === "password" && passwordFieldConfirmation.value) {
    passwordFieldConfirmation.type = "text";
    eyeIcon2.classList.remove("fa-eye");
    eyeIcon2.classList.add("fa-eye-slash");
  } else {
    passwordFieldConfirmation.type = "password";
    eyeIcon2.classList.remove("fa-eye-slash");
    eyeIcon2.classList.add("fa-eye");
  }
});
