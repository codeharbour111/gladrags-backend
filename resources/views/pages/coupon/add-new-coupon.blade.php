<x-default-layout>
    @section('title')
        Add New Coupon
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('coupon.add.new.coupon') }}
    @endsection

    <div class="card">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Add New Coupon</h3>
                </div>
            </div>

            <div>
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" enctype="multipart/form-data" action="{{ route('store.coupon') }}">
                    @csrf

                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Coupon Code</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="code" class="form-control form-control-lg form-control-solid" placeholder="Coupon code" value="{{ old('code') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Discount</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" name="discount" class="form-control form-control-lg form-control-solid" placeholder="0.0" value="{{ old('discount') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Eligible Price</label>
                            <div class="col-lg-8 fv-row">
                                <input type="number" name="eligible_price" class="form-control form-control-lg form-control-solid" placeholder="0.0" value="{{ old('eligible_price') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Expire Date</label>

                            <div class="col-lg-8 fv-row">
                                <input type="date" name="expire_date" class="form-control form-control-lg form-control-solid" value="{{ old('expire_date') }}">
                        </div>


                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-default-layout>
