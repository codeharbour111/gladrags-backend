<x-default-layout>

    @section('title')
        All Products
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 ">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('add.new.category') }}">
                        <!--begin::Add user-->
                        <button type="button" class="btn btn-primary" data-bs-target="#kt_modal_add_user">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Add New
                        </button>
                        <!--end::Add user-->
                    </a>
                </div>
                <!--end::Toolbar-->

                {{-- <!--begin::Modal-->
                <livewire:user.add-user-modal></livewire:user.add-user-modal>
                <!--end::Modal--> --}}
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-325px rounded-start">Category</th>
                            <th class="min-w-150px">Size</th>
                            <th class="min-w-200px rounded-end">Action</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->

                    <!--begin::Table body-->
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-5">
                                        <img src="{{ Storage::url($category->image) }}" alt="Image">
                                    </div>

                                    <div class="d-flex justify-content-start flex-column">
                                        <span class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{ $category->name }}</span>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">{{ implode(', ', json_decode($category->sizes, true)) }}</span>
                            </td>


                            <td>
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-switch fs-2"><span class="path1"></span><span class="path2"></span></i></a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i></a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></a>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->
            </div>
            <div id="" class="row">
                <div id="" class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar">
                    <div>
                        <select name="kt_customers_table_length" aria-controls="kt_customers_table" class="form-select form-select-solid form-select-sm" id="dt-length-0">
                            <option value="10">10</option><option value="25">25</option>
                            <option value="50">50</option><option value="100">100</option>
                        </select><label for="dt-length-0"></label>
                    </div>
                </div>
                <div id="" class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                    <div class="dt-paging paging_simple_numbers">
                        <nav aria-label="pagination">
                            <ul class="pagination">
                                <li class="dt-paging-button page-item disabled">
                                    <button class="page-link previous" role="link" type="button" aria-controls="kt_customers_table" aria-disabled="true" aria-label="Previous" data-dt-idx="previous" tabindex="-1"><i class="previous"></i></button>
                                </li>
                                <li class="dt-paging-button page-item active">
                                    <button class="page-link" role="link" type="button" aria-controls="kt_customers_table" aria-current="page" data-dt-idx="0">1</button>
                                </li>
                                <li class="dt-paging-button page-item">
                                    <button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="1">2</button>
                                </li>
                                <li class="dt-paging-button page-item">
                                    <button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="2">3</button>
                                </li>
                                <li class="dt-paging-button page-item">
                                    <button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="3">4</button>
                                </li>
                                <li class="dt-paging-button page-item">
                                    <button class="page-link next" role="link" type="button" aria-controls="kt_customers_table" aria-label="Next" data-dt-idx="next"><i class="next"></i></button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>
