@extends('layouts.app')

@section('content')
<div class="mx-auto px-4 md:px-8">
    <x-partials.card>
        <x-slot name="title">{{ __('Reset Password') }}</x-slot>

        <div class="flex-auto p-6">
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="mb-4 flex flex-wrap ">
                    <label for="email" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('E-Mail Address') }}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <x-inputs.email name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus/>

                        @error('email')
                            <span class="hidden mt-1 text-sm text-red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 flex flex-wrap ">
                    <label for="password" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Password') }}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <x-inputs.password name="password" required autocomplete="new-password"/>

                        @error('password')
                            <span class="hidden mt-1 text-sm text-red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 flex flex-wrap ">
                    <label for="password-confirm" class="md:w-1/3 pr-4 pl-4 pt-2 pb-2 leading-normal md:text-right">{{ __('Confirm Password') }}</label>

                    <div class="md:w-1/2 pr-4 pl-4">
                        <x-inputs.password id="password-confirm" name="password_confirmation" required autocomplete="new-password"/>
                    </div>
                </div>

                <div class="mb-4 flex flex-wrap ">
                    <div class="md:w-1/2 pr-4 pl-4 md:mx-1/3">
                        <button type="submit" class="button button-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </x-partials.card>
</div>
@endsection
