@extends('admin.layouts.main')
@section('content')
    @php
        /** @var \App\Models\Publication $publication  */
    @endphp
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Show publication</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                        @foreach($publication->getAttributes() as $attribute => $value)
                            <tr>
                                <td>{{ $attribute }}</td>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
