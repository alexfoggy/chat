<div class="openformYolly">
    Contact us
</div>

<div class="contactFormYollyPopup">
    <div class="plenka"></div>
    <div class="form">
        <div class="close">
            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1.00006L11 11.0001M1 11.0001L11 1.00006" stroke="#292929" stroke-width="2"
                      stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>
        <div class="H">
            {{$form->head}}
        </div>
        <form action="###" id="formYolly" class="inputs">
            @foreach($inputs as $one_inp)
            <input  @if($loop->last) @if(!(count($inputs) % 2) == 0) class="w-100" @endif @endif type="text" placeholder="{{$one_inp->placeholder}}" name="{{$one_inp->id}}" @if($one_inp->type == 'req') required @endif>
            @endforeach
            <button type="submit"><span class="sendButton">Send</span>
                <div class="loader">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M3 11.9998C3 7.02925 7.02944 2.99982 12 2.99982C14.8273 2.99982 17.35 4.30348 19 6.34248"
                            stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M19.5 2.99982L19.5 6.99982L15.5 6.99982" stroke="#292929" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                        <path
                            d="M21 11.9998C21 16.9704 16.9706 20.9998 12 20.9998C9.17273 20.9998 6.64996 19.6962 5 17.6572"
                            stroke="#292929" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.5 20.9998L4.5 16.9998L8.5 16.9998" stroke="#292929" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </button>
    </div>
</div>