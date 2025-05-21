@extends('layouts.app')

@section('title', 'User Role')

@section('content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="tw-flex tw-justify-between tw-items-center">
                <div class="tw-flex tw-justify-between tw-items-center">
                    <div class="page-title-box">
                        <h4 class="page-title">User Role</h4>
                    </div>
                </div>
                <div class="">
                    <x-create-button href="{{ route('admin-user.create') }}"><i
                            class="fas fa-plus-circle">Create</i></x-create-button>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <x-card>
                    <table class="table table-bordered Datatable-tb">
                        <thead>
                            <tr>
                                <th class="text-center"></th>
                                <th class="text-center">Name</th>
                                <td class="text-center">Date</td>
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
            new DataTable('.Datatable-tb', {
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('user-role-datatable') }}",
                    data: function(d) {

                    }
                },
                columns: [{
                        data: 'responsive-icon',
                        class: 'text-center control'
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
                columnDefs: [{
                        targets: 'no-sort',
                        orderable: false
                    },
                    {
                        targets: 'no-search',
                        searchable: false
                    }
                ],
                responsive: {
                    details: {
                        type: 'column',
                        target: 0
                    }
                }
            });
        })
    </script>
@endpush
