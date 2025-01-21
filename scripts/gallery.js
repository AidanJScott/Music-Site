"use strict";
let images = document.querySelectorAll(".gallery img");
images.forEach(image => {
    let imageSource = image.getAttribute("src");
    let altImageSource = image.getAttribute("altSrc");
    image.addEventListener("mouseover", event => {
        image.src = altImageSource
    });
    image.addEventListener("mouseout", event => {
        image.src = imageSource;
    });

});