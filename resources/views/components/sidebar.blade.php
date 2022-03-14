@push('styles')
    <link rel="stylesheet" href="{{ asset('css/components/sidebar.css') }}">
@endpush
<aside class="main-navigation">
    <nav>
{{--        <a href="#">Toggle sidebar</a>--}}
        <a href="#" class="logo">
            <img src="{{ asset('assets/img/logo_main.svg') }}" alt="">
        </a>
        <div class="navigation-section">
            <h4 class="section-title">Profile</h4>
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"></span>Dashboard</a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"></span>Personal Information</a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"></span>Services</a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"></span>Invoices</a>
                </li>
            </ul>
        </div>
        <div class="navigation-section">
            <h4 class="section-title">Tasks</h4>
            <ul>
                <li>
                    <a href="#">
                        <span class="icon"></span>Recording</a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon"></span>Transcription</a>
                </li>
            </ul>
        </div>
        <div class="navigation-section">
            <a href="#" class="user-avatar">
                <img src="" alt="">
            </a>
        </div>
    </nav>
</aside>
