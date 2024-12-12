<x-default-layout>

    @section('title')
        Order List
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('order.order-list') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6 ">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search order" id="mySearchInput"/>
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
                            Export all order
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
                        <th class="min-w-100px">Order ID</th>
                        <th class="text-end min-w-150px">Customer</th>
                        <th class="text-end min-w-100px">Quantity</th>
                        <th class="text-end min-w-100px">Total</th>
                        <th class="text-end min-w-100px">Status</th>
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
                    <tr data-kt-docs-datatable-subtable="subtable_template" class="d-none">
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
                    </tr>
                    <!--end::SubTable template-->
                    
                    @foreach($orders as $order)
                    <tr>
                        <!--begin::Order ID-->
                        <td>
                            <a href="{{ URL("/order/detail/{$order->id}") }}" class="text-gray-900 text-hover-primary">{{$order->order_number}}</a>
                        </td>
                        <!--end::Order ID-->
            
                        <!--begin::Crated date-->
                        <td class="text-end">
                            {{$order->customer_name}}
                        </td>
                        <!--end::Created date-->
            
                        <!--begin::Customer-->
                        <td class="text-end">
                            <a href="" class="text-gray-900 text-hover-primary">  {{$order->total_quantity}}</a>
                        </td>
                        <!--end::Customer-->
            
                        <!--begin::Total-->
                        <td class="text-end">
                            {{$order->total_price}}
                        </td>
                        <!--end::Total-->
            
                        <!--begin::Profit-->
                        <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">{{$order->status}}</span>
                        </td>
                        <!--end::Profit-->
            
                        <!--begin::Status-->
                        {{-- <td class="text-end">
                            <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                        </td> --}}
                        <!--end::Status-->
            
                        <!--begin::Actions-->
                        <td class="text-end">
                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-switch fs-2"><span class="path1"></span><span class="path2"></span></i>                                </a> --}}

                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <i class="ki-duotone ki-pencil fs-2"><span class="path1"></span><span class="path2"></span></i>                                </a>

                            <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>                                </a>
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
    <script>
        "use strict";

// Class definition
// var KTDocsDatatableSubtable = function () {
//     var table;
//     var datatable;
//     var template;

//     // Private methods
//     const initDatatable = () => {
//         // Set date data order
//         const tableRows = table.querySelectorAll('tbody tr');

//         tableRows.forEach(row => {
//             const dateRow = row.querySelectorAll('td');
//             //const realDate = moment(dateRow[1].innerHTML, "DD MMM YYYY, LT").format(); // select date from 2nd column in table

//             // Skip template
//             // if (!row.closest('[data-kt-docs-datatable-subtable="subtable_template"]')) {
//             //     dateRow[1].setAttribute('data-order', realDate);
//             //     dateRow[1].innerText = moment(realDate).fromNow();
//             // }
//         });

//         // Get subtable template
//         const subtable = document.querySelector('[data-kt-docs-datatable-subtable="subtable_template"]');
//         template = subtable.cloneNode(true);
//         template.classList.remove('d-none');

//         // Remove subtable template
//         subtable.parentNode.removeChild(subtable);

//         // Init datatable --- more info on datatables: https://datatables.net/manual/
//         datatable = $(table).DataTable({
//             "info": false,
//             'order': [],
//             "lengthChange": false,
//             'pageLength': 6,
//             'ordering': false,
//             'paging': false,
//             'columnDefs': [
//                 { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
//                 { orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)
//             ]
//         });

//         // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
//         datatable.on('draw', function () {
//             resetSubtable();
//             handleActionButton();
//         });
//     }

//     // Subtable data sample
//     const data = [
//         {
//             image: '76',
//             name: 'Go Pro 8',
//             description: 'Latest  version of Go Pro.',
//             cost: '500.00',
//             qty: '1',
//             total: '500.00',
//             stock: '12'
//         },
//         {
//             image: '60',
//             name: 'Bose Earbuds',
//             description: 'Top quality earbuds from Bose.',
//             cost: '300.00',
//             qty: '1',
//             total: '300.00',
//             stock: '8'
//         },
//         {
//             image: '211',
//             name: 'Dry-fit Sports T-shirt',
//             description: 'Comfortable sportswear for everyday use.',
//             cost: '89.00',
//             qty: '1',
//             total: '89.00',
//             stock: '18'
//         },
//         {
//             image: '21',
//             name: 'Apple Airpod 3',
//             description: 'Apple\'s latest and most advanced earbuds.',
//             cost: '200.00',
//             qty: '2',
//             total: '400.00',
//             stock: '32'
//         },
//         {
//             image: '83',
//             name: 'Nike Pumps',
//             description: 'Apple\'s latest and most advanced headphones.',
//             cost: '200.00',
//             qty: '1',
//             total: '200.00',
//             stock: '8'
//         }
//     ];

//     // Handle action button
//     const handleActionButton = () => {
//         const buttons = document.querySelectorAll('[data-kt-docs-datatable-subtable="expand_row"]');

//         // Sample row items counter --- for demo purpose only, remove this variable in your project
//         const rowItems = [4, 1, 5, 1, 4, 2];

