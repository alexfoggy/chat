<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unicrowd UI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/fonts/icons/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap') }}">
    <link rel="stylesheet" href="{{ asset('ui/components/form.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/components/task.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/components/tabs.css') }}">
    <style>
        body {
            font-family: 'Roboto';
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="container">
    @include('ui.components.form', ['title' => 'Forms'])
    <hr>
    @include('ui.components.tasks', ['title' => 'Tasks'])
    <hr>
    @include('ui.components.tabs', ['title' => 'Tabs'])
</div>
@stack('script')
</body>
</html>
