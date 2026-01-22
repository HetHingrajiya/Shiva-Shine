@extends('layouts.app')

@section('title', 'More at Shiva Shine')

@section('content')
<section class="w-full bg-gray-50 py-24 min-h-screen flex flex-col items-center">

    <div class="max-w-3xl w-full px-6 text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4">✨ More at Shiva Shine</h1>
        <p class="text-gray-600 text-lg">
            Discover the vision, creativity, and skill powering Shiva Shine. Meet the founder and the talented team behind every feature and design.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-10 w-full max-w-6xl">

        <!-- Founder Card -->
        <div class="bg-white rounded-3xl shadow-xl p-10 hover:shadow-2xl transition transform hover:-translate-y-2">
            <div class="bg-indigo-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mb-6 mx-auto">YG</div>
            <h2 class="text-xl font-bold text-gray-800 mb-2 text-center">Het Hingrajiya</h2>
            <p class="text-indigo-600 font-semibold text-center mb-4">Founder & Visionary</p>
            <p class="text-gray-500 text-sm text-center mb-4">
                Steering Shiva Shine’s vision and ensuring top-quality products and exceptional user experience across the platform.
            </p>
            <div class="flex flex-wrap justify-center gap-2">
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">Vision</span>
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">Strategy</span>
                <span class="px-3 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-semibold">Innovation</span>
            </div>
        </div>

        <!-- Main Developer Card -->
        <div class="bg-white rounded-3xl shadow-2xl p-10 hover:shadow-3xl transition transform hover:-translate-y-2">
            <div class="bg-green-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mb-6 mx-auto">HL</div>
            <h2 class="text-xl font-bold text-gray-800 mb-2 text-center">Het Hingrajiya</h2>
            <p class="text-green-600 font-semibold text-center mb-4">Lead Developer & Full Stack Expert</p>
            <p class="text-gray-500 text-sm text-center mb-4">
                Responsible for all functionalities, smooth performance, backend systems, and ensuring a seamless user experience across Shiva Shine.
            </p>
            <div class="flex flex-wrap justify-center gap-2 mt-4">
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">Laravel</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">TailwindCSS</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">PHP</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">JavaScript</span>
                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">API Development</span>
            </div>
        </div>

        <!-- Designer/Developer Support Card -->
        <div class="bg-white rounded-3xl shadow-xl p-10 hover:shadow-2xl transition transform hover:-translate-y-2">
            <div class="bg-pink-600 text-white w-20 h-20 rounded-full flex items-center justify-center text-2xl font-bold mb-6 mx-auto">HH</div>
            <h2 class="text-xl font-bold text-gray-800 mb-2 text-center">Het Hingrajiya</h2>
            <p class="text-pink-600 font-semibold text-center mb-4">Designer & Developer</p>
            <p class="text-gray-500 text-sm text-center mb-4">
                Focused on UI/UX, design consistency, and development support to ensure a visually appealing and functional platform.
            </p>
            <div class="flex flex-wrap justify-center gap-2">
                <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">Design</span>
                <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">Frontend Development</span>
                <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-xs font-semibold">UI/UX</span>
            </div>
        </div>

    </div>

    <!-- About Section -->
    <div class="mt-24 max-w-3xl bg-white rounded-3xl shadow-2xl p-12 text-center hover:shadow-3xl transition">
        <h2 class="text-3xl font-bold text-gray-900 mb-6">About Shiva Shine</h2>
        <p class="text-gray-700 text-lg leading-relaxed">
            Shiva Shine is a premium online jewellery platform delivering top-quality products and a seamless shopping experience.
            Founded by Het Hingrajiya, and developed with full-stack expertise by Het Hingrajiya, our team ensures a modern, secure, and smooth platform.
            Het Hingariya contributes to design and development support to maintain a clean and elegant UI.
        </p>
        <p class="text-gray-500 text-sm mt-6">
            Founded by Het Hingrajiya &nbsp;|&nbsp; Developed by Het Hingrajiya
        </p>
    </div>

</section>
@endsection
