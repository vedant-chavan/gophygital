
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>User Details</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js" integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<style>
body {
	color: #566787;
	background: #f5f5f5;
	font-family: 'Varela Round', sans-serif;
	font-size: 13px;
}

</style>
<script>

</script>
</head>
<body>
<div class="container-xl">
    <div class="row">
        <div class="col-sm-6">
            <h1>User <b>Details</b></h1>
        </div>
        <div class="container">
            <form id="fetchUserForm">
                <b>Username :</b>
                <input type="text" name="username" id="username">
                <button type="submit">Fetch</button>
            </form>

            <div id="userDetails"></div>
        </div>
    </div>
			       
</div>


</body>

<script>
    $(document).ready(function() {
    $('#fetchUserForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var username = $('#username').val();

        $.ajax({
            url: "{{url('/user/fetch-details')}}", // Your route for fetching user details
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Laravel CSRF token
                username: username
            },
            success: function(response) {
                if (response.success) {
                    var user = response.data;
                    var html = '<p><b>Name:</b> ' + user.name + '</p>' +
                               '<p><b>Email:</b> ' + user.username + '</p>' +
                               '<p><b>Created At:</b> ' + user.created_at + '</p>';

                    if (!user.email_verified) {
                        html += '<p style="color: red;"><b>Status:</b> Email not verified</p>';
                    }

                    if (!user.is_active) {
                        html += '<p style="color: red;"><b>Status:</b> User not active</p>';
                    }

                    $('#userDetails').html(html);
                } else {
                    $('#userDetails').html('<p style="color: red;">' + response.message + '</p>');
                }
            },
            error: function(xhr) {
                $('#userDetails').html('<p style="color: red;">An error occurred. Please try again.</p>');
            }
        });
    });
});
</script>
</html>
