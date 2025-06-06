@extends('layouts.app')

@section('title', 'Unit')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">Unit</h4>
                    </div>
                </div>
                <div class="">
                    <x-create-button href="{{ route('unit.create') }}"><i
                            class="fas fa-plus-circle">Create</i></x-create-button>
                </div>
            </div>
            <!-- end page title -->

            <x-flash-message></x-flash-message>
            <x-success-message></x-success-message>
            <x-error-message></x-error-message>

            <div class="row">
                <x-card class="tw-pb-5">
                    <table class="table table-bordered Datatable-tb">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Date</th>
                                <th class="text-center no-sort no-search">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </x-card>
            </div>
            <!-- end row -->

        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            var table = new DataTable('.Datatable-tb', {
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('unit-datatable') }}",
                    data: function(d) {

                    }
                },
                columns: [{
                        data: 'responsive-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'name',
                        class: 'text-center'
                    },
                    {
                        data: 'created_at',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        class: 'text-center'
                    }
                ],
                order: [
                    [2, 'desc']
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                },
                columnDefs: [{
                        targets: 'no-sort',
                        orderable: false
                    },
                    {
                        targets: 'no-search',
                        searchable: false
                    },
                    {
                        targets: 0,
                        orderable: false,
                        searchable: false,
                        className: 'control',
                    }
                ],
            });

            $(document).on('click', '.delete-button', function(event) {
                event.preventDefault();

                var url = $(this).data('url');

                deleteDialog.fire().then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            method: 'DELETE',
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: 'Data has been deleted successfully.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        })
                    }
                });
            })
        })
    </script>
@endpush
