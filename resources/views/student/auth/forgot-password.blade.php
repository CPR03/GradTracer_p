<x-student-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-base-200">
        <div class="card w-96 bg-base-100 shadow-xl ">
            <div class="card-body">

                <!-- Title -->
                <h2 class="card-title text-2xl font-bold text-center mb-2">
                    Forgot Password?
                </h2>

                <div class="text-sm text-base-content/70 text-start mb-6">
                    {{
                        __(
                            "No worries! Enter your email and we'll send you reset instructions."
                        )
                    }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status
                    class="mb-4"
                    :status="session('status')"
                />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Input -->
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text flex items-center gap-2">
                                <i data-lucide="mail" class="w-4 h-4"></i>
                                Email address
                            </span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            class="input input-bordered w-full focus:input-primary"
                            placeholder="name@example.com"
                            required
                            autofocus
                        />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary w-full mt-6">
                        <i data-lucide="send" class="w-4 h-4 mr-2"></i>
                        {{ __("Send Reset Link") }}
                    </button>

                    <!-- Back to Login -->
                    <div class="text-center mt-4">
                        <a
                            href="{{ route('login') }}"
                            class="link link-hover text-sm inline-flex items-center"
                        >
                            <i
                                data-lucide="arrow-left"
                                class="w-4 h-4 mr-2"
                            ></i>
                            Back to login
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-student-guest-layout>

<script>
    // Initialize Lucide Icons
    lucide.createIcons();
</script>
