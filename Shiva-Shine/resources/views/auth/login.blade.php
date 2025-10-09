<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#f5f2ee] flex items-center justify-center min-h-screen px-4 sm:px-0">

  <div class="bg-white shadow-lg rounded-2xl p-6 sm:p-8 w-full sm:w-96">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Login</h2>

    <form action="{{ route('login') }}" method="POST" class="space-y-4">
      @csrf
      <input type="email" name="email" placeholder="Email"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <input type="password" name="password" placeholder="Password"
        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400">
      <button type="submit"
        class="w-full bg-gray-800 text-white py-2 rounded-lg hover:bg-gray-900 transition duration-200">
        Login
      </button>
    </form>

    <div class="mt-4 text-center text-gray-600">Or</div>

    <a href="{{ route('google.login') }}"
      class="mt-4 flex items-center justify-center gap-2 border border-gray-300 py-2 rounded-lg hover:bg-gray-100 transition duration-200">
      <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-5 h-5">
      Login with Google
    </a>

    <p class="mt-4 text-sm text-center text-gray-600">
      Don’t have an account?
      <a href="{{ route('register') }}" class="text-gray-900 font-semibold hover:underline">Register</a>
    </p>
  </div>

</body>
</html>
