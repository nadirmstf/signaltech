const burger = document.querySelector('.burger');
const navbarre = document.querySelector('.navbarre');

burger.addEventListener('click', () => {
    navbarre.classList.toggle('open');
});