<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Title -->
    <title>@yield('title', 'SpecsMob')</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('app-assets/images/favicon.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS from local assets -->
    <link href="{{ asset('app-assets/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center min-vh-100">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card shadow my-3">
                    {{-- Card Header with Company Logo --}}
                    <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-2">
                        <img src="{{ asset('app-assets/images/logo.png') }}" alt="Company Logo" class="img-fluid" style="max-height: 80px;">
                    </div>

                    {{-- Card Body --}}
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
