<x-default-layout>

    @section('title')
        All Banners
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
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Banner" id="mySearchInput"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <a href="{{ route('add.new.shopgram') }}">
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
            <table class="table align-middle table-row-dashed fs-6 gy-4" id="kt_docs_datatable_subtable">
                <!--begin::Table head-->
                <thead>
                    <!--begin::Table row-->
                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                        <th class="min-w-50px">Image</th>
                        <th class="text-end min-w-100px">Action</th>
                        {{-- <th class="text-end min-w-100px">Created</th> --}}
                        <th class="text-end"></th>
                    </tr>
                    <!--end::Table row-->
                </thead>
                <!--end::Table head-->
            
            
                <!--begin::Table body-->
                <tbody class="fw-bold text-gray-600">
                  
                    @foreach($shopgram as $gram)
                    <tr>
                        <td >
                            <a href="{{ route('shopgram.edit', $gram->id) }}">
                                <img src="{{ Storage::url($gram->image) }}" alt="{{ $gram->id }}" style="width: 50px; height: 50px;">
                            </a>
                            {{-- <img src="{{ Storage::url($gram->image) }}" alt="{{ $gram->id }}" style="width: 50px; height: 50px;"> --}}
                        </td>
                     
                        <td class="text-end">
                         
                                <a href="{{ URL("/shopgram/edit/{$gram->id}") }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </a>
                                <form action="{{ URL("/shopgram/delete/{$gram->id}") }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </button>
                                </form>
              
                        </td>
                        
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
                                    @if ($shopgram->onFirstPage())
                                        <li class="dt-paging-button page-item disabled">
                                            <button class="page-link previous" aria-disabled="true" aria-label="Previous"><i class="previous"></i></button>
                                        </li>
                                    @else
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link previous" href="{{ $shopgram->previousPageUrl() }}" aria-label="Previous"><i class="previous"></i></a>
                                        </li>
                                    @endif
                    
                                    @foreach ($shopgram->getUrlRange(1, $shopgram->lastPage()) as $page => $url)
                                        <li class="dt-paging-button page-item {{ $page == $shopgram->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach
                    
                                    @if ($shopgram->hasMorePages())
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link next" href="{{ $shopgram->nextPageUrl() }}" aria-label="Next"><i class="next"></i></a>
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
            </div>
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>
