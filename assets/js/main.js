window.addEventListener("scroll", function () {
  const nav = document.querySelector(".gym-navbar");
  nav.classList.toggle("scrolled", window.scrollY > 10);
});
