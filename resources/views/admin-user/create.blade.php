@extends('layouts.app')

@section('title', 'Create Admin User')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Create Admin User</h4>
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
                        <form method="post" action="{{ route('admin-user.store') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf

                            <div class="form-group">
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="role" value="Role" />
                                <select name="role_id" id="role_id"
                                    class="tw-mt-1 tw-block tw-w-full tw-rounded-md tw-shadow-sm">
                                    <option value="">-- Select Role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ old('role') == $role->id ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group">
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('email')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="phno" value="Phone" />
                                <x-text-input id="phno" name="phno" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('phno')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="address" value="Address" />
                                <textarea name="address" id="address" class="tw-mt-1 tw-block tw-w-full" rows="3" cols="10"></textarea>
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
    {!! JsValidator::formRequest('App\Http\Requests\AdminUserStoreRequest', '#submit') !!}
@endpush
