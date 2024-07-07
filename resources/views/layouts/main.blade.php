<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard | {{ $title }}</title>
    {{-- bootstrap --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="/css/style.css">

    {{-- font awesome --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        /* Styles for the dropdown menu */
        .dropdown {
            position: relative;
            /* font-weight: 580; */
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            font-weight: 580;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a,
        .dropdown-content form {
            color: black;
            font-weight: 580;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover,
        .dropdown-content form:hover {
            background-color: #f1f1f1;

        }

        .dropdown:hover .dropdown-content {
            display: block;
            font-weight: 580;
        }

        .dropdown-btn {
            color: #333;
            padding: 16px;
            font-weight: 580;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropdown-btn:hover {}

        .logout-button {
            border: none;
            background: none;
            color: black;
            font-weight: 580;
            padding: 0;
            margin: 0;
            font-size: 16px;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #f1f1f1;
        }
    </style>

    @stack('styles')

</head>

<body>
    @include('partials.sidebar')
    <div class="container">
        @yield('container')
    </div>

    {{-- Bootstrap JS --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXlY0D+I/VKY/U5wAXF0PNEeRHXVV2d7YlQj4MWflswB4PiUxGJr69wWnANM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGcu3l9bBT6tNNWRRl9/JSmmbb0Y4xFtw+3LrYzO5lnn5BxZ9+hXJKQY1oE" crossorigin="anonymous"></script> --}}

    {{-- Script JS --}}
    <script src="/js/script.js"></script>
    {{-- <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
