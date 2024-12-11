<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Multiple Images</title>
    <style>
        .preview-images { display: flex; flex-wrap: wrap; gap: 10px; }
        .preview-images img { width: 100px; height: 100px; object-fit: cover; }
    </style>
</head>
<body>
    <h1>Upload Multiple Images</h1>

    <!-- Form to upload images -->
    <form id="image-form">
        <label for="images">Choose Images:</label>
        <input type="file" id="images" accept="image/*" multiple>
        <br><br>

        <!-- Display the selected images -->
        <div class="preview-images" id="image-preview"></div>

        <br><br>
        <button type="submit">Submit</button>
    </form>

    <script>
        const previewContainer = document.getElementById('image-preview');
        const selectedFiles = [];

        // Handle file selection
        document.getElementById('images').addEventListener('change', function (event) {
            const files = Array.from(event.target.files);

            files.forEach(file => {
                const reader = new FileReader();

                reader.onload = function (e) {
                    // Create a preview for each selected file
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);
                };

                reader.readAsDataURL(file);

                // Store the file for submission
                selectedFiles.push(file);
            });

            // Reset the input to allow re-selecting the same file
            event.target.value = '';
        });

        // Handle form submission
        document.getElementById('image-form').addEventListener('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            const formData = new FormData();

            // Append all selected files to FormData
            selectedFiles.forEach(file => {
                formData.append('images[]', file);
            });

            // Submit the form using Fetch API
            fetch('{{ route("images.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Images uploaded successfully!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error uploading images.');
            });
        });
    </script>
</body>
</html>
