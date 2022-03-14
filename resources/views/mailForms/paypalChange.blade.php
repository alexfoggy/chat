<h2>Hello,{{$user->first_name}} {{$user->last_name}}</h2>

<p>Here is a link for paypal change mail, please pay atantion whene you will be writing you email</p>
<a href="{{url('paypal',['email',$user->token])}}">
    Change paypal email
</a>
