@extends('layouts.app')

@section('content')
<!-- ===== Contact Us Section ===== -->
<section class="w-full bg-gray-50 py-20 min-h-screen mt-20">
    <div class="max-w-7xl mx-auto px-4 lg:px-8">
        <h1 class="text-4xl font-extrabold text-gray-900 text-center mb-12">📩 Contact Us</h1>
        <p class="text-center text-gray-600 mb-16 max-w-2xl mx-auto">
            Have a question, need assistance, or want to send feedback? Reach out to our team and we'll get back to you promptly.
        </p>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Contact Form -->
            <div class="lg:col-span-7 bg-white rounded-3xl shadow-xl p-10 flex flex-col">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Send a Message</h2>
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" placeholder="Your name"
                               class="w-full border border-gray-300 rounded-xl px-5 py-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" placeholder="Your email"
                               class="w-full border border-gray-300 rounded-xl px-5 py-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition">
                    </div>

                    <div>
                        <label class="block text-gray-700 mb-2">Message</label>
                        <textarea name="message" rows="6" placeholder="Type your message..."
                                  class="w-full border border-gray-300 rounded-xl px-5 py-3 focus:ring-2 focus:ring-indigo-400 focus:outline-none transition"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full bg-indigo-600 text-white font-semibold py-3 rounded-xl hover:bg-indigo-700 transition">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="lg:col-span-5 flex flex-col gap-6">

                <!-- Owner / Developers -->
                <div class="bg-white rounded-3xl shadow-lg p-6 flex items-start gap-4 hover:shadow-xl transition">
                    <span class="text-indigo-600 text-3xl">👤</span>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Owner & Developers</h3>
                        <p class="text-gray-600 mt-1">Owner: <span class="font-medium">Yuvraj Gosai</span></p>
                        <p class="text-gray-600">Developers: <span class="font-medium">Hemang Lakhadiya & Het Hingrajiya</span></p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="bg-white rounded-3xl shadow-lg p-6 flex items-start gap-4 hover:shadow-xl transition">
                    <span class="text-green-500 text-3xl">📞</span>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Phone</h3>
                        <p class="text-gray-600 mt-1"><a href="tel:1234567890" class="text-indigo-500 hover:underline">123-456-7890</a></p>
                    </div>
                </div>

                <!-- Email -->
                <div class="bg-white rounded-3xl shadow-lg p-6 flex items-start gap-4 hover:shadow-xl transition">
                    <span class="text-red-500 text-3xl">📧</span>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Email</h3>
                        <p class="text-gray-600 mt-1"><a href="mailto:support@example.com" class="text-indigo-500 hover:underline">support@example.com</a></p>
                    </div>
                </div>

                <!-- Address -->
                <div class="bg-white rounded-3xl shadow-lg p-6 flex items-start gap-4 hover:shadow-xl transition">
                    <span class="text-yellow-500 text-3xl">🏠</span>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Address</h3>
                        <p class="text-gray-600 mt-1">123, Web Street, Rajkot, India</p>
                    </div>
                </div>

                <!-- Social Media / Quick Links -->
                <div class="bg-white rounded-3xl shadow-lg p-6 flex flex-col gap-3 hover:shadow-xl transition">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="#" class="text-blue-500 hover:text-blue-600 transition">Facebook</a>
                        <a href="#" class="text-pink-500 hover:text-pink-600 transition">Instagram</a>
                        <a href="#" class="text-blue-400 hover:text-blue-500 transition">Twitter</a>
                        <a href="#" class="text-green-500 hover:text-green-600 transition">WhatsApp</a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
@endsection
