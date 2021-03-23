@extends('admin.layouts.main')
@section('content')
@php
    /** @var \App\Models\Publication[] $publications  */
@endphp
    <h1 class="h3 mb-2 text-gray-800">List publications</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('admin.publication.create') }}" class="m-0 font-weight-bold text-primary">Create publications</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Test</th>
                            <th>Publication</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach($publications as $publication)
                            <tr>
                                <td>{{ $publication->title }}</td>
                                <td>{{ $publication->text }}</td>
                                <td>{{ $publication->published ? 'Yes' : 'No' }}</td>
                                <td>
                                    <form action="{{ route('admin.publication.destroy', [
                                            'publication' => $publication
                                        ]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('admin.publication.edit', [
                                            'publication' => $publication
                                        ]) }}">
                                            <i class="fa fa-gavel" aria-hidden="true"></i>
                                        </a>
                                        <button>
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                        <a href="{{ route('admin.publication.show', [
                                            'publication' => $publication,
                                        ]) }}">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
@prepend('pageScripts')
{{--    <script src="{{ asset('assets/admin/js/datatables-demo.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/admin/js/dataTables.bootstrap4.min.js') }}"></script>--}}
@endprepend
