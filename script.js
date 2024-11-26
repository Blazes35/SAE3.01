function redirectToProduct() {
    window.location.href = 'produit.html';
  }

  document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.first-img img');
    const mainImage = document.getElementById('main-image');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            mainImage.src = this.src;
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById('popup');

    // Assurez-vous que la popup est masquée au chargement
    popup.classList.add('hidden');
    console.log("Popup should be hidden on load:", popup.classList.contains('hidden'));

    const addRoleBtn = document.getElementById('add-role-btn');
    const roleForm = document.getElementById('role-form');
    const roleSelect = document.getElementById('role-select');
    const cancelPopupBtn = document.getElementById('cancel-popup');

    // Ouverture de la popup
    addRoleBtn.addEventListener('click', () => {
        popup.classList.remove('hidden');
        console.log("Popup ouverte !");
    });

    // Validation et fermeture de la popup
    roleForm.addEventListener('submit', (event) => {
        event.preventDefault();
        const selectedRole = roleSelect.value;
        console.log(`Rôle sélectionné : ${selectedRole}`);
        popup.classList.add('hidden'); // Fermeture de la popup
        console.log("Popup fermée après validation !");
    });

    // Annulation et fermeture de la popup
    cancelPopupBtn.addEventListener('click', () => {
        popup.classList.add('hidden');
        console.log("Popup fermée sans validation !");
    });
});


document.addEventListener("DOMContentLoaded", function() {
    const slider = document.querySelector(".slides");
    const slides = document.querySelectorAll(".slide");
    const slideWidth = 600; // Largeur d'une slide
    let index = 0;

    function nextSlide() {
        index++;
        if (index >= slides.length) {
            index = 0; // Revenir au début
        }
        slider.style.transform = `translateX(-${index * slideWidth}px)`;
    }

    // Défilement automatique toutes les 5 secondes
    setInterval(nextSlide, 5000);
});


