<x-default-layout>
   
    @section('title')
        Product Information
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('categories.category-list') }}
    @endsection

    <div class="card mb-10">
        <form method="POST" action="{{ route('product.image.sort', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-10">
                <div class="card-header">
                    <h3 class="card-title">Sort Image</h3>
                </div>
                <div class="card-body">
                   
                    <div class="mb-10">
                       
                        <div class="image-container draggable-zone">
                        @foreach($product->images as $image)
                                <div id="image-container-{{ $image->id }}" class="image-input image-input-outline draggable" data-kt-image-input="true" style="background-image: url(/assets/media/svg/avatars/blank.svg)" >
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ Storage::url($image->image_path) }})"></div>
                                
                                    <span class="btn remove-avatar-btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                    data-kt-image-input-action="change"
                                    data-bs-toggle="tooltip"
                                    data-bs-dismiss="click"
                                    data-image-id="{{ $image->id }}"
                                    title="Remove">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                </div>
                         @endforeach
                        </div>
                       
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                {{-- <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button> --}}
               
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
        <button id="toggle-button" class="btn btn-primary">Switch to Delete Mode</button>

    </div>
  
    <script src="{{ asset('assets/plugins/custom/draggable/draggable.bundle.js') }}" defer></script>
    <script>
         document.addEventListener('DOMContentLoaded', () => {
            $(document).on('click', '.remove-avatar-btn', function() {

            var imageId = $(this).data('image-id');
            $.ajax({
                url: '{{ route('product_image.delete') }}', // Use the named route
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token
                    image_id: imageId
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#image-container-' + imageId).remove();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('Error deleting image');
                }
            });
            });
         });
    </script>
    <script>
        window.addEventListener("load", () => {
            let isDragMode = true;

            function initializeDraggable() {
            sortable = new Draggable.Sortable(document.querySelectorAll('.draggable-zone'), {
                draggable: '.draggable',
            });
        }

        initializeDraggable();

        // Toggle between drag mode and delete mode
        document.getElementById('toggle-button').addEventListener('click', function() {
            isDragMode = !isDragMode;
            if (isDragMode) {
                initializeDraggable();
                this.textContent = 'Switch to Delete Mode';
            } else {
                if (sortable) {
                    sortable.destroy();
                }
                this.textContent = 'Switch to Drag Mode';
            }
        });

            const form = document.querySelector('form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Prevent default submission

                const sortedItems = [];
                document.querySelectorAll('.draggable-zone .draggable').forEach(function(item) {
                    const span = item.querySelector('span[data-image-id]');
                    if (span) {
                        console.log(span);
                        sortedItems.push(span.getAttribute('data-image-id'));
                    }
                });

                const productId = '{{ $product->id }}';

                fetch(`/product/${productId}/images/sort`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ sortedItems: sortedItems })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Images sorted successfully');
                        window.location.href = '/product';
                    } else {
                        alert('Error sorting images');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error sorting images');
                });

                console.log(sortedItems);

               
            });

        });
    </script>
  

</x-default-layout>
