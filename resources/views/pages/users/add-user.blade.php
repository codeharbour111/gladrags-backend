<x-default-layout>

    @section('title')
        User Details
    @endsection

    @section('breadcrumbs')
        {{ Breadcrumbs::render('add.user') }}
    @endsection

    {{-- <div class="card"> --}}
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
                {{-- <form  method="POST" id="kt_account_profile_details_form" action="{{ route('user.store') }}" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate"> --}}
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="POST" enctype="multipart/form-data" action="{{ route('user.store') }}">
                        @csrf
    
                    <!--begin::Card body-->
                    <div class="card-body border-top p-9">

                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-3 col-form-label required fw-semibold fs-6">Name</label>
                            <!--end::Label-->

                            <!--begin::Col-->
                            <div class="col-lg-9 fv-row fv-plugins-icon-container">
                                <input type="text" id="name" name="name" class="form-control form-control-lg form-control-solid" placeholder="Name" value="">
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
                                <input id="email" type="text" name="email" class="form-control form-control-lg form-control-solid" placeholder="Email" value="">
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
                                <input type="text" id="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="Password" value="">
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
                                <input type="text" id="confirm_password" name="confirm_password" class="form-control form-control-lg form-control-solid" placeholder="Confirm Password" value="">
                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Card body-->

                    <!--begin::Actions-->
                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</button>
                        {{-- <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">Save Changes</button> --}}
                        <button id="formSubmit" type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                    <!--end::Actions-->
                    <input type="hidden"></form>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Content-->

        </div>
    {{-- </div> --}}
<script>
    const form = document.querySelector('form');
      
      form.addEventListener('submit', function (event) {
      event.preventDefault(); // Prevent default submission

      const formData = new FormData(form);

      var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var confirm_password = $('#confirm_password').val();

        if(password != confirm_password){
            alert('Password and Confirm Password does not match');
            return;
        }

      formData.append('name', name); 
      formData.append('email', email);
      formData.append('password', password);
      formData.append('confirmed', confirm_password);
      
      fetch(form.action, {
          method: 'POST',
          body: formData
      })
      .then(response => {
          var res = response.json();
          console.log(res);
          return res;
      })
      .then(data => {
          if (data.status === 'success') {
              alert('User saved successfully!');
              window.location.href = '/user-list';
          } else {
              alert('There was an error saving the banner.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
          alert('There was an error submitting the form.');
      });
  });
</script>
</x-default-layout>
