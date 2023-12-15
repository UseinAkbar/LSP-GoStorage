<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <title>GoStorage</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="">
    @yield('navbar')

    @yield('content')

    @yield('footer')

    <script>
        function searchButton() {
            document.getElementById('search').classList.remove('hidden');
            document.getElementById('close').classList.remove('hidden');
            document.getElementById('searchButton').classList.add('hidden');
        }

        function closeButton() {
            document.getElementById('searchButton').classList.remove('hidden');
            document.getElementById('search').classList.add('hidden');
            document.getElementById('close').classList.add('hidden');
        }

        function search() {
            let search = document.getElementById('searchInput');
            search.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    searchButtonGo()
                }
            });
            if (search.value.length > 0) {
                document.getElementById('close').classList.add('hidden');
                document.getElementById('searchButton2').classList.remove('hidden');
            } else {
                document.getElementById('close').classList.remove('hidden');
                document.getElementById('searchButton2').classList.add('hidden');
            }
        }

        function searchButtonGo() {
            let search = document.getElementById('searchInput').value;
            if (search.length > 0) {
                window.location.href = '/list_gudang/' + search;
            }
        }
    </script>
</body>

</html>
