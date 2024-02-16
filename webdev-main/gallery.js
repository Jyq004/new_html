const images = document.querySelectorAll('.image-container img');
const prevBtn = document.getElementById('prev-btn');
const nextBtn = document.getElementById('next-btn');
let startIndex = 0;
const imagesPerPage = 15; // 5 columns x 3 rows

function showImages(startIndex) {
    images.forEach((image, index) => {
        if (index >= startIndex && index < startIndex + imagesPerPage) {
            image.style.display = 'block';
        } else {
            image.style.display = 'none';
        }
    });
}

function updateButtons() {
    prevBtn.disabled = startIndex === 0;
    nextBtn.disabled = startIndex + imagesPerPage >= images.length;
}

showImages(startIndex);
updateButtons();

prevBtn.addEventListener('click', () => {
    startIndex = Math.max(0, startIndex - imagesPerPage);
    showImages(startIndex);
    updateButtons();
});

nextBtn.addEventListener('click', () => {
    startIndex = Math.min(images.length - imagesPerPage, startIndex + imagesPerPage);
    showImages(startIndex);
    updateButtons();
});
