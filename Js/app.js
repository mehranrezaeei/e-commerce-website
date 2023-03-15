// Rotated Arrow Key
const sess = document.querySelector(".test-session");
if (sess) {
  sess.addEventListener("click", () => {
    sessionStorage.setItem("name", "mehran");
  });
}
window.onload = () => {
  if (sessionStorage.getItem("name")) {
    console.log(sessionStorage.getItem("name"));
  } else {
    console.log("No Session Exists");
  }
};
const borger_list_ul = document.querySelector(".borger-ul-list");
if (borger_list_ul) {
  borger_list_ul.addEventListener("click", (e) => {
    if (e.target.classList.contains("top-item-borger-list")) {
      const lielement = e.target;
      const arrow_rotate = lielement.lastElementChild;
      if (arrow_rotate.classList.contains("arrow-active")) {
        arrow_rotate.classList.remove("arrow-active");
      } else {
        arrow_rotate.classList.add("arrow-active");
      }
    }
  });
}
// ------------------------------------------

// Top Scroll
const top_scroll = document.querySelector(".top-scroll");
window.onscroll = function () {
  if (top_scroll) {
    if (
      document.body.scrollTop > 170 ||
      document.documentElement.scrollTop > 170
    ) {
      top_scroll.classList.add("d-block");
      top_scroll.classList.remove("d-none");
    } else {
      top_scroll.classList.remove("d-block");
      top_scroll.classList.add("d-none");
      top_scroll.getElementsByClassName.display = "none";
    }
  }
};
if (top_scroll) {
  top_scroll.addEventListener("click", () => {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  });
}
// Top Scroll Ends -------------------------

// This is For Moving Animation On Text
let smcounter = 0;
const mov_anim = document.querySelector(".mov-anim");
if (mov_anim) {
  setInterval(() => {
    if (smcounter > document.body.offsetWidth) {
      smcounter = -100;
    }
    smcounter += 30;
    mov_anim.style.right = `${smcounter}px`;
  }, 50);
}

// This Part Is For Product Page
const product_images = document.querySelector(".product-page-i-c-images");
const product_lg_img = document.querySelector(".product-lg-img");
if (product_images) {
  product_images.addEventListener("click", (e) => {
    if (e.target.classList.contains("product-sm-img")) {
      product_lg_img.src = e.target.src;
      console.log(product_lg_img.src);
    }
  });
}

// This iS For Login PAge
const loginToggleButton = document.querySelector(".login-toggle-btn");
const registerToggleButton = document.querySelector(".register-toggle-btn");
const loginform = document.querySelector(".login-form");
const registerform = document.querySelector(".register-form");
if (loginToggleButton) {
  loginToggleButton.addEventListener("click", () => {
    changetoggleUi(loginToggleButton, registerToggleButton);
    changetoggleStatus(loginform, registerform);
  });
}
if (registerToggleButton) {
  registerToggleButton.addEventListener("click", () => {
    changetoggleUi(registerToggleButton, loginToggleButton);
    changetoggleStatus(registerform, loginform);
  });
}

function changetoggleUi(currentElement, otherElement) {
  if (currentElement.classList.contains("toggle-btn-active")) {
  } else {
    otherElement.classList.remove("toggle-btn-active");
    currentElement.classList.add("toggle-btn-active");
  }
}

function changetoggleStatus(currentElement, otherElement) {
  if (currentElement.classList.contains("form-active")) {
  } else {
    currentElement.classList.add("form-active");
    otherElement.classList.remove("form-active");
  }
}

// This is For Form Validations
if (loginform) {
  loginform.addEventListener("submit", (e) => {
    if (formValidation(loginform, "login")) {
    } else {
      e.preventDefault();
    }
  });
}
if (registerform) {
  registerform.addEventListener("submit", (e) => {
    if (formValidation(registerform, "register")) {
    } else {
      e.preventDefault();
    }
  });
}

function formValidation(form, formname) {
  let validatedinput = 0;
  const inputs = form.elements;
  const fname = inputs["firstname"];
  const lname = inputs["lastname"];
  const username = inputs["username"];
  const password = inputs["password"];
  const re_password = inputs["re-password"];
  if (formname === "login") {
    if (username.value === "" || username.value === null) {
      validatedinput++;
      username.parentElement.classList.add("validate-alert");
    } else {
      username.parentElement.classList.remove("validate-alert");
    }
    if (password.value === "" || username.value === null) {
      validatedinput++;
      password.parentElement.classList.add("validate-alert");
    } else {
      password.parentElement.classList.remove("validate-alert");
    }
    if (validatedinput > 0) {
      return false;
    } else {
      return true;
    }
  } else {
    if (fname.value === "" || fname.value === null) {
      validatedinput++;
      fname.parentElement.classList.add("validate-alert");
    } else {
      fname.parentElement.classList.remove("validate-alert");
    }
    if (lname.value === "" || fname.value === null) {
      validatedinput++;
      lname.parentElement.classList.add("validate-alert");
    } else {
      lname.parentElement.classList.remove("validate-alert");
    }
    if (username.value === "" || fname.value === null) {
      validatedinput++;
      username.parentElement.classList.add("validate-alert");
    } else {
      username.parentElement.classList.remove("validate-alert");
    }
    if (password.value === "" || fname.value === null) {
      validatedinput++;
      password.parentElement.classList.add("validate-alert");
    } else {
      password.parentElement.classList.remove("validate-alert");
    }
    if (re_password.value === "" || fname.value === null) {
      validatedinput++;
      re_password.parentElement.classList.add("validate-alert");
    } else {
      re_password.parentElement.classList.remove("validate-alert");
      if (re_password.value !== password.value) {
        validatedinput++;
        re_password.parentElement.classList.add("validate-alert");
      } else {
        re_password.parentElement.classList.remove("validate-alert");
      }
    }
    if (validatedinput > 0) {
      return false;
    } else {
      return true;
    }
  }
}
