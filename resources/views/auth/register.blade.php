<x-layouts.auth>
    <div
        class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="p-6">
            <div class="mb-3">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ __('Register an account') }}</h1>
            </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-3">
                    @csrf

                    <!-- First Name -->
                    <div>
                        <x-forms.input 
                            label="First Name" 
                            name="firstname" 
                            type="text" 
                            placeholder="John" 
                            :value="old('firstname')" 
                            required 
                            autofocus 
                        />
                    </div>

                    <!-- Last Name -->
                    <div>
                        <x-forms.input 
                            label="Last Name" 
                            name="lastname" 
                            type="text" 
                            placeholder="Doe" 
                            :value="old('lastname')" 
                            required 
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-forms.input 
                            label="Email" 
                            name="email" 
                            type="email" 
                            placeholder="your@email.com" 
                            :value="old('email')" 
                            required 
                        />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-forms.input 
                            label="Password" 
                            name="password" 
                            type="password" 
                            placeholder="••••••••" 
                            required 
                        />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-forms.input 
                            label="Confirm Password" 
                            name="password_confirmation" 
                            type="password"
                            placeholder="••••••••" 
                            required 
                        />
                    </div>

                    <!-- Register Button -->
                    <x-button type="primary" class="w-full">
                        {{ __('Create Account') }}
                    </x-button>
                </form>

            <!-- Login Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}"
                        class="text-blue-600 dark:text-blue-400 hover:underline font-medium">{{ __('Sign in') }}</a>
                </p>
            </div>
        </div>
    </div>
</x-layouts.auth>
