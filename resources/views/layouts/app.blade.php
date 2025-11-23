<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SkillHub - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal flex flex-col min-h-screen">

    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('dashboard') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-lg">SkillHub</span>
                        </a>
                    </div>

                    <div class="hidden md:flex items-center space-x-1">
                        <a href="{{ route('dashboard') }}"
                            class="py-4 px-2 border-b-4 font-semibold transition duration-300
                           {{ request()->routeIs('dashboard') ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-blue-500' }}">
                            Dashboard
                        </a>

                        <a href="{{ route('peserta.index') }}"
                            class="py-4 px-2 border-b-4 font-semibold transition duration-300
                           {{ request()->routeIs('peserta.*') ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-blue-500' }}">
                            Peserta
                        </a>

                        <a href="{{ route('kelas.index') }}"
                            class="py-4 px-2 border-b-4 font-semibold transition duration-300
                           {{ request()->routeIs('kelas.*') ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-blue-500' }}">
                            Kelas
                        </a>

                        <a href="{{ route('pendaftaran.index') }}"
                            class="py-4 px-2 border-b-4 font-semibold transition duration-300
                           {{ request()->routeIs('pendaftaran.*') ? 'border-blue-500 text-blue-500' : 'border-transparent text-gray-500 hover:text-blue-500' }}">
                            Pendaftaran
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8 px-4 mb-12 flex-1">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
            @yield('title')
        </h1>

        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi Kesalahan:</p>
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @yield('content')
        </div>
    </div>

    <footer class="bg-white border-t mt-auto">
        <div class="container mx-auto px-4 py-6">
            <p class="text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} SkillHub Certification Project.
            </p>
        </div>
    </footer>

</body>

</html>
