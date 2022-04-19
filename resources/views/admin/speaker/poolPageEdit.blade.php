@extends('layouts.admin')
@push('title')
    {{trans('vars.tasks',[],$lang)}}
@endpush
@section('content')
    @if(session('status'))
        <div class="alert alert-danger mg-b-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            <strong>{{trans('vars.sorry',[],$lang)}}</strong> {{session('status')}}
        </div>
    @endif
    <form action="{{url('cabinet',['savepool',$pool->key])}}" id="saveform" method="POST" class="uppquestions">
        @csrf
        <div class="section-wrapper">
            <label class="section-title">Pool</label>

            <div class="form-layout">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Title: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" value="{{$pool->title}}" readonly>
                        </div>
                    </div><!-- col-4 -->
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Theme: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" value="{{$pool->theme}}" readonly>
                        </div>
                    </div><!-- col-4 -->
                </div><!-- row -->
            </div><!-- form-layout -->
        </div>
        @if($ques)
            @foreach($ques as $one_que)
                <div class="section-wrapper mg-t-20" id="qq{{$one_que->id}}">
                    <label class="section-title">Question {{$loop->iteration}}</label>
                    <div class="form-layout">
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input class="form-control rounded-5" type="text" name="question[{{$one_que->id}}]"
                                           value="{{$one_que->title}}" required>
                                </div>
                            </div><!-- col-4 -->
                        </div>
                        <div class="row mt-1 questions">
                            <div class="col-lg-12 mb-2 section-title mb-4 d-flex align-items-center">
                                <span>Options</span>
                                <a href="#" class="btn btn-success px-2 py-1 tx-8 ml-2 rounded font-weight-bold"
                                   onclick="newOption(event,{{$one_que->id}})">Add option</a>
                            </div>
                            @foreach($one_que->checkbox as $one_check)
                            <div class="col-lg-3 d-flex align-items-center mb-4" id="qw{{$one_check->id}}">
                                <input class="form-control rounded-5" type="text" value="{{$one_check->title}}"
                                       name="checkbox[{{$one_que->id}}][{{$one_check->id}}]"
                                       required>
                                <a href="#" class="btn btn-danger rounded-5 ml-2 del-option" data-id="{{$one_check->id}}"><i
                                        class="icon ion-close"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </form>
    <div class="d-flex justify-content-between">
        <a href="#" class="btn btn-success rounded-5 btn-uppercase mt-4" onclick="newQuestion(event)">New question</a>
        <button class="btn btn-warning rounded-5 btn-uppercase mt-4" form="saveform" type="submit">Save pool</button>
    </div>

@endsection
@push('scripts')

    <script>
        let questionCount = 0;
        let count = 0;
        let countNameQuestion

        function newOption(event, id) {
            event.preventDefault();
            let itm = $('#qq' + id);

            // let countBlock = itm.find('.qwcount');
            // let count = countBlock.val();
            // count++;
            // countBlock.val(count);
            count--;
            let wrap = '<div class="col-lg-3 d-flex align-items-center mb-3" id="qw' + count + '">' +
                '<input class="form-control rounded-5" name="checkbox[' + id + '][' + count + ']" type="text" value="" required>' +
                '<a href="#" class="btn btn-danger rounded-5 ml-2 del-option" data-id="' + count + '"><i class="icon ion-close"></i></a>'
            '</div>';

            itm.find('.questions').append(wrap);
            console.log(itm);

        }

        $(document).on('click', '.del-option', function (e) {
            e.preventDefault();
            if ($(this).closest('.questions').find('.col-lg-3').length > 2) {
                $('#qw' + $(this).attr('data-id')).remove();
            } else {
                alert('min 2 options')
            }
        })

        function newQuestion(event) {
            event.preventDefault();
            questionCount--;

            count1 = count - 1;
            count2 = count - 2;

            count -= 2;
            let wrap = '<div class="section-wrapper mg-t-20" id="qq' + questionCount + '">' +
                '<label class="section-title">New question</label>' +
                '<div class="form-layout">' +
                '<div class="row mt-2">' +
                '<div class="col-md-12">' +
                '<div class="form-group">' +
                '<input class="form-control rounded-5" type="text" name="question[' + questionCount + ']" placeholder="How old are you ?" required>' +
                '</div>' +
                '</div><!-- col-4 -->' +
                '</div>' +
                '<div class="row mt-1 questions">' +
                '<div class="col-lg-12 mb-2 section-title mb-4 d-flex align-items-center">' +
                '<span>Options</span>' +
                '<a href="#" class="btn btn-success px-2 py-1 tx-8 ml-2 rounded font-weight-bold" onclick="newOption(event,' + questionCount + ')">Add option</a>' +
                '</div>' +
                '<div class="col-lg-3 d-flex align-items-center mb-4" id="qw' + +count1 + '">' +
                '<input class="form-control rounded-5" name="checkbox[' + questionCount + '][' + count1 + ']" type="text" value="3 - 14 years" required>' +
                '<a href="#" class="btn btn-danger rounded-5 ml-2 del-option" data-id="' + count1 + '"><i class="icon ion-close"></i></a>' +
                '</div>' +
                '<div class="col-lg-3 d-flex align-items-center mb-4" id="qw' + count2 + '">' +
                '<input class="form-control rounded-5" name="checkbox[' + questionCount + '][' + count2 + ']" type="text" value="15 - 25 years" required>' +
                '<a href="#" class="btn btn-danger rounded-5 ml-2 del-option" data-id="' + count2 + '"><i class="icon ion-close"></i></a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div> ';


            $('.uppquestions').append(wrap);

        }


    </script>




@endpush
