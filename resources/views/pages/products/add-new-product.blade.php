<x-default-layout>

    @section('title')
        Product Information
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.add.new.product') }}
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
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url(/assets/media/avatars/300-1.jpg)"></div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change"
                            data-bs-toggle="tooltip"
                            data-bs-dismiss="click"
                            title="Change avatar">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

                                <!--begin::Inputs-->
                                <input type="file" id="product_images" name="product_images[]" accept=".png, .jpg, .jpeg" multiple/>
                                <input type="hidden" name="avatar_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel"
                            data-bs-toggle="tooltip"
                            data-bs-dismiss="click"
                            title="Cancel avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove"
                            data-bs-toggle="tooltip"
                            data-bs-dismiss="click"
                            title="Remove avatar">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->

                        <!-- Add images section -->
                        <div class="form-text text-center fw-bolder">Add images or drop your images here or select</div>


                        <div class="mt-4 d-flex gap-5 flex-wrap" id="image_preview">
                            <!-- Dynamically added images preview here -->
                        </div>

                        <div class="mt-3">
                            You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details.
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
                                <div id="sizes-container">
                                    {{-- @foreach ($category->sizes as $size)
                                    <div class="form-group row mb-2 align-items-center">
                                        <div class="col-md-1 d-flex align-items-center">
                                            <label class="form-label">{{ $size }}</label>
                                        </div>
                                        <div class="col-md-3 d-flex align-items-center">
                                            <input type="number" class="form-control mb-2 mb-md-0" placeholder="Enter Stock" name="quantities[{{ $size }}]" value="{{ $quantities[$size] ?? 0 }}" />
                                        </div>
                                    </div>
                                    @endforeach --}}
                                </div>
                                <!--begin::Buttons-->
                                <div id="size-buttons" class="d-flex flex-stack gap-5 mb-3">
                                    {{-- @foreach(['S', 'M', 'L', 'XL', 'XXL'] as $size)
                                        <button type="button"
                                                class="btn w-100 size-btn {{ old('size') === $size ? 'btn-primary' : 'btn-light-primary' }}"
                                                data-size="{{ $size }}">
                                            {{ $size }}
                                        </button>
                                    @endforeach --}}
                                </div>
                                <!--end::Buttons-->
                            </div>
                            <!-- Stock -->
                            {{-- <div class="mb-4">
                                <label class="form-label d-flex required">Stock</label>
                                <input type="number" class="form-control" placeholder="Enter Stock" name="quantity" value="{{ old('stock') }}">
                            </div> --}}
                            <!-- Hidden input to store the selected size -->
                            {{-- <input type="hidden" name="size" id="size-input" value="{{ old('size') }}"> --}}
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

                    <div class="row g-9 mb-10 align-items-center">
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

                        <div class="d-flex col-md-4 align-items-center">
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span>Best Seller &nbsp;</span>

                                <input
                                    id="is_best_seller"
                                    name="best_seller"
                                    class="form-check-input"
                                    type="checkbox"
                                    value="1"
                                    />
                            </label>

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

    const previewContainer = document.getElementById('image_preview');
    const fileInput = document.getElementById('product_images');
    const category = document.getElementById('category_id');
    const selectedFiles = [];
    console.log(selectedFiles);

    category.onchange = function() {
        //alert('The option with value ' + category.value);

        if(category.value !== "")
        {
            var baseUrl = "{{URL::to('/')}}";

            fetch(baseUrl + `/api/v1/categories/${category.value}`, {
                method: 'GET'
                //body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const sizesContainer = document.getElementById('sizes-container');
                    sizesContainer.innerHTML = ''; // Clear any existing sizes

                    data.data.sizes.forEach(size => {
                        const formGroup = document.createElement('div');
                        formGroup.className = 'form-group row mb-2 align-items-center';

                        const labelDiv = document.createElement('div');
                        labelDiv.className = 'col-md-1 d-flex align-items-center';
                        const label = document.createElement('label');
                        label.className = 'form-label';
                        label.textContent = size;
                        labelDiv.appendChild(label);

                        const inputDiv = document.createElement('div');
                        inputDiv.className = 'col-md-3 d-flex align-items-center';
                        const input = document.createElement('input');
                        input.type = 'number';
                        input.className = 'form-control mb-2 mb-md-0';
                        input.placeholder = 'Enter Stock';
                        input.name = `quantities[${size}]`;
                        input.value = 0;
                        inputDiv.appendChild(input);

                        formGroup.appendChild(labelDiv);
                        formGroup.appendChild(inputDiv);

                        sizesContainer.appendChild(formGroup);
                });
                    // const sizeButtonsContainer = document.getElementById('size-container');
                    // sizeButtonsContainer.innerHTML = ''; // Clear any existing buttons

                    // const oldSize = @json(old('size'));

                    // data.data.sizes.forEach(size => {
                    //     const button = document.createElement('button');
                    //     button.type = 'button';
                    //     button.className = `btn w-100 size-btn ${oldSize === size ? 'btn-primary' : 'btn-light-primary'}`;
                    //     button.dataset.size = size;
                    //     button.textContent = size;
                    //     sizeButtonsContainer.appendChild(button);
                    //     button.addEventListener('click', () => updateSizeSelection(button));

                    // });

                } else {

                }
            })
            .catch(error => {
                console.error('Error:', error);
               // alert('There was an error submitting the form.');
            });
        }
    };

    // Handle file selection
    fileInput.addEventListener('change', function (event) {
        const files = Array.from(event.target.files);

        files.forEach(file => {
            // Add to selectedFiles array
            selectedFiles.push(file);

            // Create a preview for the image
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.width = '100px';
                img.style.height = '100px';
                img.style.objectFit = 'cover';
                img.style.marginRight = '10px';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });

        // Reset the input to allow re-selection of the same files
        // event.target.value = '';
    });

    // Form submission handling
    const form = document.querySelector('form');
    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent default submission

        const formData = new FormData(form);

        // Add all selected files to the formData
        selectedFiles.forEach(file => {
            formData.append('product_images[]', file);
        });

        // Submit the form data using Fetch API
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => {
            var res = response.text();
            console.log(res);
            return res;
        })
        .then(data => {
            if (data.success) {
                alert('Product saved successfully!');
            } else {
                alert('There was an error saving the product.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error submitting the form.');
        });
    });

});

</script>

</x-default-layout>
