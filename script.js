function displayImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            const imageContainer = document.getElementById('imageContainer');
            imageContainer.innerHTML = '';
            imageContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    }
}
