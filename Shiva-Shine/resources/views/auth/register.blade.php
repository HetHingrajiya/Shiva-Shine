<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f2ee] flex items-center justify-center min-h-screen px-4 sm:px-0">

  <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full sm:w-96">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Register</h2>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
      @csrf
      <input type="text" name="name" placeholder="Full Name"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <input type="email" name="email" placeholder="Email"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <input type="password" name="password" placeholder="Password"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <input type="password" name="password_confirmation" placeholder="Confirm Password"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <button type="submit"
        class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
        Register
      </button>
    </form>

    <p class="mt-4 text-sm text-center text-gray-600">
      Already have an account?
      <a href="{{ route('login') }}" class="text-gray-900 font-semibold hover:underline">Login</a>
    </p>
  </div>

</body>
</html>
