<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ url('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ url('css/all.css') }}" rel="stylesheet">
    <livewire:styles />
</head>