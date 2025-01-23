<x-default-layout>
    @section('title')
        Add New Banner
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('banner.add.new.banner') }}
    @endsection

    <div class="card">
        <div class="card mb-5 mb-xl-10">
            <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Add New Banner</h3>
                </div>
            </div>

            <div>
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" enctype="multipart/form-data" >
                {{-- action="{{ route('store.banner') }}"> --}}
                    @csrf

                    <div class="card-body border-top p-9">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Banner Title</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" id="title" name="title" class="form-control form-control-lg form-control-solid" placeholder="Banner title" value="{{ old('title') }}">
                            </div>
                        </div>

                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">Banner Subtitle</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="subtitle" id="subtitle" class="form-control form-control-lg form-control-solid" placeholder="Banner subtitle" value="{{ old('subtitle') }}">
                            </div>
                        </div>
                        <div class="dropzone" id="banner_image">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>
                
                                <!--begin::Info-->
                                <div class="ms-4">
                                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fs-7 fw-semibold text-gray-500">Upload up to 10 files</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        {{-- <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Upload Images</label>

                            <div class="col-lg-8">
                                <!--begin::Input group-->
                                <!--begin::Image input wrapper-->
                                <div class="mt-1">
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                        <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-250px h-250px" style="background-image: url('{{ asset('assets/media/avatars/blank.png') }}');"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Edit-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change image">
                                            <i class="ki-duotone ki-pencil fs-7">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                            <input type="hidden" name="image_remove" />
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Edit-->
                                        <!--begin::Cancel-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel image">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove image">
                                            <i class="ki-duotone ki-cross fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                </div>
                                <!--end::Image input wrapper-->
                                <!--end::Input group-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            </div>
                        </div> --}}


                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        <button id="formSubmit" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('scripts')
    <script>
       Dropzone.autoDiscover = false;
       // set the dropzone container id
       var myDropzone = new Dropzone("#banner_image", {
        url: '{{ route('store.banner') }}', // Set the url for your upload script location
        paramName: "image", // The name that will be used to transfer the file
        maxFiles: 1,
        autoProcessQueue: false,
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
        accept: function(file, done) {
            if (file.name == "wow.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        },
        init: function () {
            $("#formSubmit").click(function (e) {
                event.preventDefault();
                myDropzone.processQueue();
            });
        },
        sending: function(file, xhr, formData) {
            // Append additional form data
            formData.append('title', $('#title').val());
            formData.append('subtitle', $('#subtitle').val());
        },
        error: function (file, response) {
                console.log(response);
                // Handle the error response
                toastr.error(response.message);
                // Enable the submit button again
                $('#formSubmit').prop('disabled', false);
                var dropzoneFilesCopy = myDropzone.files.slice(0);
                myDropzone.removeAllFiles();
                $.each(dropzoneFilesCopy, function(_, file) {
                
                        file.status = undefined;
                        file.accepted = undefined;
                    
                    myDropzone.addFile(file);
                });
        },
        success: function (file, response) {
            console.log(response);
            window.location.href = '{{ route('banner.list') }}';
          
            // alert(response);
            // if (response.status == 'success') {
            //     toastr.success(response.message);
            //     setTimeout(function () {
            //         window.location.href = response.redirect;
            //     }, 2000);
            // } else {
            //     toastr.error(response.message);
            // }
        },
    });
    </script>
    @endpush
</x-default-layout>

