@extends("main")
@push("styles")
    <link rel="stylesheet" href="{{ asset('css/components/block.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/form.css') }}">
@endpush
@section("content")
    <div class="block">
        <div class="block-header">
            <h2 class="mb-0">General Information</h2>
        </div>
        <div class="block-content">
            <form action="">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name" placeholder="Please enter your first name" value="{{ $user->first_name }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Please enter your last name" value="{{ $user->last_name }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="email">E-mail address</label>
                            <input type="text" name="email" id="email" placeholder="Enter your Email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="phone">Phone number</label>
                            <input type="text" name="phone" id="phone" placeholder="Enter your phone number" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="line in-row"></div>
                    </div>
                    <h2 class="col-12">Payment Information</h2>
                    {{--Paypal block--}}
                    <div class="col-12 mt-4">
                        <div class="form-group mb-0">
                            <label for="paypal">Paypal</label>
                            <input type="text" name="paypal" id="paypal" placeholder="Please enter your paypal e-mail" value="{{ $user->paypal }}">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="line in-row"></div>
                    </div>
                    <div class="col-12">
                        <button type="submit">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
