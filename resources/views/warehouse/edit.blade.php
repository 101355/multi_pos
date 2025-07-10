@extends('layouts.app')

@section('title', 'Edit Sub Category')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Edit Warehouse</h4>
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
                        <form method="post" action="{{ route('warehouse.update', $warehouse->id) }}"
                            class="tw-mt-6 tw-space-y-6" id="submit">
                            @csrf
                            @method('put')



                            <div class="form-group">
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name', $warehouse->name)" />
                            </div>


                            <div class="form-group">
                                <x-input-label for="address" value="Address" />
                                <x-textarea id="address" name="address"
                                    rows="3">{{ old('address', $warehouse->address) }}</x-textarea>
                            </div>


                            <div class="form-group">
                                <x-input-label for="description" value="Description" />
                                <x-textarea id="description" name="description"
                                    rows="3">{{ old('description', $warehouse->description) }}</x-textarea>
                            </div>

                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button href="{{ route('warehouse.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
