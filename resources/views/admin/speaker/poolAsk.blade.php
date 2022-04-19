@extends('layouts.no-header')
@push('title')
    {{$pool->title}}
@endpush
@section('content')
    @if (\Session::has('status'))

        <div class="section-wrapper d-flex justify-content-center align-items-center py-5 w-50 mx-auto mt-5 rounded-5">
            <span class="tx-success tx-30">Thank you.</span>
        </div>
        <script>
            setTimeout(()=>{
                window.location.href = "/";
            },3000)
        </script>
    @else
    <form class="section-wrapper w-50 mx-auto mt-5 rounded-5" action="{{url('sendform',$pool->key)}}" method="post">
        <label class="section-title">{{$pool->title}}</label>
        @csrf
        @if($ques)
            @foreach($ques as $one_que)
                <div class="row py-3 border rounded-5 mb-3 mx-0">
                    <div class="col-lg-12 mb-3 section-title tx-12 font-weight-normal">
                        {{$one_que->title}}
                    </div>
                    @foreach($one_que->checkbox as $one_check)
                        <div class="col-lg-3">
                            <label class="rdiobox">
                                <input name="value[{{$one_que->id}}]" type="radio" value="{{$one_check->id}}" required>
                                <span>{{$one_check->title}}</span>
                            </label>
                        </div>
                    @endforeach
                </div><!-- row -->
            @endforeach
        @endif
            <button class="btn btn-success w-100 rounded-5 font-weight-bold btn-uppercase" type="submit">Send answers</button>
    </form>
    @endif

@endsection
