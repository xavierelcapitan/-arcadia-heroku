const swiper = new Swiper('.swiper-container', {
    loop: true,
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    spaceBetween: 10,  // Espace entre les slides pour mobile
    slidesPerView: 1,  // Un slide visible à la fois sur mobile

    // Breakpoints pour ajuster selon la taille d'écran
    breakpoints: {
        640: {
            slidesPerView: 2,
            spaceBetween: 20,
        },
        768: {
            slidesPerView: 3,
            spaceBetween: 30,
        },
        1024: {
            slidesPerView: 3,
            spaceBetween: 40,
        },
    },
});

// Sélection des éléments
const modal = document.getElementById("reviewModal");
const btn = document.getElementById("openModal");
const closeBtn = document.querySelector(".close");

// Ouvre la modale quand on clique sur le bouton
btn.onclick = function () {
    modal.style.display = "block";
}

// Ferme la modale quand on clique sur le bouton de fermeture (X)
closeBtn.onclick = function () {
    modal.style.display = "none";
}

// Ferme la modale quand on clique en dehors de la modale
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
