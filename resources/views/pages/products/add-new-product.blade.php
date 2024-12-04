<x-default-layout>

    @section('title')
        Product Information
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="card mb-10">
        <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-10">
                <div class="card-header">
                    <h3 class="card-title">Upload Images</h3>
                </div>
                <div class="card-body">
                    <div class="mb-10">
                        <!-- Image input wrapper -->
                        <div class="mt-1 d-flex justify-content-center align-items-center">
                            <!-- Image input -->
                            <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <!-- Preview existing avatar -->
                                <div class="image-input-wrapper w-300px h-250px" id="image-preview" style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}');"></div>
                                <!-- Edit button -->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                    <i class="ki-duotone ki-pencil fs-7">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <!-- Inputs -->
                                    <input type="file" class="form-control" name="product_images[]" id="product_images" multiple />
                                    <input type="hidden" name="image_remove" />
                                </label>

                                <!-- Cancel and Remove buttons -->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                        </div>

                        <!-- Add images section -->
                        <div class="form-text text-center fw-bolder">Add images or drop your images here or select</div>
                        <div class="mt-4">
                            <button type="button" id="add-image-btn" class="btn btn-primary">Add Image</button>
                        </div>

                        <div class="mt-4 d-flex gap-5 flex-wrap" id="uploaded_images">
                            <!-- Dynamically added images preview here -->
                        </div>

                        <div class="mt-3">
                            You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details.
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div>

            <div class="card card-flush mb-10">
                <div class="card-header">
                    <h3 class="card-title">Product Details</h3>
                </div>
                <div class="card-body">
                    <!-- Product Title -->
                    <div class="mb-10">
                        <label class="form-label required">Product Title</label>
                        <input type="text" class="form-control" placeholder="Enter title" name="name" maxlength="20" id="name" >
                        <span class="form-text text-muted">Do not exceed 20 characters when entering the product name.</span>
                    </div>

                    <!-- Category -->
                    <div class="row g-9 mb-10">
                        <div class="col-md-6">
                            <label class="form-label required">Category</label>
                            <select class="form-select" name="category_id" id="category_id" >
                                <option value="" disabled selected>Choose category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                {{-- <option value="1">Category 1</option>
                                <option value="2">Category 2</option>
                                <option value="3">Category 3</option> --}}
                            </select>
                        </div>

                        <!-- Price -->
                        <div class="col-md-6">
                            <label class="form-label required">Price</label>
                            <input type="number" class="form-control" placeholder="Price" name="price" id="price" >
                        </div>
                    </div>

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6 mb-10">
                            <!--begin::Input wrapper-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Size</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" title="Select an option.">
                                        <i class="ki-duotone ki-information text-gray-500 fs-7">
                                            <span class="path1"></span><span class="path2"></span><span class="path3"></span>
                                        </i>
                                    </span>
                                    <span class="selected-size ms-2 text-primary fw-bold" id="selected-size">
                                        {{ old('size', 'None') }}
                                    </span>
                                </label>
                                <!--end::Label-->

                                <!--begin::Buttons-->
                                <div class="d-flex flex-stack gap-5 mb-3">
                                    @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <button type="button"
                                                class="btn w-100 size-btn {{ old('size') === $size ? 'btn-primary' : 'btn-light-primary' }}"
                                                data-size="{{ $size }}">
                                            {{ $size }}
                                        </button>
                                    @endforeach
                                </div>
                                <!--end::Buttons-->
                            </div>
                            <!-- Stock -->
                            <div class="mb-4">
                                <label class="form-label d-flex required">Stock</label>
                                <input type="number" class="form-control" placeholder="Enter Stock" name="quantity" value="{{ old('stock') }}">
                            </div>
                            <!-- Hidden input to store the selected size -->
                            <input type="hidden" name="size" id="size-input" value="{{ old('size') }}">
                            <!--end::Input wrapper-->
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6 mb-10">
                            <!-- Wrapper Div to Handle Structure and Spacing -->
                            <div class="d-flex flex-column">
                                <!-- Checkbox to Toggle the Collapsible Section -->
                                <label class="btn btn-outline btn-outline-dashed d-flex text-start p-6 align-items-start">
                                    <input type="hidden" name="has_discount" value="0">
                                    <!-- Checkbox for Selling Price -->
                                    <span class="form-check form-check-custom form-check-solid form-check-sm mt-1">
                                        <input
                                            id="sellingPriceToggle"
                                            name="has_discount"
                                            class="form-check-input"
                                            type="checkbox"
                                            value="1"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#sellingPriceOptions"
                                            aria-expanded="false"
                                            aria-controls="sellingPriceOptions"
                                        />
                                    </span>
                                    <!-- Info and Label Text -->
                                    <span class="ms-5 d-flex flex-column">
                                        <span class="fs-4 fw-bold text-gray-800 text-nowrap mb-2" for="sellingPriceToggle">Discount Price</span>

                                        <!-- Collapsible Section for Sale Price and Schedule -->
                                        <div id="sellingPriceOptions" class="collapse mt-4">
                                            <!-- Sale Price Input -->
                                            <div class="mb-10">
                                                <label class="form-label">Sale Price</label>
                                                <input type="number" class="form-control" placeholder="Discount Price" name="discount_price">
                                            </div>
                                            <!-- Schedule Input -->
                                            <div>
                                                <label class="form-label">Schedule</label>
                                                <input type="date" class="form-control" name="discount_date">
                                            </div>
                                        </div>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row g-9 mb-10">
                        <!-- Variant: Color -->
                        <div class="col-md-4">
                            <label class="form-label">Color</label>
                            <input type="text" class="form-control" placeholder="Choose color" name="color" >
                        </div>
                        <!-- SKU -->
                        <div class="col-md-4">
                            <label class="form-label">SKU</label>
                            <input type="text" class="form-control" placeholder="Enter SKU" name="sku">
                        </div>

                        {{-- <!-- Tags -->
                        <div class="col-md-4">
                            <label class="form-label">Tags</label>
                            <input type="text" class="form-control" placeholder="Enter a tag" name="tags">
                        </div> --}}
                    </div>

                    <!-- Description -->
                    <div class="mb-10">
                        <label class="form-label required">Description</label>
                        <textarea class="form-control" name="description" placeholder="Short description about product" maxlength="100" ></textarea>
                        <span class="form-text text-muted">Do not exceed 100 characters when entering the description.</span>
                    </div>
                </div>
                <!--begin::Actions-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
                <!--end::Actions-->
            </div>
        </form>
    </div>


