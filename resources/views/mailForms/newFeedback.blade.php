@extends('mailForms.mailLayout')


@section('content')
<tr style="width:100%">
    <td>
        <h2>Hello dear {{$user->first_name}}</h2>
    </td>
</tr>
<tr style="width:100%">
    <td>
        <p>You got new message from you website</p>
    </td>
</tr>
@foreach($messages->children as $one_msg)
<tr>

    <td>{{$one_msg->input->placeholder}}</td>
    <td>{{$one_msg->msg_value}}</td>
</tr>
@endforeach

@endsection
