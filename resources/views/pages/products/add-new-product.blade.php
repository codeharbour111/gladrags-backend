<x-default-layout>

    @section('title')
        Product Information
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="card mb-5">
        <div class="card mb-30">
            <div class="card-header">
                <h3 class="card-title">Upload Images</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-10">
                            <div class="upload-image">
                                <div class="up-load d-flex align-items-center justify-content-center border rounded p-20">
                                    <label class="uploadfile w-100 text-center" for="imageUpload">
                                        <span class="icon">
                                            <i class="fas fa-cloud-upload-alt fs-2x text-primary"></i>
                                        </span>
                                        <div class="text-muted mt-2">Drop your images here or select
                                            <span class="text-primary">click to browse</span>
                                        </div>
                                        <input type="file" id="imageUpload" name="images[]" class="d-none" multiple accept="image/*" >
                                        <img src="" id="image-preview" alt="Image Preview" class="img-thumbnail mt-2 d-none">
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 d-flex gap-5 flex-wrap" id="uploaded-images">
                            <!-- Dynamically added uploaded images -->
                            <img src="{{ asset('assets/media/logos/gladrags.jpg') }}" alt="Demo Image 1" class="img-thumbnail" style="width: 250px; height: 250px; object-fit: cover;">
                            <img src="{{ asset('assets/media/logos/gladrags.jpg') }}" alt="Demo Image 2" class="img-thumbnail" style="width: 250px; height: 250px; object-fit: cover;">
                            <img src="{{ asset('assets/media/logos/gladrags.jpg') }}" alt="Demo Image 3" class="img-thumbnail" style="width: 250px; height: 250px; object-fit: cover;">
                            <img src="{{ asset('assets/media/logos/gladrags.jpg') }}" alt="Demo Image 4" class="img-thumbnail" style="width: 250px; height: 250px; object-fit: cover;">
                        </div>
                        <div class="mt-3 text-muted">
                            You need to add at least 4 images. Pay attention to the quality of the pictures you add, comply with the background color standards. Pictures must be in certain dimensions. Notice that the product shows all the details.
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Upload Images</button>
                        </div>
            </div>
        </div>
    </div>

    <div class="card card-flush mb-10">
        <div class="card-header">
            <h3 class="card-title">Product Details</h3>
        </div>
        <div class="card-body">
            <!-- Product Title -->
            <div class="mb-10">
                <label class="form-label required">Product Title</label>
                <input type="text" class="form-control" placeholder="Enter title" name="product_title" maxlength="20" required>
                <span class="form-text text-muted">Do not exceed 20 characters when entering the product name.</span>
            </div>

            <!-- Category -->
            <div class="row g-9 mb-10">
                <div class="col-md-6">
                    <label class="form-label required">Category</label>
                    <select class="form-select" name="category" required>
                        <option value="" disabled selected>Choose category</option>
                        <option value="1">Category 1</option>
                        <option value="2">Category 2</option>
                        <option value="3">Category 3</option>
                    </select>
                </div>

                <!-- Price -->
                <div class="col-md-6">
                    <label class="form-label required">Price</label>
                    <input type="number" class="form-control" placeholder="Price" name="price" required>
                </div>
            </div>

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6 mb-10">
                    <!-- Wrapper Div to Handle Structure and Spacing -->
                    <div class="d-flex flex-column">
                        <!-- Checkbox to Toggle the Collapsible Section -->
                        <label class="btn btn-outline btn-outline-dashed d-flex text-start p-6 align-items-start">
                            <div class="col-md-6 mb-10">
                                <!-- Size -->
                                <div class="mb-10">
                                    <label class="form-label">Size</label>
                                        <div>
                                            <!--begin::Buttons-->
                                            <div class="d-flex flex-stack gap-5 mb-3">
                                                <button type="submit" name="size" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">S</button>
                                                <button type="submit" name="size" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">M</button>
                                                <button type="submit" name="size" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">L</button>
                                                <button type="submit" name="size" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">XL</button>
                                                <button type="submit" name="size" class="btn btn-light-primary w-100" data-kt-docs-advanced-forms="interactive">XXL</button>
                                            </div>
                                            <!--begin::Buttons-->
                                        </div>
                                </div>
                                <!-- Stock -->
                                <div class="mb-4">
                                    <label class="form-label required">Stock</label>
                                    <input type="number" class="form-control" placeholder="Enter Stock" name="stock" required>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-6 mb-10">
                    <!-- Wrapper Div to Handle Structure and Spacing -->
                    <div class="d-flex flex-column">
                        <!-- Checkbox to Toggle the Collapsible Section -->
                        <label class="btn btn-outline btn-outline-dashed d-flex text-start p-6 align-items-start">
                            <!-- Checkbox for Selling Price -->
                            <span class="form-check form-check-custom form-check-solid form-check-sm mt-1">
                                <input
                                    id="sellingPriceToggle"
                                    name="selling_price_checkbox"
                                    class="form-check-input"
                                    type="checkbox"
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
                                        <input type="number" class="form-control" placeholder="Sale Price" name="sale_price">
                                    </div>
                                    <!-- Schedule Input -->
                                    <div>
                                        <label class="form-label">Schedule</label>
                                        <input type="date" class="form-control" name="schedule">
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
                    <input type="text" class="form-control" placeholder="Choose color" name="color" required>
                </div>
                <!-- SKU -->
                <div class="col-md-4">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" placeholder="Enter SKU" name="sku">
                </div>

                <!-- Tags -->
                <div class="col-md-4">
                    <label class="form-label">Tags</label>
                    <input type="text" class="form-control" placeholder="Enter a tag" name="tags">
                </div>
            </div>

            <!-- Description -->
            <div class="mb-10">
                <label class="form-label required">Description</label>
                <textarea class="form-control" name="description" placeholder="Short description about product" maxlength="100" required></textarea>
                <span class="form-text text-muted">Do not exceed 100 characters when entering the description.</span>
            </div>
        </div>
        <!--begin::Actions-->
        <div class="card-footer d-flex justify-content-end py-6 px-9">
            <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
        </div>
        <!--end::Actions-->
    </form>
 </div>


</x-default-layout>
