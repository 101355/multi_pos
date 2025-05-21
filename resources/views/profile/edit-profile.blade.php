@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <x-flash-message></x-flash-message>
            <x-success-message></x-success-message>
            <x-error-message></x-error-message>

            <div class="row">
                <div class="col-md-8 offset-2">
                    <x-card>
                        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                            @csrf
                        </form>

                        <form method="post" action="{{ route('profile.update') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name', $user->name)" required autofocus
                                    autocomplete="name" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('email', $user->email)" required autocomplete="username" />
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                    <div>
                                        <p class="tw-text-sm tw-mt-2 tw-text-gray-800 dark:tw-text-gray-200">
                                            {{ __('Your email address is unverified.') }}

                                            <button form="send-verification"
                                                class="tw-underline tw-text-sm tw-text-gray-600 dark:tw-text-gray-400 hover:tw-text-gray-900 dark:hover:tw-text-gray-100 tw-rounded-md focus:tw-outline-none focus:tw-ring-2 focus:tw-ring-offset-2 focus:tw-ring-indigo-500 dark:focus:tw-ring-offset-gray-800">
                                                {{ __('Click here to re-send the verification email.') }}
                                            </button>
                                        </p>

                                        @if (session('status') === 'verification-link-sent')
                                            <p
                                                class="tw-mt-2 tw-font-medium tw-text-sm tw-text-green-600 dark:tw-text-green-400">
                                                {{ __('A new verification link has been sent to your email address.') }}
                                            </p>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <x-input-label for="phno" :value="__('Phone Number')" />
                                <x-text-input id="phno" name="phno" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('phno', $user->phno)" required autofocus
                                    autocomplete="phno" />
                            </div>

                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button href="{{ route('dashboard') }}">{{ __('Cancel') }}</x-cancel_button>
                            </div>
                        </form>
                    </x-card>
                </div>
            </div>
            <!-- end row-->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\ProfileUpdateRequest', '#submit') !!}
@endpush
