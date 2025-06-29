@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Create Product</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <x-flash-message></x-flash-message>
            <x-success-message></x-success-message>
            <x-error-message></x-error-message>

            <div class="row">
                <div class="col-12">
                    <x-card>
                        <form method="post" action="{{ route('category.store') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="product_name" value="Product Name" />
                                    <x-text-input id="product_name" name="product_name" type="text"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('product_name')" />
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="description" value="Product Description" />
                                    <x-text-input id="description" name="description" type="text"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('description')" />
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="role" value="Warehouse" />
                                    <x-select-input name="warehouse_id" id="warehouse_id" class="tw-mt-1 tw-block tw-w-full"
                                        :disabled="false">
                                        <option value="">-- Select Warehouse --</option>
                                        @foreach ($warehouses as $warehouse)
                                            <option value="{{ $warehouse->id }}"
                                                {{ old('warehouse_id') == $warehouse->id ? 'selected' : '' }}>
                                                {{ $warehouse->name }}
                                            </option>
                                        @endforeach
                                    </x-select-input>
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="category_id" value="Category" />
                                    <x-select-input name="category_id" id="category_id" class="tw-mt-1 tw-block tw-w-full">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-select-input>
                                </div>

                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="sub_category_id" value="Sub Category" />
                                    <x-select-input name="sub_category_id" id="sub_category_id"
                                        class="tw-mt-1 tw-block tw-w-full">
                                        <option value="">-- Select Sub Category --</option>
                                    </x-select-input>
                                </div>



                                {{-- <div class="form-group col-lg-4">
                                    <x-input-label for="description" value="Product Description" />
                                    <x-textarea id="description" name="description"
                                        rows="3">{{ old('description') }}</x-textarea>
                                </div> --}}

                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="barcode" value="Barcode" />
                                    <x-text-input id="barcode" name="barcode" type="text"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('barcode')" />
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="expired_date" value="Expired Date" />
                                    <x-text-input id="expired_date" name="expired_date" type="date"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('expired_date')" />
                                </div>
                            </div>


                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button href="{{ route('category.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
    {!! JsValidator::formRequest('App\Http\Requests\CategoryRequest', '#submit') !!}
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('#category_id').on('change', function() {
        let categoryId = $(this).val();
        let $subCategorySelect = $('#sub_category_id');
        $subCategorySelect.html('<option value="">-- Select Sub Category --</option>'); // reset

        if (categoryId) {
            $.ajax({
                url: '{{ route('category.subcategories') }}',
                type: 'POST',
                data: {
                    category_id: categoryId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $.each(response, function(index, sub) {
                        $subCategorySelect.append(
                            `<option value="${sub.id}">${sub.name}</option>`);
                    });
                },
                error: function(xhr) {
                    console.error('AJAX Error:', xhr.responseText);
                }
            });
        }
    });
</script>
