@extends('layouts.front')
@section('content')


    <!-- Main Header end -->
    <!-- Hero start -->
    <section class="hero">
        <div class="container-fluid">
            <div class="row main-screen">
                <div class="col-lg-5 d-flex justify-content-center align-items-center">
                    <div class="px-5">
                        <span class="tag">yolly.pro</span>
                        <h1 class="tx-main">Beautiful and powerful solution</h1>
                        <h2 class="tx-norm">Starts from $3.99 per month</h2>
                        <a href="{{url('instruction')}}" class="main-button">Read more <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                                                         xmlns="http://www.w3.org/2000/svg">
                <path d="M19 12L5 12" stroke="#292929" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
                <path d="M12 19L19 12L12 5" stroke="#292929" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round" />
              </svg>
            </span></a>
                    </div>
                </div>
                <div class="col-lg-7 bg-main d-flex justify-content-center align-items-center">
                    <div class="text-block">
                        <span class="blockchange">Mail forms</span>
                    </div>
                    <div class="circles">
                        <div class="" style="animation-delay: 0.5s !important;"></div>
                        <div class="" style="animation-delay: 1s !important;"></div>
                        <div class="" style="animation-delay: 1.5s !important;"></div>
                        <div class="" style="animation-delay: 2s !important;"></div>
                        <div class="" style="animation-delay: 2.5s !important;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="h-100vh">
      <div class="container-fluid">
        <div class="row main-screen  mob-rev">
          <div class="col-lg-7 bg-main-rev d-flex justify-content-center align-items-center">
            <div class="circles not-abs-cir">
              <div class="" style="animation-delay: 0.5s !important;"></div>
              <div class="" style="animation-delay: 1s !important;"></div>
              <div class="" style="animation-delay: 1.5s !important;"></div>
              <div class="" style="animation-delay: 2s !important;"></div>
              <div class="" style="animation-delay: 2.5s !important;"></div>
              <div class="" style="animation-delay: 3s !important;"></div>
            </div>
          </div>
          <div class="col-lg-5 d-flex justify-content-center align-items-center">
            <div class="px-5 text-right">
              <span class="tag">yolly.pro</span>
              <h1 class="tx-main">Try it now for free and take choice</h1>
              <h2 class="tx-norm">30-days trial with no limits</h2>
              <a href="" class="main-button">Try it now</a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="h-100vh">
      <div class="container-fluid">
        <div class="row main-screen">
          <div class="col-lg-5 d-flex justify-content-center align-items-center">
            <div class="px-5">
              <span class="tag">yolly.pro</span>
              <h1 class="tx-main">Try it now for free and take choice</h1>
              <h2 class="tx-norm">30-days trial with no limits</h2>
              <a href="" class="main-button">Try it now</a>
            </div>
          </div>
          <div class="col-lg-7 bg-main d-flex justify-content-center align-items-center">
            <div class="circles not-abs">
              <div class="" style="animation-delay: 1s !important;"></div>
              <div class="" style="animation-delay: 1.2s !important;"></div>
              <div class="" style="animation-delay: 1.3s !important;"></div>
              <div class="" style="animation-delay: 1.5s !important;"></div>
            </div>
          </div>
        </div>
      </div>
    </section> -->
    <!-- Hero end -->



@endsection
@push('scripts')

@endpush
