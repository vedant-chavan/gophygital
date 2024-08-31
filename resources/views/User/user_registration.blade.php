<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>User Registration</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<!-- <script src="jquery-3.7.1.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>

.gradient-custom {
/* fallback for old browsers */
background: #6a11cb;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}

.gradient-custom-3 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5))
}
.gradient-custom-4 {
/* fallback for old browsers */
background: #84fab0;

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1))
}
.error {
            color: red;
        }
</style>
<script>
$(document).ready(function(){
    let table = new DataTable('#user_table');
});
</script>
</head>
<body>
<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Create an account</h2>

              <form id="user_registration" >

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="name" />
                  <label class="form-label" for="form3Example1cg">Your Name</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="email" id="form3Example3cg" class="form-control form-control-lg" name="username" />
                  <label class="form-label" for="form3Example3cg">Your Username</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="form3Example4cg"  class="form-control form-control-lg password" name="password"/>
                  <label class="form-label"  for="form3Example4cg">Password</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                  <input type="password" id="form3Example4cdg" class="form-control form-control-lg" id="confirm_password" name="confirm_password" />
                  <label class="form-label"  for="form3Example4cdg">Confirm Password</label>
                </div>
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="tel" id="phoneNumber" name="mobile_number" class="form-control form-control-lg" maxlength="10" pattern="\d{10}" />
                    <label class="form-label" for="phoneNumber">Phone Number</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <select class="form-control form-control-lg" name="language" >
                        <option disabled selected value="">Choose Your Language</option>
                        <option value="EN">English</option>
                        <option value="DE">Deutsch</option>
                    </select>
                    <!-- <label class="form-label select-label">Choose Employee Type</label> -->
                </div>
                <div class="d-flex justify-content-center">
                  <button  type="submit" data-mdb-button-init
                    data-mdb-ripple-init class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <!-- <p class="text-center text-muted mt-5 mb-0">Have already an account? <a href="" class="fw-bold text-body"><u>Login</u></a></p> -->

              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
<script>
    // Prevent non-numeric characters in the mobile number field
    $('input[name="mobile_number"]').on('input', function(event) {
        this.value = this.value.replace(/\D/g, '');
    });

    // Custom validator for password
    $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
    }, "Password must contain only letters and numbers.");

    // to Submit the form with validation

    $("#user_registration").validate({

        rules: {
            name: "required",
            username: {
                required: true,
                email: true
            },
            password: {
                required: true,
                alphanumeric: true,
                minlength : 8
            },
            confirm_password: {
                required: true,
                equalTo: ".password"
            },
            mobile_number: {
                required: true,
                digits: true,
                maxlength: 10
            },
            language: {
                required: true
            },


        },
        messages: {

            name: "Please Enter Name",
            username: {
                required: "Please Enter Email",
                email: "Please enter a valid Email"
            },
            password: {
                required: "Please Enter a password",
                minlength : "Password must be minimum 8 charecter long "

            },
            confirm_password: {
                required: "Please confirm your password",
                equalTo: "Please enter the same password as above"
            },
            mobile_number: {
                required: "Please Enter Mobile No",
                digits: "Please enter only numbers",
                maxlength: "Mobile number must be no more than 10 digits"
            },
            language: {
                required: "Please choose an employee type"
            },
        },
        submitHandler: function(form) {
            var formData = new FormData(form);
            $.ajax({
                url: "{{url('register_user')}}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    // alert(result.message);
                    if (result.success) {
                        toastr.success(result.message);
                        setTimeout(function () {
                            window.location.reload();
                        }, 1000);
                        form.reset();
                    }else{
                        toastr.error(result.message);
                    }
                    },
                error: function(xhr) {
                    // Handle errors
                    if (xhr.status === 422) { // Laravel validation error status
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function(key, value) {
                            toastr.error(value[0]); // Display each validation error message
                        });
                    } else {
                        toastr.error('An error occurred. Please try again.');
                    }
                }
                });
        }
    });
</script>
</html>