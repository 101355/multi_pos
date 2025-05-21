@extends('layouts.app')

@section('title', 'Edit Admin User')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Admin User</h4>
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
                        <form method="post" action="{{ route('admin-user.update', $admin_user->id) }}"
                            class="tw-mt-6 tw-space-y-6" id="submit">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name', $admin_user->name)" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('email', $admin_user->email)" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="phno" value="Phone" />
                                <x-text-input id="phno" name="phno" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('phno', $admin_user->phno)" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="password" value="Password" />
                                <x-text-input id="password" name="password" type="password"
                                    class="tw-mt-1 tw-block tw-w-full" />
                            </div>

                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button
                                    href="{{ route('admin-user.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
    {!! JsValidator::formRequest('App\Http\Requests\AdminUserUpdateRequest', '#submit') !!}
@endpush
