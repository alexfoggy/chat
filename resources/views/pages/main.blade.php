@extends('layouts.public')
@section('content')
    <section>
        <div id="particles-js" style="height: 600px">
            <div class="container">
                <div class="information">
                    <h1>Collecting Data Center</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam asperiores beatae consectetur
                        id impedit itaque labore nulla quas voluptate voluptates.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="services">
        {{--<div class="container">
            <div class="row form-row">
                <div class="col-6"></div>
                <div class="col-6">
                    <form action="{{ route('register') }}" class="register-form" method="POST">
                        @csrf
                        <div class="form-text mb-4">
                            <h1>Lorem ipsum dolor sit.</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, sapiente totam! Deleniti
                                distinctio qui soluta voluptate? Ab aliquam architecto consequatur cupiditate deserunt,
                                illum impedit incidunt inventore itaque, labore minima neque optio quae quasi quia quo
                                sequi tempore vero. Doloribus, sunt!</p>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="First name" class="@error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Last name" autocomplete="name">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Email Address" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="password" placeholder="Password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="password" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mt-4 d-flex align-items-center">
                            <button class="register-submit" type="submit">Register</button>
                            <a href="{{ route('register.google') }}" class="social-registration">
                                <img src="{{ asset('assets/img/google-hangouts.svg') }}" alt="">
                                <span>Register with Google</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service">
                        <span class="title">Huge audio database</span>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                            cumque</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service">
                        <span class="title">Huge audio database</span>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                            cumque</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service">
                        <span class="title">Huge audio database</span>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                            cumque</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="service">
                        <span class="title">Huge audio database</span>
                        <p class="description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa
                            cumque</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="line"></div>
    <section>
        <div class="container">
            <h2 class="section-title">Why Us</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="about-block">
                        <span class="icon"><i class="flaticon-star"></i></span>
                        <span class="title">Expertise</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, odio!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="about-block">
                        <span class="icon"><i class="flaticon-shield"></i></span>
                        <span class="title">Reliability</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, odio!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="about-block">
                        <span class="icon"><i class="flaticon-secure"></i></span>
                        <span class="title">Trust</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, odio!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="about-block">
                        <span class="icon"><i class="flaticon-cpu"></i></span>
                        <span class="title">Innovation</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corporis, odio!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="line"></div>
    <section>
        <h2 class="section-title">Request a quote</h2>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="quote-form card">
                        <div class="card-header">Data collecting project</div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem, neque.</p>
                            <form action="">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="">First Name</label>
                                    <input type="text" class="form-control" placeholder="Please enter your first name">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Please enter your last name">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="">Project Type</label>
                                    <input type="text" class="form-control" placeholder="Please enter project type">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="quote-form card">
                        <div class="card-header">Transcription project</div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab animi, dolorem maxime minus
                                nam, necessitatibus nihil nobis perferendis porro quisquam quod rem rerum sunt unde
                                vitae voluptas voluptatem voluptatibus voluptatum?</p>
                            <form action="">
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="">First Name</label>
                                    <input type="text" class="form-control" placeholder="Please enter your first name">
                                </div>
                                <div class="form-group mb-2">
                                    <label class="col-form-label" for="">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Please enter your last name">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="">Project Type</label>
                                    <input type="text" class="form-control" placeholder="Please enter project type">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Send request</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('js/dist/particles.min.js') }}"></script>
    <script>
        particlesJS.load('particles-js', '{{ asset('particles.json') }}', function () {

        })
    </script>
@endpush
