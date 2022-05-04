<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
            
        </x-slot>

        <div class="card-body">

            <x-jet-validation-errors class="mb-3 rounded-0" />

            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!--
                <div class="row mb-3">
                    <div class="col-lg-12">
                        <a class="btn btn-primary btn-block" href="" role="button">
                            Sign in with Facebook
                        </a>
                        <a class="btn btn-danger btn-block" href="" role="button">
                            Sign in with Google
                        </a>  
                    </div>
                </div>
                -->
                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>
                
                <!--
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                
                <div class="mb-2">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted mr-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Log in') }}
                        </x-jet-button>
                    </div>
                </div>
                
                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <span>{{ __('You do not have an account? ') }} 
                            <a class="text-muted mr-3 text-decoration-none" href="{{ route('register') }}">
                                {{ __('Sign up') }}
                            </a>
                        </span>
                    </div>
                </div>
                -->
                <div class="row">
                    <div class="col-8">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="remember_me" name="remember" /> 
                                <label class="custom-control-label" for="remember_me">  
                                    {{ __('messages.Remember Me') }}
                                </label>
                        </div>
                        
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">{{ __('messages.LOG IN') }}</button>
                    </div>
                </div>
                
            </form>
            <div class="social-auth-links text-center mb-3">
                <p>{{__('messages.- OR -')}}</p>
                <a href="{{ url('auth/facebook') }}" class="btn btn-block btn-primary">
                    <i class="fab fa-facebook mr-2"></i> {{__('messages.Sign in using Facebook')}}
                </a>
                <a href="{{ url('auth/google') }}" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> {{__('messages.Sign in using Google+')}}
                </a>
            </div>

            <p class="mb-1">
                @if (Route::has('password.request'))
                    <a class="text-muted mr-3" href="{{ route('password.request') }}">
                        {{ __('messages.Forgot your password?') }}
                    </a>
                @endif
            </p>
            <p class="mb-0">
                <span>{{ __('messages.You do not have an account?') }} 
                    <a class="text-muted mr-3 text-decoration-none" href="{{ route('register') }}">
                        {{ __('messages.Sign up') }}
                    </a>
                </span>
            </p>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>