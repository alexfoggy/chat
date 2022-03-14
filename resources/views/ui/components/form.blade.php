<div class="row">
    <div class="col-2">
        <h2 class="mb-3"><b>{{ $title }}</b></h2>
    </div>
    <div class="col">
        <form action="" class="user-form">
            <div class="form-text">
                <h4>Lorem ipsum dolor.</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur beatae eveniet illo iste magnam minus, nemo neque nisi quia reprehenderit.</p>
            </div>
            <div class="row">
                <div class="col-12">
                    {{--Simple text input--}}
                    <div class="form-group mt-4">
                        <label for="">Text input label</label>
                        <input type="text" placeholder="text input">
                    </div>
                    {{----}}
                    <div class="form-group mt-4">
                        {{--Radio button--}}
                        <label for="">Radio input label</label>
                        <div class="custom-radio">
                            <input type="radio" name="radio" checked>
                            <span>Radio 1</span>
                        </div>
                        {{----}}
                        <div class="custom-radio">
                            <input type="radio" name="radio">
                            <span>Radio 1</span>
                        </div>
                    </div>
                    <div class="form-group mt-4">
                        {{--Checkbox input--}}
                        <label for="">Checkbox</label>
                        <div class="custom-checkbox">
                            <input type="checkbox" checked id="checkbox-1">
                            <label role="button" for="checkbox-1"></label>
                        </div>
                        <label for="checkbox-1" class="d-inline-block align-text-top mb-0 ml-2">Checkbox Label</label>
                        {{----}}
                    </div>
                    <div class="form-group mt-1">
                        <div class="custom-checkbox">
                            <input type="checkbox" id="checkbox-2">
                            <label role="button" for="checkbox-2"></label>
                        </div>
                        <label for="checkbox-2" class="d-inline-block align-text-top mb-0 ml-2">Checkbox Label</label>
                    </div>
                    {{--Simple textarea--}}
                    <div class="form-group mt-4">
                        <label for="">Textarea label</label>
                        <textarea name="" id="" cols="30" rows="10" placeholder="textarea simple placeholder"></textarea>
                    </div>
                    {{----}}
                </div>
            </div>
        </form>
    </div>
</div>


