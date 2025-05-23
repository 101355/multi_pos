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
                        <h4 class="page-title">Create Supplier</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <x-flash-message></x-flash-message>
            <x-success-message></x-success-message>
            <x-error-message></x-error-message>

            <div class="row">
                <div class="col-md-8 col-12 offset-md-2 offset-0">
                    <x-card>
                        <form method="post" action="{{ route('supplier.store') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf

                            <div class="form-group">
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name')" />
                            </div>



                            <div class="form-group">
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" type="email"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('email')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="phone" value="Phone" />
                                <x-text-input id="phone" name="phone" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('phone')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="url" value="Url" />
                                <x-text-input id="url" name="url" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('url')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="city" value="City" />
                                <x-text-input id="city" name="city" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('city')" />
                            </div>


                            <div class="form-group">
                                <x-input-label for="region" value="Region" />
                                <x-text-input id="region" name="region" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('region')" />
                            </div>


                            <div class="form-group">
                                <x-input-label for="country" value="Country" />
                                <x-text-input id="country" name="country" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('country')" />
                            </div>


                            <div class="form-group">
                                <x-input-label for="description" value="Description" />
                                <x-textarea id="description" name="description"
                                    rows="3">{{ old('description') }}</x-textarea>
                            </div>


                            <div class="form-group">
                                <x-input-label for="supplier_code" value="Supplier Code" />
                                <x-text-input id="supplier_code" name="supplier_code" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('supplier_code')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="opening_balance" value="Opening Balance" />
                                <x-text-input id="opening_balance" name="opening_balance" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('opening_balance')" />
                            </div>

                            <div class="form-group">
                                <x-input-label for="balance" value="Balance" />
                                <x-text-input id="balance" name="balance" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('balance')" />
                            </div>


                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button href="{{ route('supplier.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
    {!! JsValidator::formRequest('App\Http\Requests\SupplierRequest', '#submit') !!}
@endpush
