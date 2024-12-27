<x-default-layout>

    @section('title')
        All Products
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('products.product-list') }}
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
                    <!--begin::Add user-->
                    <a href="{{ route('add.new.product') }}">
                        <button type="button" class="btn btn-primary" data-bs-target="#kt_modal_add_user">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Add New
                        </button>
                    </a>
                    <!--end::Add user-->
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
       
        <!--end::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-4" id="kt_docs_datatable_subtable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-50px">Product</th>
                        <th class="text-end min-w-100px">Image</th>
                        <th class="text-end min-w-100px">Category</th>
                        <th class="text-end min-w-100px">Price</th>
                        <th class="text-end min-w-100px">Discount Price</th>
                        <th class="text-end min-w-100px">Discount Date</th>
                        <th class="text-end min-w-100px">Stock</th>
                        <th class="text-end min-w-50px">Action</th>
                        {{-- <th class="text-end min-w-100px">Created</th> --}}
                        <th class="text-end"></th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
            
            
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                    <!--begin::SubTable template-->
                    {{-- <tr data-kt-docs-datatable-subtable="subtable_template" class="d-none">
                        <td colspan="2">
                            <div class="d-flex align-items-center gap-3">
                                <a href="#" class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                    <img src="/assets/media/stock/ecommerce/" alt="" data-kt-docs-datatable-subtable="template_image" />
                                </a>
                                <div class="d-flex flex-column text-muted">
                                    <a href="#" class="text-gray-900 text-hover-primary fw-bold" data-kt-docs-datatable-subtable="template_name">Product name</a>
                                    <div class="fs-7" data-kt-docs-datatable-subtable="template_description">Product description</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-900 fs-7">Cost</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-docs-datatable-subtable="template_cost">1</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-900 fs-7">Qty</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-docs-datatable-subtable="template_qty">1</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-900 fs-7">Total</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-docs-datatable-subtable="template_total">name</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-900 fs-7 me-3">On hand</div>
                            <div class="text-muted fs-7 fw-bold" data-kt-docs-datatable-subtable="template_stock">32</div>
                        </td>
                        <td></td>
                    </tr> --}}
                    <!--end::SubTable template-->
                    
                    @foreach($products as $product)
                    <tr>
                        <!--begin::Order ID-->
                        <td>
                            <a href="{{ URL("/product/edit/{$product->id}") }}" class="text-gray-900 text-hover-primary">{{$product->name}}</a>
                        </td>

                        <td class="text-end">
                            <img src="{{ $product->images->count() > 0 ? Storage::url($product->images[0]->image_path) : ""}}" alt="{{ $product->name }}" style="width: 50px; height: 50px;">
                        </td>
                        <!--end::Order ID-->
            
                        <!--begin::Crated date-->
                        <td class="text-end">
                            {{$product->category->name}}
                        </td>
                        <!--end::Created date-->
            
                        <!--begin::Customer-->
                        <td class="text-end">
                            <a href="" class="text-gray-900 text-hover-primary">  {{$product->price}}</a>
                        </td>
                        <!--end::Customer-->
            
                        <!--begin::Total-->
                        <td class="text-end">
                            {{$product->discount_price}}
                        </td>
                        <!--end::Total-->
            
                        <!--begin::Profit-->
                        <td class="text-end">
                           {{$product->discount_date}}
                        </td>
                        <!--end::Profit-->
            
                        <!--begin::Status-->
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">{{$product->inventory->count()}}</span>
                        </td>
                        <!--end::Status-->
            
                        <!--begin::Actions-->
                        <td class="text-end">
                         
                                <a href="{{ URL("/product/edit/{$product->id}") }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </a>
                                <form action="{{ URL("/product/delete/{$product->id}") }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </button>
                                </form>
                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>                                </a>

                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                </a> --}}
                        </td>
                        {{-- <td class="text-end">
                            <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                data-kt-docs-datatable-subtable="expand_row">
                                <span class="svg-icon fs-3 m-0 toggle-off">+</span>
                                <span class="svg-icon fs-3 m-0 toggle-on">+</span>
                            </button>
                        </td> --}}
                        <!--end::Actions-->
                    </tr>
                    @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
         
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
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    @if ($products->onFirstPage())
                                        <li class="dt-paging-button page-item disabled">
                                            <button class="page-link previous" aria-disabled="true" aria-label="Previous"><i class="previous"></i></button>
                                        </li>
                                    @else
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link previous" href="{{ $products->previousPageUrl() }}" aria-label="Previous"><i class="previous"></i></a>
                                        </li>
                                    @endif
                    
                                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                        <li class="dt-paging-button page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                    
                                    @if ($products->hasMorePages())
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link next" href="{{ $products->nextPageUrl() }}" aria-label="Next"><i class="next"></i></a>
                                        </li>
                                    @else
                                        <li class="dt-paging-button page-item disabled">
                                            <button class="page-link next" aria-disabled="true" aria-label="Next"><i class="next"></i></button>
                                        </li>
                                    @endif
                                </ul>
                        </nav>
                    </div>
                    {{-- <div class="dataTables_info" role="status" aria-live="polite">
                        Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of {{ $products->total() }} entries
                    </div> --}}
                </div>
                {{-- <div id="" class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
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
                </div> --}}
            </div>
        </div>
    </div>


</x-default-layout>
