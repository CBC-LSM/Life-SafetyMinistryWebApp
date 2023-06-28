// Define the images and their associated data
const images = [
    {
        src: "img/img1.jpg",
        name: "Unknown",
        date: "April 30, 2023",
        notes: "Entered Lobby 4, acted like he knew some people in our previous minstries. Wanted money to get on the bus. Once he got the money he left. Total time in church was roughly 15mins. We did not get a chance to confront.",
    },
    {
        src: "img/img2.jpg",
        name: "Tommy and Judy Ackerson",
        date: "January 1, 2023",
        notes: "We have had some issues with these two about asking for money, lurking/taking pictures of a young woman in the church. He has some mental issues. Approached by Tyler on May 14th for taking pictures. They have not returned. Be mindful that if they do return they may have a conflict with Tyler and need to ensure we contain them and monitor their time on campus closely.",
    },
    {
        src: "img/img3.jpg",
        name: "Unknown",
        date: "December 2019",
        notes: "This gentleman approached Pastor Eric and gave him a story that had a lot of holes in it. He did not appreciate being called out for his broken story and left with not receiving any aid but not necessarily the happiest person. He may have a small grudge against Pastor Eric regarding this encounter.",
    },
    // Add more images here
];

let currentIndex = 0;

// Function to update the gallery with the current image data
function updateGallery() {
    const currentImage = images[currentIndex];
    document.getElementById("gallery-image").src = currentImage.src;
    document.getElementById("image-name").textContent = currentImage.name;
    document.getElementById("image-date").textContent = currentImage.date;
    document.getElementById("image-notes").textContent = currentImage.notes;
}

// Function to navigate to the previous image
function prevImage() {
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateGallery();
}

// Function to navigate to the next image
function nextImage() {
    currentIndex = (currentIndex + 1) % images.length;
    updateGallery();
}

// Attach event listeners to the arrow buttons
document.getElementById("prev-btn").addEventListener("click", prevImage);
document.getElementById("next-btn").addEventListener("click", nextImage);

// Initialize the gallery with the first image
updateGallery();
