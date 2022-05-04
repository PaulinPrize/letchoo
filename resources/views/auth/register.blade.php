<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="m-3" />

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="form-control-label" for="first_name">{{__('messages.First Name')}} </label>
                    <input type="text" id="first_name" class="form-control" name="first_name" autofocus/>
                    @error('first_name')
                        <p class="text-sm text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Last Name') }}" />

                    <x-jet-input class="{{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                                 :value="old('name')" required autocomplete="name" />
                    <x-jet-input-error for="name"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                                 :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Password') }}" />

                    <x-jet-input class="{{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="new-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('messages.Confirm Password') }}" />

                    <x-jet-input class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>
                <!--
                <div class="form-group">
                    <label class="form-control-label" for="role">Rôle </label>
                    <select id="role" class="form-control" name="role">
                        <option value="3">Host</option>
                        <option value="4">Guest</option>
                    </select>                      
                </div>
				-->

                <div class="form-group">
                    <input type="text" id="role" class="form-control" name="role" value="3" hidden/>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <x-jet-checkbox id="terms" name="terms" />
                            <label class="custom-control-label" for="terms">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                    ]) !!}
                            </label>
                        </div>
                    </div>
                @endif

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3 text-decoration-none" href="{{ route('login') }}">
                            {{ __('messages.Already registered?') }}
                        </a>

                        <x-jet-button>
                            {{ __('messages.Register') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
</x-guest-layout>