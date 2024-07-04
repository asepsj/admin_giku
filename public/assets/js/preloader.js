'use strict';

// JavaScript to hide preloader and show content
window.addEventListener('load', function() {
    setTimeout(function() {
        document.querySelector('.preloader').style.display = 'none';
        document.querySelector('.app').style.display = 'block';
    }, 400); // Adjust this value to set the delay (3000ms = 3s)
});