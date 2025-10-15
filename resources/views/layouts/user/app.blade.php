<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','HIMA-TI')</title>

  {{-- CSS: pilih salah satu sesuai setup kamu --}}
  {{-- Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])
  {{-- atau file statis --}}
  {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .sidebar{width:250px;height:100vh;position:fixed;top:0;left:0;overflow-y:auto;border-right:1px solid #e5e7eb;background:#fff}
    .sidebar .nav-link{padding:12px 16px;color:#334155;border-radius:8px;transition:.2s}
    .sidebar .nav-link:hover,.sidebar .nav-link.active{background:#0d6efd;color:#fff!important}
    .main-content{margin-left:250px;padding:24px}
    @media (max-width:992px){
      .sidebar{position:fixed;transform:translateX(-100%);transition:.25s}
      .sidebar.show{transform:none}
      .main-content{margin-left:0}
    }
  </style>
</head>
<body>
  @include('layouts.user.sidebar')

  <div class="main-content">
    @yield('content')
  </div>

  {{-- optional: toggle sidebar di mobile --}}
  <script>
    // tambahkan tombol sendiri jika perlu: document.getElementById('btnToggle').onclick = ...
  </script>
</body>
</html>
