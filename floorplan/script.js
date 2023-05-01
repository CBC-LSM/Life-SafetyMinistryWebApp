const overlay = document.querySelector('#overlay');
const overlayImage = document.querySelector('#overlay-image');
const overlayDescription = document.querySelector('#overlay-description');
const zoomInButton = document.querySelector('#zoom-in');
const zoomOutButton = document.querySelector('#zoom-out');
const closeButton = document.querySelector('#close-button');

const thumbnails = document.querySelectorAll('.thumbnail');

let scale = 1;

// Set black background on overlay
const overlayBackground = document.querySelector('#overlay-background');
overlayBackground.style.backgroundColor = 'black';

// Hide zoom and close buttons
zoomInButton.style.display = 'none';
zoomOutButton.style.display = 'none';
closeButton.style.display = 'none';

thumbnails.forEach((thumbnail) => {
  thumbnail.addEventListener('click', (event) => {
    const image = event.currentTarget.querySelector('img');
    const description = image.getAttribute('data-desc');
    overlayDescription.textContent = description;
    overlayImage.src = image.src;

    // Reset scale
    scale = 1;
    overlayImage.style.transform = `scale(${scale})`;

    // Show zoom and close buttons
    zoomInButton.style.display = 'block';
    zoomOutButton.style.display = 'block';
    closeButton.style.display = 'block';

    overlay.classList.add('open');
  });
});

zoomInButton.addEventListener('click', () => {
  scale += 0.1;
  overlayImage.style.transform = `scale(${scale})`;
});

zoomOutButton.addEventListener('click', () => {
  if (scale > 0.2) {
    scale -= 0.1;
    overlayImage.style.transform = `scale(${scale})`;
  }
});

closeButton.addEventListener('click', () => {
  overlay.classList.remove('open');

  overlay.classList.remove('open');
//   overlay.style.display = "";
  // Reset scale
  scale = 1;
  overlayImage.style.transform = `scale(${scale})`;

  // Hide zoom and close buttons
  zoomInButton.style.display = 'none';
  zoomOutButton.style.display = 'none';
  closeButton.style.display = 'none';
});