//         buttons.forEach((button, index) => {
//             button.addEventListener('click', e => {
//                 e.stopImmediatePropagation();
//                 e.preventDefault();

//                 const row = button.closest('tr');
//                 const rowClasses = ['isOpen', 'border-bottom-0'];

//                 // Get total number of items to generate --- for demo purpose only, remove this code snippet in your project
//                 const demoData = [];
//                 for (var j = 0; j < rowItems[index]; j++) {
//                     demoData.push(data[j]);
//                 }
//                 // End of generating demo data

//                 // Handle subtable expanded state
//                 if (row.classList.contains('isOpen')) {
//                     // Remove all subtables from current order row
//                     while (row.nextSibling && row.nextSibling.getAttribute('data-kt-docs-datatable-subtable') === 'subtable_template') {
//                         row.nextSibling.parentNode.removeChild(row.nextSibling);
//                     }
//                     row.classList.remove(...rowClasses);
//                     button.classList.remove('active');
//                 } else {
//                     populateTemplate(demoData, row);
//                     row.classList.add(...rowClasses);
//                     button.classList.add('active');
//                 }
//             });
//         });
//     }

//     // Populate template with content/data -- content/data can be replaced with relevant data from database or API
//     const populateTemplate = (data, target) => {
//         data.forEach((d, index) => {
//             // Clone template node
//             const newTemplate = template.cloneNode(true);

//             // Stock badges
//             const lowStock = `<div class="badge badge-light-warning">Low Stock</div>`;
//             const inStock = `<div class="badge badge-light-success">In Stock</div>`;

//             // Select data elements
//             const image = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_image"]');
//             const name = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_name"]');
//             const description = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_description"]');
//             const cost = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_cost"]');
//             const qty = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_qty"]');
//             const total = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_total"]');
//             const stock = newTemplate.querySelector('[data-kt-docs-datatable-subtable="template_stock"]');

//             // Populate elements with data
//             const imageSrc = image.getAttribute('src');
//             image.setAttribute('src', imageSrc + d.image + '.png');
//             name.innerText = d.name;
//             description.innerText = d.description;
//             cost.innerText = d.cost;
//             qty.innerText = d.qty;
//             total.innerText = d.total;
//             if (d.stock > 10) {
//                 stock.innerHTML = inStock;
//             } else {
//                 stock.innerHTML = lowStock;
//             }

//             // New template border controller
//             // When only 1 row is available
//             if (data.length === 1) {
//                 let borderClasses = ['rounded', 'rounded-end-0'];
//                 newTemplate.querySelectorAll('td')[0].classList.add(...borderClasses);
//                 borderClasses = ['rounded', 'rounded-start-0'];
//                 newTemplate.querySelectorAll('td')[4].classList.add(...borderClasses);

//                 // Remove bottom border
//                 newTemplate.classList.add('border-bottom-0');
//             } else {
//                 // When multiple rows detected
//                 if (index === (data.length - 1)) { // first row
//                     let borderClasses = ['rounded-start', 'rounded-bottom-0'];
//                     newTemplate.querySelectorAll('td')[0].classList.add(...borderClasses);
//                     borderClasses = ['rounded-end', 'rounded-bottom-0'];
//                     newTemplate.querySelectorAll('td')[4].classList.add(...borderClasses);
//                 }
//                 if (index === 0) { // last row
//                     let borderClasses = ['rounded-start', 'rounded-top-0'];
//                     newTemplate.querySelectorAll('td')[0].classList.add(...borderClasses);
//                     borderClasses = ['rounded-end', 'rounded-top-0'];
//                     newTemplate.querySelectorAll('td')[4].classList.add(...borderClasses);

//                     // Remove bottom border on last row
//                     newTemplate.classList.add('border-bottom-0');
//                 }
//             }

//             // Insert new template into table
//             const tbody = table.querySelector('tbody');
//             tbody.insertBefore(newTemplate, target.nextSibling);
//         });
//     }

//     // Reset subtable
//     const resetSubtable = () => {
//         const subtables = document.querySelectorAll('[data-kt-docs-datatable-subtable="subtable_template"]');
//         subtables.forEach(st => {
//             st.parentNode.removeChild(st);
//         });

//         const rows = table.querySelectorAll('tbody tr');
//         rows.forEach(r => {
//             r.classList.remove('isOpen');
//             if (r.querySelector('[data-kt-docs-datatable-subtable="expand_row"]')) {
//                 r.querySelector('[data-kt-docs-datatable-subtable="expand_row"]').classList.remove('active');
//             }
//         });
//     }

//     // Public methods
//     return {
//         init: function () {
//             table = document.querySelector('#kt_docs_datatable_subtable');

//             if (!table) {
//                 return;
//             }

//             initDatatable();
//             handleActionButton();
//         }
//     }
// }();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTDocsDatatableSubtable;
}

document.addEventListener('DOMContentLoaded', () => {
    KTDocsDatatableSubtable.init();
});
// On document ready

    </script>
   
</x-default-layout>
