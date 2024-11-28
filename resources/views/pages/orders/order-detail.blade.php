<x-default-layout>

    @section('title')
        Order #12345
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="order-detail">
        <div class="row">
            <!-- Left Section -->
            <div class="col-lg-8">
                <!-- Order Details -->
                <div class="card card-flush mb-5">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h3 class="card-title">All Items</h3>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="fw-semibold">Sort <i class="fas fa-chevron-down"></i></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0);" class="dropdown-item">Name</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item">Quantity</a></li>
                                <li><a href="javascript:void(0);" class="dropdown-item">Price</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-row-bordered align-middle gy-4">
                                <thead>
                                    <tr class="fw-semibold text-gray-600">
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">
                                                <img src="images/products/product-1.jpg" alt="Product Image">
                                            </div>
                                            <span class="fw-bold">Ribbed Tank Top</span>
                                        </td>
                                        <td>1</td>
                                        <td>$50.47</td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">
                                                <img src="images/products/product-2.jpg" alt="Product Image">
                                            </div>
                                            <span class="fw-bold">V-neck linen T-shirt</span>
                                        </td>
                                        <td>1</td>
                                        <td>$50.47</td>
                                    </tr>
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">
                                                <img src="images/products/product-3.jpg" alt="Product Image">
                                            </div>
                                            <span class="fw-bold">Ribbed modal T-shirt</span>
                                        </td>
                                        <td>1</td>
                                        <td>$50.47</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Cart Totals -->
                <div class="card card-flush mb-5">
                    <div class="card-header">
                        <h3 class="card-title">Cart Totals</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td class="text-end">$70.13</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping:</td>
                                        <td class="text-end">$10.00</td>
                                    </tr>
                                    <tr>
                                        <td>Tax (GST):</td>
                                        <td class="text-end">$5.00</td>
                                    </tr>
                                    <tr class="fw-bold">
                                        <td>Total Price:</td>
                                        <td class="text-end">$90.58</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Right Section -->
            <div class="col-lg-4">
                <!-- Summary -->
                <div class="card card-flush mb-5">
                    <div class="card-body">
                        <h3 class="card-title mb-5">Summary</h3>
                        <div class="mb-3">
                            <div class="text-gray-600">Order ID:</div>
                            <div class="fw-bold">#192847</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-gray-600">Date:</div>
                            <div class="fw-bold">20 Nov 2023</div>
                        </div>
                        <div>
                            <div class="text-gray-600">Total:</div>
                            <div class="fw-bold text-primary">$948.5</div>
                        </div>
                    </div>
                </div>
                <!-- Shipping Address -->
                <div class="card card-flush mb-5">
                    <div class="card-body">
                        <h3 class="card-title">Shipping Address</h3>
                        <p class="text-gray-600">3517 W. Gray St. Utica, Pennsylvania 57867</p>
                    </div>
                </div>
                <!-- Payment Method -->
                <div class="card card-flush mb-5">
                    <div class="card-body">
                        <h3 class="card-title">Payment Method</h3>
                        <p class="text-gray-600">Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking acceptance subject to device availability.</p>
                    </div>
                </div>
                <!-- Delivery Date -->
                <div class="card card-flush">
                    <div class="card-body">
                        <h3 class="card-title">Expected Date Of Delivery</h3>
                        <p class="fw-bold text-success">20 Nov 2023</p>
                        <a href="order-tracking.html" class="btn btn-primary w-100"><i class="fas fa-truck me-2"></i>Track Order</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mb-10">
            <div class="card-body">
                <h5 class="card-title text-dark fw-bold mb-2">Detail</h5>
                <p class="card-text text-gray-600">
                    Your items are on the way. Tracking information will be available within 24 hours.
                </p>

                <!-- Progress Tracker -->
                <div class="d-flex flex-wrap justify-content-between align-items-center mt-4">
                    <!-- Step 1 -->
                    <div class="d-flex flex-column align-items-center w-20">
                        <div class="rounded-circle bg-warning text-white d-flex justify-content-center align-items-center fw-bold h-50px w-50px">
                            <i class="bi bi-check-lg fs-2x"></i>
                        </div>
                        <div class="text-dark mt-3 fw-bold text-center">Receiving orders</div>
                        <div class="text-gray-600 text-center fs-7">05:43 AM</div>
                    </div>

                    <!-- Line 1 -->
                    <div class="flex-grow-1 bg-warning h-5px mx-2 mt-n12"></div>

                    <!-- Step 2 -->
                    <div class="d-flex flex-column align-items-center w-20">
                        <div class="rounded-circle bg-warning text-white d-flex justify-content-center align-items-center fw-bold h-50px w-50px">
                            <i class="bi bi-check-lg fs-2x"></i>
                        </div>
                        <div class="text-dark mt-3 fw-bold text-center">Order processing</div>
                        <div class="text-gray-600 text-center fs-7">01:21 PM</div>
                    </div>

                    <!-- Line 2 -->
                    <div class="flex-grow-1 bg-warning h-5px mx-2 mt-n12"></div>

                    <!-- Step 3 -->
                    <div class="d-flex flex-column align-items-center w-20">
                        <div class="rounded-circle bg-warning text-white d-flex justify-content-center align-items-center fw-bold h-50px w-50px">
                            <i class="bi bi-check-lg fs-2x"></i>
                        </div>
                        <div class="text-dark mt-3 fw-bold text-center">Being delivered</div>
                        <div class="text-gray-600 text-center fs-7">Processing</div>
                    </div>

                    <!-- Line 3 -->
                    <div class="flex-grow-1 bg-gray-300 h-5px mx-2 mt-n12"></div>

                    <!-- Step 4 -->
                    <div class="d-flex flex-column align-items-center w-20">
                        <div class="rounded-circle bg-light text-gray-400 d-flex justify-content-center align-items-center fw-bold h-50px w-50px border border-gray-300">
                            <i class="bi bi-check-lg fs-2x"></i>
                        </div>
                        <div class="text-gray-400 mt-3 fw-bold text-center">Delivered</div>
                        <div class="text-gray-400 text-center fs-7">Pending</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Order Tracking List</span>
                </h3>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-rounded table-row-bordered border gy-7 gs-7">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-325px rounded-start">Date</th>
                                <th class="min-w-125px">Time</th>
                                <th class="min-w-125px">Description</th>
                                <th class="min-w-200px">Location</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">20 Nov 2023</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2:30 PM</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">The sender is preparing the goods</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2715 Ash Dr. San Jose, South Dakota 83475</span>
                                </td>
                            </tr>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">20 Nov 2023</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2:30 PM</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">The sender is preparing the goods</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2715 Ash Dr. San Jose, South Dakota 83475</span>
                                </td>
                            </tr>
                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom-2 border-gray-200">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">20 Nov 2023</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2:30 PM</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">The sender is preparing the goods</span>
                                </td>

                                <td>
                                    <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">2715 Ash Dr. San Jose, South Dakota 83475</span>
                                </td>
                            </tr>
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>

    </div>

</x-default-layout>
