@extends('layouts.app')

@section('content')
<section class="py-16 min-h-screen bg-gray-50 flex flex-col items-center">
    <div class="w-full max-w-3xl px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-2 text-center">💬 Live Support Chat</h1>
        <p class="text-gray-600 mb-8 text-center">Start a live chat with our support team. We're here to help you instantly.</p>

        <div class="bg-white rounded-2xl shadow-lg flex flex-col h-[600px] overflow-hidden">
            <!-- Chat Messages Container -->
            <div class="flex-1 p-6 overflow-y-auto space-y-4 bg-gray-50" id="chat-container">
                <!-- Example support message -->
                <div class="flex items-start space-x-3">
                    <div class="bg-pink-100 text-gray-800 px-4 py-2 rounded-xl max-w-xs break-words">
                        Hello! How can we assist you today?
                    </div>
                </div>
                <!-- Example user message -->
                <div class="flex justify-end items-start space-x-3">
                    <div class="bg-green-500 text-white px-4 py-2 rounded-xl max-w-xs break-words">
                        I need help with my recent order.
                    </div>
                </div>
                <!-- Placeholder message -->
                <p class="text-gray-400 text-center mt-40">Live chat messages will appear here.</p>
            </div>

            <!-- Input Box -->
            <div class="border-t border-gray-200 p-4 flex items-center space-x-3 bg-white">
                <input type="text" placeholder="Type your message..." id="chat-input"
                    class="flex-1 border border-gray-300 rounded-full px-4 py-2 focus:ring-2 focus:ring-green-400 focus:outline-none">
                <button id="send-btn"
                    class="bg-green-500 text-white px-6 py-2 rounded-full hover:bg-green-600 transition">Send</button>
            </div>
        </div>
    </div>
</section>

<!-- Optional: Simple JS for scrolling to bottom when sending message -->
<script>
    const sendBtn = document.getElementById('send-btn');
    const chatInput = document.getElementById('chat-input');
    const chatContainer = document.getElementById('chat-container');

    sendBtn.addEventListener('click', () => {
        if(chatInput.value.trim() === '') return;

        const message = document.createElement('div');
        message.className = 'flex justify-end items-start space-x-3';
        message.innerHTML = `
            <div class="bg-green-500 text-white px-4 py-2 rounded-xl max-w-xs break-words">
                ${chatInput.value}
            </div>
        `;
        chatContainer.appendChild(message);
        chatInput.value = '';
        chatContainer.scrollTop = chatContainer.scrollHeight;
    });
</script>
@endsection
