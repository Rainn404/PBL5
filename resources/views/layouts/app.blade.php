<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HIMA-TI Politala</title>
  @vite('resources/css/app.css') <!-- kalau pakai Tailwind -->
</head>
<body class="bg-gray-100">
  <!-- Navbar -->
  <nav class="bg-white shadow flex items-center justify-between px-6 py-3">
      <div class="flex items-center gap-4">
          <img src="https://via.placeholder.com/40" class="w-10 h-10 rounded-full" alt="logo">
          <span class="font-bold text-blue-700">HIMA-TI Politala</span>
      </div>
      <div class="space-x-4 hidden sm:flex">
          <a href="/" class="hover:text-blue-600">Home</a>
          <a href="#" class="hover:text-blue-600">Divisi</a>
          <a href="#" class="hover:text-blue-600">Profil</a>
          <a href="#" class="hover:text-blue-600">Berita</a>
          <a href="{{ route('pendaftaran.index') }}" class="hover:text-blue-600">Pendaftaran</a>
          <a href="#" class="hover:text-blue-600">Prestasi</a>
          <a href="#" class="hover:text-blue-600">Kotak Aspirasi</a>
      </div>
      <a href="#" class="border px-3 py-1 rounded">Login</a>
  </nav>

  <main>
      @yield('content')
  </main>
</body>
</html>
