"use strict";
let footerRows = document.querySelectorAll(".footer_hover");
footerRows.forEach(row => {
    let rowText = row.textContent
    let altRowText = row.getAttribute("id");
    row.addEventListener("mouseover", event => {
        row.textContent = altRowText
    });
    row.addEventListener("mouseout", event => {
        row.textContent = rowText;
    });

});