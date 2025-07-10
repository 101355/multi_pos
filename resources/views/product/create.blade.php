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
                        <form method="post" action="{{ route('product.store') }}" class="tw-mt-6 tw-space-y-6"
                            id="submit">
                            @csrf

                            <div class="row">
                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="product_name" value="Product Name" />
                                    <x-text-input id="product_name" name="item_name" type="text"
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
                                    <x-select-input name="category" id="category_id" class="tw-mt-1 tw-block tw-w-full">
                                        <option value="">-- Select Category --</option>

                                    </x-select-input>
                                </div>

                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="sub_category_id" value="Sub Category" />
                                    <x-select-input name="sub_category" id="sub_category_id"
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


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="item_type" value="Item Type" />
                                    <x-select-input name="item_type" id="item_type" class="tw-mt-1 tw-block tw-w-full">
                                        <option value="">-- Select Item Type --</option>
                                        <option value="Stock">Stock</option>
                                        <option value="Service">Service</option>
                                    </x-select-input>
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="quantity" value="Quantity" />
                                    <x-text-input id="quantity" name="quantity" type="number"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('quantity')" step="any" />
                                </div>


                                <div class="form-group col-lg-4 mb-1">
                                    <x-input-label for="alert_quantity" value="Alert Quantity" />
                                    <x-text-input id="alert_quantity" name="alert_quantity" type="number"
                                        class="tw-mt-1 tw-block tw-w-full" :value="old('quantity')" step="any" />
                                </div>

                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Name</th>
                                            <th>Purchase Price</th>
                                            <th>Wholesale Price</th>
                                            <th>Retail Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <x-text-input id="unit1" name="unit1" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" value="1" step="any"
                                                    readonly />
                                            </td>
                                            <td>
                                                <x-select-input name="name1" id="name1"
                                                    class="tw-mt-1 tw-block tw-w-full">
                                                    <option value="">-- Select Unit --</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach

                                                </x-select-input>
                                            </td>
                                            <td>
                                                <x-text-input id="purchase_price1" name="purchase_price1" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('purchase_price1')" style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="wholesale_price1" name="wholesale1" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('wholesale_price1')" style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="retail_price1" name="retail1" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('retail_price1')" style="any" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>

                                                <x-text-input id="unit2" name="unit2" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('unit2')"
                                                    step="any" />
                                            </td>
                                            <td>
                                                <x-select-input name="name2" id="name2"
                                                    class="tw-mt-1 tw-block tw-w-full">
                                                    <option value="">-- Select Unit --</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach

                                                </x-select-input>
                                            </td>
                                            <td>
                                                <x-text-input id="purchase_price2" name="purchase_price2" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('purchase_price2')"
                                                    style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="wholesale_price2" name="wholesale2" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('wholesale_price2')"
                                                    style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="retail_price2" name="retail2" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('retail_price2')"
                                                    style="any" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <x-text-input id="unit3" name="unit3" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('unit3')"
                                                    step="any" />
                                            </td>
                                            <td>
                                                <x-select-input name="name3" id="name3"
                                                    class="tw-mt-1 tw-block tw-w-full">
                                                    <option value="">-- Select Unit --</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                                    @endforeach

                                                </x-select-input>
                                            </td>
                                            <td>
                                                <x-text-input id="purchase_price3" name="purchase_price3" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('purchase_price3')"
                                                    style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="wholesale_price3" name="wholesale3" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('wholesale_price3')"
                                                    style="any" />
                                            </td>
                                            <td>
                                                <x-text-input id="retail_price3" name="retail3" type="number"
                                                    class="tw-mt-1 tw-block tw-w-full" :value="old('retail_price3')"
                                                    style="any" />
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>


                            </div>


                            <div class="tw-flex tw-justify-center tw-items-center tw-gap-4">
                                <x-confirm_button>{{ __('Confirm') }}</x-confirm_button>
                                <x-cancel_button
                                    href="{{ route('category.index') }}">{{ __('Cancel') }}</x-cancel_button>
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
    {!! JsValidator::formRequest('App\Http\Requests\ProductRequest', '#submit') !!}
@endpush
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#warehouse_id').on('change', function() {
            var warehouseId = $(this).val();

            $('#category_id').empty().append('<option value="">-- Select Category --</option>');

            if (warehouseId) {
                $.ajax({
                    url: '{{ route('product.get_category') }}',
                    type: 'POST',
                    data: {
                        warehouse_id: warehouseId,
                        _token: $('meta[name="csrf-token"]').attr(
                            'content') // include CSRF token
                    },
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#category_id').append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });



        $('#category_id').on('change', function() {
            var category_id = $(this).val();

            $('#sub_category_id').empty().append('<option value="">-- Select Sub Category --</option>');

            if (category_id) {
                $.ajax({
                    url: '{{ route('product.get_subcategory') }}',
                    type: 'POST',
                    data: {
                        category_id: category_id,
                        _token: $('meta[name="csrf-token"]').attr(
                            'content') // include CSRF token
                    },
                    success: function(data) {
                        $.each(data, function(key, value) {
                            $('#sub_category_id').append(
                                '<option value="' + value.id + '">' + value
                                .name + '</option>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
