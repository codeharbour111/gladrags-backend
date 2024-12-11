<x-default-layout>

    @section('title')
        User Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="card">
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Add New User </h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->

            <!--begin::Content-->
            <div id="kt_account_settings_profile_details" class="collapse show">
                <!--begin::Form-->
                <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Username</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="username" class="form-control form-control-lg form-control-solid" placeholder="User name" value="User name">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Email</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="Email">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Password</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="password" class="form-control form-control-lg form-control-solid" placeholder="Password" value="Password">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Confirm Password</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="confirm_password" class="form-control form-control-lg form-control-solid" placeholder="Confirm Password" value="Confirm Password">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->

                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Permission </h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Add Product</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <!--begin::Radio group-->
                                <div data-kt-buttons="true" class="d-flex">
                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 me-10">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="add_product" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Allow
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 active">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="add_product" checked="checked" value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Deny
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                </div>
                                <!--end::Radio group-->

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Update Product</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <!--begin::Radio group-->
                                <div data-kt-buttons="true" class="d-flex">
                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 me-10">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="update_product" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Allow
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 active">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="update_product" checked="checked" value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Deny
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                </div>
                                <!--end::Radio group-->

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Delete Product</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <!--begin::Radio group-->
                                <div data-kt-buttons="true" class="d-flex">
                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 me-10">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="delete_product" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Allow
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 active">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="delete_product" checked="checked" value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Deny
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                </div>
                                <!--end::Radio group-->

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Apply Discount</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <!--begin::Radio group-->
                                <div data-kt-buttons="true" class="d-flex">
                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 me-10">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="apply_discount" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Allow
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 active">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="apply_discount" checked="checked" value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Deny
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                </div>
                                <!--end::Radio group-->

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Create Coupon</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <!--begin::Radio group-->
                                <div data-kt-buttons="true" class="d-flex">
                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 me-10">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="create_plan" value="startup"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Allow
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                    <!--begin::Radio button-->
                                    <label class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-6 mb-5 active">
                                        <!--end::Description-->
                                        <div class="d-flex align-items-center me-2">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid form-check-primary me-6">
                                                <input class="form-check-input" type="radio" name="create_plan" checked="checked" value="advanced"/>
                                            </div>
                                            <!--end::Radio-->

                                            <!--begin::Info-->
                                            <div class="flex-grow-1">
                                                <h2 class="d-flex align-items-center fs-3 fw-bold flex-wrap">
                                                    Deny
                                                </h2>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Description-->
                                    </label>
                                    <!--end::Radio button-->

                                </div>
                                <!--end::Radio group-->

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->


                    </div>
                    <!--end::Card body-->


                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button>
                    </div>
                    <!--end::Actions-->
                <input type="hidden"></form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

        </div>
    </div>

</x-default-layout>
