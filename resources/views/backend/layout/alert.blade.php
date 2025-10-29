@php
    $type = session('alert_type');
    $message = session('alert_message');

    $icon = match($type) {
        'success' => 'success',
        'error' => 'error',
        'warning' => 'warning',
        'info' => 'info',
        default => 'info',
    };

    $title = match($type) {
        'success' => 'Success!',
        'error' => 'Error!',
        'warning' => 'Warning!',
        'info' => 'Note:',
        default => 'Notice',
    };
@endphp

@if($type && $message)
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: '{{ $icon }}',
                title: '{{ $title }}',
                html: {!! json_encode($message) !!},
                timer: 5000,
                showConfirmButton: false,
                position: 'center',
                toast: false
            });
        });
    </script>
@endif
