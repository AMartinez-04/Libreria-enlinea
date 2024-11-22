// script.js

// Mensaje de bienvenida
document.addEventListener('DOMContentLoaded', () => {
    console.log('Bienvenido a la Librería Online.');
});

// Animación de scroll para los enlaces
const links = document.querySelectorAll('a');
links.forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const href = link.getAttribute('href');
        if (href.startsWith('#')) {
            document.querySelector(href).scrollIntoView({ behavior: 'smooth' });
        }
    });
});
