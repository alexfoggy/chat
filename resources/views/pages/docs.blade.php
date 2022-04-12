@extends('layouts.front')
@section('content')


    <div class="container-fluid head-info">
        <img src="{{asset('front/build/img/peace.jpg')}}" alt="">
        <h1>Docs</h1>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-2">
                <p>Navigation</p>
                <ul class="navigtion">
                    <li>
                        <a href="">
                            Start
                        </a>
                    </li>
                    <li>
                        <a href="">Instalation</a>

                    </li>
                    <li>
                        <a href=""> Events</a>

                    </li>
                    <li>
                        <a href="">Modes</a>

                    </li>
                </ul>
            </div>
            <div class="col-lg-10">
                <div class="docs">

                    <h2 class="mb-5">Documentation for developers</h2>

                    <div class="text-block-devid">
                        <h4>Start work</h4>
                        <p>Let's start... First we need to link default <span class="accent">styles</span> and <span
                                class="accent">js core</span></p>
                    </div>
                    <code>
                        Hello
                    </code>
                    <p>and</p>
                    <code>
                        Hello
                    </code>


                    <div class="text-block-devid">
                        <h4>Instalation</h4>
                        <p>Let's install it... First we need to downlowd it if you don't like CDN version</p>
                    </div>
                    <a href="" class="button-docs">Download zip</a>
                    <p>or</p>
                    <code>
                        npm install yolly
                    </code>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')

@endpush
