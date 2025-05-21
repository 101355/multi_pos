@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Change Password</h4>
                    </div>
                </div>
            </div>
            <x-flash-message></x-flash-message>
            <x-success-message></x-success-message>
            <x-error-message></x-error-message>

            <!-- end page title -->

            <div class="row">
                <div class="col-md-8 offset-2">
                    <x-card>
                        <form method="post" action="{{ route('change-password.update') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                <x-text-input id="update_password_current_password" name="current_password" type="password"
                                    class="tw-mt-1 tw-block tw-w-full" autocomplete="current-password" />
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="tw-mt-2" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="update_password_password" :value="__('New Password')" />
                                <x-text-input id="update_password_password" name="password" type="password"
                                    class="tw-mt-1 tw-block tw-w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="tw-mt-2" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                <x-text-input id="update_password_password_confirmation" name="password_confirmation"
                                    type="password" class="tw-mt-1 tw-block tw-w-full" autocomplete="new-password" />
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="tw-mt-2" />
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
    {!! JsValidator::formRequest('App\Http\Requests\ChangePasswordRequest', '#submit') !!}
@endpush
