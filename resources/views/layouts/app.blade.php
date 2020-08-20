<!DOCTYPE html>
<html lang="ja">
    <head>
        <!-- Basic Page Needs -->
        <meta charset="utf-8">
        <title>Safety Confirmation Easy</title>
        <meta name="description" content="">
        <meta name="author" content="">
        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/normalize.css') }}">
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <!-- datatables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>
        <!-- オリジナル -->
        <link rel="stylesheet" href="{{ asset('css/common.css') }}">
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    </head>

    <body>

        @include('commons.navbar')
        
        <div class="container">
            @include('commons.error_messages')
            @include('commons.flash_message')
            
            @yield('content')
        </div>
        
        <!-- まずjQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <!-- cloudflare -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <!-- bootstrap -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <!-- datatables -->
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
        <!-- fontawesome(アイコン) -->
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        <!-- オリジナル -->
        <script src="{{ asset('js/common.js') }}"></script>
    </body>
</html>
<!-- 
The MIT License (MIT) Copyright (c) 2014-2015 Rafael J. Staib
-->