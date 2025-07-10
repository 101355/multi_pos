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
                        <h4 class="page-title">Edit Sub Category</h4>
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
                        <form method="post" action="{{ route('sub-category.update', $sub_category->id) }}"
                            class="tw-mt-6 tw-space-y-6" id="submit">
                            @csrf
                            @method('put')

                            <div class="form-group">
                                <x-input-label for="warehouse_id" value="Warehouse" />
                                <x-select-input name="warehouse_id" id="warehouse_id" class="tw-mt-1 tw-block tw-w-full"
                                    :disabled="false">
                                    <option value="">-- Select Warehouse --</option>
                                    @foreach ($warehouses as $warehouse)
                                        <option value="{{ $warehouse->id }}"
                                            {{ $sub_category->warehouse_id == $warehouse->id ? 'selected' : '' }}>
                                            {{ $warehouse->name }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                            </div>

                            <div class="form-group">
                                <x-input-label for="category_id" value="Category" />

                                <x-select-input name="category_id" id="category_id" class="tw-mt-1 tw-block tw-w-full">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $sub_category->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                            </div>



                            <div class="form-group">
                                <x-input-label for="name" value="Name" />
                                <x-text-input id="name" name="name" type="text"
                                    class="tw-mt-1 tw-block tw-w-full" :value="old('name', $sub_category->name)" />
                            </div>

                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button
                                    href="{{ route('sub-category.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
    {!! JsValidator::formRequest('App\Http\Requests\SubCategoryRequest', '#submit') !!}
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#warehouse_id').trigger('change'); // auto-trigger after page loads

        $('#warehouse_id').on('change', function() {
            const warehouseId = $(this).val();
            console.log(warehouseId);
            // Clear existing options
            $('#category_id').html('<option value="">Loading...</option>');

            if (warehouseId) {
                $.ajax({
                    url: '{{ route('category_get_category') }}', // or your actual route
                    type: 'POST',
                    data: {
                        warehouse_id: warehouseId,
                        _token: $('meta[name="csrf-token"]').attr(
                            'content') // include CSRF token
                    },
                    success: function(categories) {
                        let options = '<option value="">Select a category</option>';
                        categories.forEach(function(category) {
                            options +=
                                `<option value="${category.id}">${category.name}</option>`;
                        });
                        $('#category_id').html(options);
                    },
                    error: function() {
                        $('#category_id').html(
                            '<option value="">No categories found</option>');
                    }
                });
            } else {
                $('#category_id').html('<option value="">Select a category</option>');
            }
        });
    });
</script>
