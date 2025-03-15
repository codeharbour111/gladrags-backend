<x-default-layout>

    @section('title')
        Order {{ $order->order_number }}
    @endsection

    {{-- @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection --}}

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
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- //{{dd($order_items)}} --}}
                                    @foreach ($order_items as $item)
                                    <tr>
                                        <td class="d-flex align-items-center">
                                            <div class="symbol symbol-50px me-3">
                                                <img src="{{ Storage::url($item->product->images[0]->image_path) }}" alt="Image">
                                            </div>
                                           
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{$item->product->name}}</span>
                                        </td>
                                        <td>{{$item->size}}</td>
                                        <td>{{$item->quantity}}</td>
                                        <td>{{$item->quantity * $item->price}}</td>
                                    </tr>
                                    @endforeach
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
                                        <td class="text-end">BDT {{$order->subtotal}}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping:</td>
                                        <td class="text-end">BDT 
                                        {{-- @if(condition)
                                            some data
                                        @else
                                            some data
                                        @endif --}}
                                        {{$order->shipping_fee}}</td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Tax (GST):</td>
                                        <td class="text-end">$5.00</td>
                                    </tr> --}}
                                    <tr class="fw-bold">
                                        <td>Total Price:</td>
                                        <td class="text-end">BDT {{$order->total_price}}</td>
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
                            <div class="fw-bold">{{$order->order_number}}</div>
                        </div>
                        <div class="mb-3">
                            <div class="text-gray-600">Date:</div>
                            <div class="fw-bold">{{$order->created_at->format('d M Y')}}</div>
                        </div>
                        <div>
                            <div class="text-gray-600">Total:</div>
                            <div class="fw-bold text-primary">BDT {{$order->total_price}}</div>
                        </div>
                    </div>
                </div>
                <!-- Shipping Address -->
                <div class="card card-flush mb-5">
                    <div class="card-body">
                        <h3 class="card-title">Customer Phone No</h3>
                        <p class="text-gray-600">{{$order->customer_phone_no}}</p>
                        <h3 class="card-title">Customer Email Address</h3>
                        <p class="text-gray-600">{{$order->customer_email}}</p>
                        <h3 class="card-title">Shipping Address</h3>
                        <p class="text-gray-600">{{$order->customer_address}}</p>
                    </div>
                </div>
                <!-- Payment Method -->
                {{-- <div class="card card-flush mb-5">
                    <div class="card-body">
                        <h3 class="card-title">Payment Method</h3>
                        <p class="text-gray-600">Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking acceptance subject to device availability.</p>
                    </div>
                </div> --}}
                <!-- Delivery Date -->
                <div class="card card-flush">
                    <div class="card-body">
                        <h3 class="card-title">Expected Date Of Delivery</h3>
                        
                        <select class="mt-8 form-select form-select-solid" id="order_status" data-control="select2" data-dropdown-css-class="w-200px" data-placeholder="Select an option" data-hide-search="true">
                            <option></option>
                            {{-- ['pending','confirmed','processing','delivered_to_pathao','delivered'] --}}
                            <option value="1" {{$order->status == "pending" ? "selected" : "none"}}>Pending</option>
                            <option value="2" {{$order->status == "confirmed" ? "selected" : "none"}}>Confirm</option>
                            <option value="3" {{$order->status == "processing" ? "selected" : "none"}}>Processing</option>
                            <option value="4" {{$order->status == "delivered_to_pathao" ? "selected" : "none"}}>Delivered To Pathao</option>
                            <option value="5" {{$order->status == "delivered" ? "selected" : "none"}}>Delivered</option>
                        </select>
                        {{-- <p class="fw-bold text-success">20 Nov 2023</p> --}}
                        <a href="order-tracking.html" class="d-none btn btn-primary mt-8 w-100"><i class="fas fa-truck me-2"></i>Track Order</a>
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

                <!--begin::Stepper-->
                <div class="stepper stepper-pills" id="kt_stepper_example_clickable">
                    <!--begin::Nav-->
                    <div class="stepper-nav flex-center flex-wrap mb-10">
                        <!--begin::Step 1-->
                        <div class="stepper-item mx-8 my-4 {{$order->status == "pending" ? "current" : ""}}" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <!--end::Icon-->
                    
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Pending
                                    </h3>
                    
                                    {{-- <div class="stepper-desc">
                                        Accept Order
                                    </div> --}}
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                    
                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 1-->
                        <!--begin::Step 2-->
                        <div class="stepper-item mx-8 my-4 {{$order->status == "confirmed" ? "current" : ""}}" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <!--begin::Icon-->
                    
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Confirm
                                    </h3>
                    
                                    {{-- <div class="stepper-desc">
                                        Description
                                    </div> --}}
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                    
                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 2-->
                    
                        <!--begin::Step 3-->
                        <div class="stepper-item mx-8 my-4 {{$order->status == "processing" ? "current" : ""}}" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                        <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">3</span>
                                </div>
                                <!--begin::Icon-->
                    
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Processing
                                    </h3>
                    
                                    {{-- <div class="stepper-desc">
                                        Description
                                    </div> --}}
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                    
                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 3-->
                    
                        <!--begin::Step 4-->
                        <div class="stepper-item mx-8 my-4 {{$order->status == "delivered_to_pathao" ? "current" : ""}}" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">4</span>
                                </div>
                                <!--begin::Icon-->
                    
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Delivered To Pathao
                                    </h3>
                    
                                    {{-- <div class="stepper-desc">
                                        Description
                                    </div> --}}
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Step 4-->
                        <div class="stepper-item mx-8 my-4 {{$order->status == "delivered" ? "mark-completed" : ""}}" data-kt-stepper-element="nav" data-kt-stepper-action="step" id="stepper-delivered">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">5</span>
                                </div>
                                <!--begin::Icon-->
                    
                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Delivered
                                    </h3>
                    
                                    {{-- <div class="stepper-desc">
                                        Description
                                    </div> --}}
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Stepper-->

               
            </div>
        </div>

        {{-- <div class="card mb-5 mb-xl-8">
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
        </div> --}}

    </div>
    <script>

        document.addEventListener('DOMContentLoaded', () => 
        {
            var status = document.querySelector("#kt_stepper_example_vertical");

            var element = document.querySelector("#kt_stepper_example_clickable");

            // Initialize Stepper
            var stepper = new KTStepper(element);

            // Handle navigation click
            stepper.on("kt.stepper.click", function (stepper) {
                stepper.goTo(stepper.getClickedStepIndex()); // go to clicked step
            });

            // Handle next step
            stepper.on("kt.stepper.next", function (stepper) {
                stepper.goNext(); // go next step
            });

            // Handle previous step
            stepper.on("kt.stepper.previous", function (stepper) {
                stepper.goPrevious(); // go previous step
            });

            var currentStatus = @json($order->status);
                            
            if(currentStatus === "confirmed")
            {
                stepper.goTo(2);
            }
            else if(currentStatus === "processing")
            {
                stepper.goTo(3);
            }
            else if(currentStatus === "delivered_to_pathao")
            {
                stepper.goTo(4);
            }
            else if(currentStatus === "delivered")
            {
                stepper.goTo(5);
                $('#stepper-delivered').addClass("completed");
            }

            //const order_status = document.getElementById('order_status');
            var test = $('#order_status');
            test.on("select2:select", function(event) {
                var value = $(event.currentTarget).find("option:selected").val();
              
                const formData = new FormData();
                formData.append('order_id', {{$order->id}});
                formData.append('status', value);
                // Add all selected files to the formData
              
                var baseUrl = "{{URL::to('/')}}";


            fetch(baseUrl + `/api/v1/order/update-status`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    alert('Order saved successfully!');
                    stepper.goTo(value);

                    if(value == 5)
                        $('#stepper-delivered').addClass("completed");
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
