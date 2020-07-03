const navSlide = ()=>{

    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');

    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click',()=>{
        nav.classList.toggle('nav-active');
        navLinks.forEach((link,header)=>{
          link.style.animation = `navLinkFade 0.5s ease forwards ${header / 7}s`;
        });
        burger.classList.toggle('toggle');
    });
}

const app = ()=>{
    navSlide();
}

app();
