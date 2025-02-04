<x-default-layout>

    @section('title')
        All Users
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('user.list') }}
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
                    <a href="{{ route('add.user') }}">
                        <button type="button" class="btn btn-primary" data-bs-target="#kt_modal_add_user">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Add User
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
        <div class="card-body py-4">
            <div class="table-responsive mb-5">
                <!--begin::Table-->
                <table class="table table-row-dashed table-row-gray-300 gy-7">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th class="ps-4 min-w-325px rounded-start">User</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-200px rounded-end">Action</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->

                    <!--begin::Table body-->
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="d-flex justify-content-start flex-column">
                                        <a href="#" class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">{{$user->name}}</a>
                                    </div>
                                </div>
                            </td>

                            <td>
                                <span class="fs-7">{{$user->email}}</span>
                            </td>

                            <td>
                                <a href="{{ URL("/user-list/edit/{$user->id}") }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>
                                </a>
                                <form action="{{ URL("/user-list/delete/{$user->id}") }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                    </button>
                                </form>
{{--                                 
                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                    <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>                                </a>

                                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                    <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                </a> --}}
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
                            <nav aria-label="pagination">
                                <ul class="pagination">
                                    @if ($users->onFirstPage())
                                        <li class="dt-paging-button page-item disabled">
                                            <button class="page-link previous" aria-disabled="true" aria-label="Previous"><i class="previous"></i></button>
                                        </li>
                                    @else
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link previous" href="{{ $users->previousPageUrl() }}" aria-label="Previous"><i class="previous"></i></a>
                                        </li>
                                    @endif

                                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                        <li class="dt-paging-button page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    @if ($users->hasMorePages())
                                        <li class="dt-paging-button page-item">
                                            <a class="page-link next" href="{{ $users->nextPageUrl() }}" aria-label="Next"><i class="next"></i></a>
                                        </li>
                                    @else
                                        <li class="dt-paging-button page-item disabled">
                                            <button class="page-link next" aria-disabled="true" aria-label="Next"><i class="next"></i></button>
                                        </li>
                                    @endif
                                </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Card body-->
    </div>

</x-default-layout>
