@extends('frontend.layout.app')

@section('content')
    <!-- Page Header -->
    <div class="text-white text-center" style="background: url('{{ asset('app-assets/images/contact.jpg') }}') center center / cover no-repeat; height: 200px;">
        <div class="d-flex justify-content-center align-items-center bg-dark bg-opacity-50 w-100 h-100">
            <h1 class="fw-bold my-0">Contact Us</h1>
        </div>
    </div>

    <!-- Main Section -->
    <div class="container mt-5">
        <!-- Feedback Section -->
        <div class="mb-5">
            <h2 class="fw-bold mb-3">We Appreciate Your Feedback</h2>
            <p>We will be glad to hear from you if:</p>
            <ul>
                <li>You have found a mistake in our phone specifications.</li>
                <li>You have information about a phone which we don't have in our database.</li>
                <li>You have found a broken link.</li>
                <li>You have a suggestion for improving SpecsMob or want to request a feature.</li>
            </ul>

            <p>Before sending us an email, please keep in mind:</p>
            <ul>
                <li>We do not sell mobile phones.</li>
                <li>We do not know the price of any mobile phone in your country.</li>
                <li>We do not answer any "unlocking" related questions.</li>
                <li>We do not answer any "Which mobile should I buy?" questions.</li>
            </ul>

            <p>Please use the Tip Us form for any news story suggestions.</p>
        </div>

        <!-- Contact Info Section -->
        <div class="mb-5">
            <h2 class="fw-bold mb-3">Get in Touch</h2>
            <ul class="list-unstyled">
                <li class="mb-2">
                    <i class="bi bi-envelope-fill text-primary me-2"></i>
                    Email: <a href="mailto:contact@specsmob.com" class="text-decoration-none">contact@specsmob.com</a>
                </li>
                <li class="mb-2">
                    <i class="bi bi-whatsapp text-success me-2"></i>
                    WhatsApp: <a href="https://wa.me/1234567890" target="_blank" class="text-decoration-none">+1 234 567 890</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
