"use strict";
let productImages = document.querySelectorAll(".shop_items img");
productImages.forEach(image =>{
    let imageSource = image.getAttribute("src");
    let hoverSource = image.getAttribute("hoverSrc");

    image.addEventListener("mouseover", event =>{
        image.setAttribute("src", hoverSource);
    });

    image.addEventListener("mouseout", event =>{
        image.setAttribute("src", imageSource);
    });
});