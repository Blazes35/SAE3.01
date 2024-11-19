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

