const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");

signupBtn.onclick = () => {
  loginForm.style.marginLeft = "-50%";
  loginText.style.marginLeft = "-50%";
}

loginBtn.onclick = () => {
  loginForm.style.marginLeft = "0%";
  loginText.style.marginLeft = "0%";
}

signupLink.onclick = () => {
  signupBtn.click();
  return false;
}

// const usuario = document.getElementById("usuario");
// const password = document.getElementById("password");

// function validate() {
//   //checking fields
//   if (
//     usuario.value.length == 0 ||
//     usuario.value.length > 15 ||
//     usuario.value.match(numbers)
//   ) {
//     let parent = usuario.parentElement;
//     parent.querySelector(".error").innerText = "Nombre de usuario incorrecto";
//     parent.querySelector(".error").style.display = "block";
//     error = true;
//   } else {
//     error = false;
//     let parent = usuario.parentElement;
//     parent.querySelector(".error").style.display = "none";
//   }

// }
