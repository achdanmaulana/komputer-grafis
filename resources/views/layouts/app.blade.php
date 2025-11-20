<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>NusaVirland</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <style>body{font-family:Inter,system-ui,-apple-system,"Segoe UI",Roboto,"Helvetica Neue",Arial;margin:0}</style>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-white text-slate-900">
  @include('components.navbar')
  <main>@yield('content')</main>
  @include('components.footer')
</body>
</html>
