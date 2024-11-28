<x-default-layout>

    @section('title')
        Category Information
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
                    <h3 class="fw-bold m-0">Add New Attribute </h3>
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
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Attribute name</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="company" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="Attribute name">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Attribute value</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" name="company" class="form-control form-control-lg form-control-solid" placeholder="Company name" value="Attribute value">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
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
