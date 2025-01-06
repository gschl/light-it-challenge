<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Patient Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
        }
        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .success {
            color: green;
            font-size: 1em;
            margin-top: 15px;
            text-align: center;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Register as a Patient</h1>
        <form id="registration-form">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Your full name" required>
                <div id="name-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Your email address" required>
                <div id="email-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control" placeholder="Your phone number" required>
                <div id="phone-error" class="error"></div>
            </div>
            <div class="mb-3">
                <label for="document_photo" class="form-label">Document Photo</label>
                <input type="file" id="document_photo" name="document_photo" class="form-control" required>
                <div id="document_photo-error" class="error"></div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
            <div id="general-error" class="error"></div>
            <div id="success-message" class="success"></div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $('#registration-form').on('submit', function (e) {
                e.preventDefault();

                $('.error').text('');
                $('#success-message').text('');

                let formData = new FormData(this);

                $.ajax({
                    url: '/api/patients',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        $('#success-message').text(response.message);
                        $('#registration-form')[0].reset();
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            if (errors.name) {
                                $('#name-error').text(errors.name[0]);
                            }
                            if (errors.email) {
                                $('#email-error').text(errors.email[0]);
                            }
                            if (errors.phone) {
                                $('#phone-error').text(errors.phone[0]);
                            }
                            if (errors.document_photo) {
                                $('#document_photo-error').text(errors.document_photo[0]);
                            }
                        } else {
                            $('#general-error').text('An error occurred. Please try again.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
