<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Kitchen</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
   
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto px-4 flex items-center justify-between">
        <a href="{{ route('welcome') }}" class="text-3xl font-semibold text-gray-800">Virtual Kitchen</a>            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-gray-600 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-600 hover:text-blue-600">Register</a>
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

  
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Virtual Kitchen. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
