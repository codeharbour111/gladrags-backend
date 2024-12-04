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
    <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" id="image-form">
        @csrf
        <label for="images">Choose Images:</label>
        <input type="file" name="images[]" id="images" accept="image/*">
        <br><br>

        <!-- Display the selected images -->
        <div class="preview-images" id="image-preview"></div>

        <br><br>
        <button type="submit">Submit</button>
    </form>

    <script>
        // Store the selected files for submission
        let selectedFiles = [];

        // Function to handle image selection, display previews, and store files for submission
        document.getElementById('images').addEventListener('change', function (event) {
            const files = event.target.files;
            const previewContainer = document.getElementById('image-preview');

            // Loop through the selected files and create image previews
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    previewContainer.appendChild(img);

                    // Push the file to the selectedFiles array to store all selected files
                    selectedFiles.push(file);
                };

                reader.readAsDataURL(file);
            }

            // Clear the input value to allow the same file to be selected again
            event.target.value = '';
        });

        // Handle form submission and attach selected files to the form data
        document.getElementById('image-form').addEventListener('submit', function (event) {
            const formData = new FormData();

            // Append each selected file to the FormData object
            selectedFiles.forEach(function (file) {
                formData.append('images[]', file);
            });

            // Prevent default form submission
            event.preventDefault();

            // Send the form data using Fetch API or Axios
            fetch('{{ route("images.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                alert('Images uploaded successfully!');
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>
