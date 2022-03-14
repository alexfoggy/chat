@extends('layouts.no-header')
@section('content')
    <div class="container pt-5">
       <p>Link this styles</p>
        <p>
            <pre>
              &lt;link rel="stylesheet" href="https://www.yolly.pro/cdn/yolly.min.css"&gt;
        </pre>
        </p>

        <p>Link script</p>
        <p>
           <pre>
              &lt;script src="https://www.yolly.pro/cdn/yolly.min.js" data-key="{{$site->site_key}}" id="chatme" defer&gt;&lt;/script&gt;
           </pre>
        </p>

    </div>


@endsection
@push('scripts')

@endpush
