@extends('mailForms.mailLayout')


@section('content')
    <tr>
        <td>
            <h2>Hello dear {{$user->first_name}}</h2>
        </td>
    </tr>
    <tr>
        <td>
            <p>You has been added at Unicrowd.ai as Project manager</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin: 4px 0">Your login: {{$user->email}}</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin: 4px 0">Your password: {{$pass}}</p>
        </td>
    </tr>
@endsection
