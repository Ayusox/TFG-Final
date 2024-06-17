document.addEventListener('DOMContentLoaded', function() {
    const images = [
        'imagenes/coche.jpg',
        'imagenes/coche2.jpg',
        'imagenes/coche3.jpg',
        'imagenes/coche4.jpg',
        'imagenes/coche5.jpg'
    ];
    let currentIndex = 0;

    const imageElement = document.getElementById('imagen-cambiante');
    function changeImage() {
        currentIndex = (currentIndex + 1) % images.length;
        imageElement.src = images[currentIndex];
    }

    setInterval(changeImage, 4000);
});

