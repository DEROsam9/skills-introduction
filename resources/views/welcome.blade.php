<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to My App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-100 via-indigo-200 to-purple-200 min-h-screen flex items-center justify-center">

    <div class="text-center bg-white shadow-lg rounded-lg p-10 w-full max-w-md">
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Welcome to My Laravel App</h1>
        <p class="text-gray-600 mb-8">Please login or register to continue.</p>

        <div class="flex justify-center space-x-4">
            <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Login
            </a>
            <a href="/register" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                Register
            </a>
        </div>
    </div>

</body>
</html>
