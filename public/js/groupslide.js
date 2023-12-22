let slideIndex = 0;
showSlide(slideIndex);

// Auto change slide every 3 seconds (3000 milliseconds)
setInterval(function() {
    changeSlide(1); // Move to the next slide
}, 5000);

function changeSlide(n) {
    showSlide(slideIndex += n);
}

function showSlide(index) {
    const slides = document.getElementsByClassName('netslide');
    const slidestitle = document.getElementsByClassName('netslidestitle');
    //const slideslink = document.getElementsByClassName('netslideslink');
    if (index < 0) {
        slideIndex = slides.length - 1;
    }
    if (index >= slides.length) {
        slideIndex = 0;
    }
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
        slidestitle[i].style.display = 'none';
        //slideslink[i].style.display = 'none';
    }
    slides[slideIndex].style.display = 'block';
    slidestitle[slideIndex].style.display = 'block';
    //slideslink[slideIndex].style.display = 'block';
}
