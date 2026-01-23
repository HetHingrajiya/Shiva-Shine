<!-- resources/views/admin/login.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shiva Shine - Admin Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: radial-gradient(circle at top left, #fdecef, #fce1e4, #f9dcdc);
            overflow: hidden;
        }

        /* Card Styling */
        .login-card {
            backdrop-filter: blur(18px) saturate(180%);
            background: rgba(255, 255, 255, 0.65);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            padding: 3rem 2.5rem;
            max-width: 460px;
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s ease;
            z-index: 5;
        }

        /* Title shimmer */
        .admin-title {
            font-family: 'Cinzel', serif;
            background: linear-gradient(90deg, #d4af37, #ffecd2, #d4af37);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
            font-size: 2.5rem;
        }
        @keyframes shimmer {
            0% { background-position: 0% center; }
            100% { background-position: 200% center; }
        }

        /* Inputs */
        .input-group {
            position: relative;
        }
        .input-group svg {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #d4af37;
        }
        .input-group input {
            padding-left: 48px;
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(212, 175, 55, 0.4);
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .input-group input:focus {
            border-color: #d4af37;
            box-shadow: 0 0 12px rgba(212, 175, 55, 0.4);
        }
        .input-error {
            border-color: #ff4d4f !important;
            box-shadow: 0 0 10px rgba(255, 77, 79, 0.6) !important;
        }

        /* Button */
        .btn-nude {
            background: linear-gradient(135deg, #d4af37, #ffecd2);
            color: black;
            font-weight: bold;
            padding: 0.9rem;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);
            transition: all 0.3s ease;
        }
        .btn-nude:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(212, 175, 55, 0.45);
        }

        /* Error popup */
        .error-popup {
            position: fixed;
            top: -200px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(135deg, #fff0f3, #ffe4e9);
            border: 2px solid #d4af37;
            padding: 1rem 2rem;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            color: #b1272c;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: top 0.5s ease;
            z-index: 9999;
        }
        .error-popup.show {
            top: 20px;
        }

        /* Loader overlay */
        .loader-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            backdrop-filter: blur(6px);
            background: rgba(255, 255, 255, 0.3);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9998;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.4s ease;
        }
        .loader-overlay.show {
            opacity: 1;
            visibility: visible;
        }
        .loader-ring {
            width: 64px;
            height: 64px;
            border: 5px solid rgba(212, 175, 55, 0.2);
            border-top-color: #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            box-shadow: 0 0 20px rgba(212, 175, 55, 0.6);
        }
        @keyframes spin {
            100% { transform: rotate(360deg); }
        }

        /* Mobile first styles */
        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }
            .login-card {
                width: 100%;
                padding: 2rem 1.5rem;
            }
            .admin-title {
                font-size: 2rem;
            }
        }

        /* Desktop enhancements */
        @media (min-width: 1024px) {
            body {
                background: radial-gradient(circle at top left, #fdecef, #fce1e4, #f9dcdc);
            }
            .login-card {
                padding: 3rem 3rem;
                transform: translateY(100px);
            }
            .admin-title {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body class="flex justify-center items-center min-h-screen relative">

    <!-- Loader -->
    <div id="loaderOverlay" class="loader-overlay">
        <div class="loader-ring"></div>
    </div>

    <!-- Error -->
    <div id="errorPopup" class="error-popup">
        <i data-feather="alert-triangle"></i> Please fill all required fields
    </div>

    <!-- Login card -->
    <div class="login-card" id="loginCard">
        <div class="text-center mb-8">
            <h1 class="admin-title">Shiva Shine</h1>
            <p class="text-gray-600 tracking-wide text-sm">✨ Admin Panel Login ✨</p>
        </div>

        <form id="loginForm" class="space-y-6" novalidate>
            @csrf
            <div class="input-group">
                <i data-feather="mail"></i>
                <input type="email" id="email" name="email" placeholder="Email Address" class="w-full px-4 py-2 focus:outline-none" autocomplete="email">
            </div>
            <div class="input-group">
                <i data-feather="lock"></i>
                <input type="password" id="password" name="password" placeholder="Password" class="w-full px-4 py-2 focus:outline-none" autocomplete="current-password">
            </div>
            <div>
                <button type="submit" id="loginBtn" class="w-full btn-nude flex items-center justify-center gap-2">
                    Login
                </button>
            </div>
        </form>

        <div class="text-center mt-8 text-xs text-gray-500">
            © {{ date('Y') }} Shiva Shine | Admin Panel
        </div>
    </div>

    <script>
        feather.replace();

        // Card animation on load
        window.addEventListener("load", () => {
            setTimeout(() => {
                document.getElementById("loginCard").style.opacity = "1";
                document.getElementById("loginCard").style.transform = "translateY(0)";
            }, 300);
        });

        // Error popup
        const errorPopup = document.getElementById("errorPopup");
        function showError(message) {
            errorPopup.innerHTML = `<i data-feather="alert-triangle"></i> ${message}`;
            feather.replace();
            errorPopup.classList.add("show");
            setTimeout(() => {
                errorPopup.classList.remove("show");
            }, 3000);
        }

        // Form validation + submission
        const form = document.getElementById("loginForm");
        const loaderOverlay = document.getElementById("loaderOverlay");
        const email = document.getElementById("email");
        const password = document.getElementById("password");

        form.addEventListener("submit", function(e) {
            e.preventDefault();
            console.log("Form submitted");
            console.log("Email:", email.value);
            console.log("Password:", password.value ? "***" : "(empty)");
            
            // Validate both fields
            let hasError = false;
            
            email.classList.remove("input-error");
            password.classList.remove("input-error");
            
            if (!email.value.trim()) {
                email.classList.add("input-error");
                hasError = true;
            }
            
            if (!password.value.trim()) {
                password.classList.add("input-error");
                hasError = true;
            }

            if (hasError) {
                console.log("Validation error: Please fill all fields");
                showError("Please fill all required fields");
                return;
            }

            console.log("Validation passed, submitting...");
            
            // Show loader
            loaderOverlay.classList.add("show");

            // Submit login request
            fetch("{{ route('admin.login.post') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    email: email.value.trim(),
                    password: password.value
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server response:", data);
                loaderOverlay.classList.remove("show");

                if (data.status === "success") {
                    console.log("Login successful!");
                    window.location.href = data.redirect;
                } else {
                    console.log("Login failed:", data.message);
                    showError(data.message || "Invalid credentials");
                }
            })
            .catch(error => {
                console.error("Request error:", error);
                loaderOverlay.classList.remove("show");
                showError("Something went wrong. Please try again.");
            });
        });
    </script>
</body>
</html>