<script>

    document.addEventListener('DOMContentLoaded', () => {

    // Size selection functionality
    const buttons = document.querySelectorAll('.size-btn');
    const selectedSizeSpan = document.getElementById('selected-size');
    const sizeInput = document.getElementById('size-input');

    // Function to handle size button click
    const updateSizeSelection = (button) => {
        const selectedSize = button.getAttribute('data-size');
        selectedSizeSpan.textContent = selectedSize;
        sizeInput.value = selectedSize;
        updateButtonStyles(button);
    };

    // Function to update button styles
    const updateButtonStyles = (selectedButton) => {
        buttons.forEach(button => {
            button.classList.remove('btn-primary');
            button.classList.add('btn-light-primary');
        });
        selectedButton.classList.remove('btn-light-primary');
        selectedButton.classList.add('btn-primary');
    };

    // Attach event listeners to size buttons
    buttons.forEach(button => {
        button.addEventListener('click', () => updateSizeSelection(button));
    });


    let selectedFiles = []; // Array to store selected files

        // Function to handle image upload and preview
        const addImageBtn = document.getElementById('add-image-btn');
        const imageInput = document.getElementById('product_images');
        const uploadedImages = document.getElementById('uploaded_images');

        // Function to preview uploaded image
        const previewImage = (file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.alt = 'Uploaded Image';
                img.classList.add('img-thumbnail');
                img.style.width = '300px';
                img.style.height = '250px';
                img.style.objectFit = 'cover';
                uploadedImages.appendChild(img);

                // Push the file to the selectedFiles array
                selectedFiles.push(file);
            };
            reader.readAsDataURL(file);
        };

        // Function to update the hidden input with selected files
        const updateHiddenInput = () => {
            const dataTransfer = new DataTransfer(); // Using DataTransfer to handle file list dynamically
            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });
            hiddenInput.files = dataTransfer.files;
        };

        // Function to handle image add button click
        const handleAddImageClick = () => {
            if (imageInput.files && imageInput.files.length > 0) {
                // Iterate through all selected files and preview them
                for (let i = 0; i < imageInput.files.length; i++) {
                    // Check if the file is already added to avoid duplicates
                    if (!selectedFiles.includes(imageInput.files[i])) {
                        previewImage(imageInput.files[i]);
                    }
                }

                // Ensure all selected files are added to selectedFiles array
                for (let i = 0; i < imageInput.files.length; i++) {
                    // Only add the file if it's not already present
                    if (!selectedFiles.some(f => f.name === imageInput.files[i].name)) {
                        selectedFiles.push(imageInput.files[i]);
                    }
                }

                // Reset the input for new uploads
                imageInput.value = '';
                updateHiddenInput(); // Update the hidden input with selected files
            } else {
                alert('Please select an image first.');
            }
        };

        // Attach event listener to add image button to trigger file input
        addImageBtn.addEventListener('click', () => {
            imageInput.click(); // Simulate file input click
        });

        // Handle file input change event to preview images
        imageInput.addEventListener('change', () => {
            handleAddImageClick();
        });

});

</script>

</x-default-layout>
