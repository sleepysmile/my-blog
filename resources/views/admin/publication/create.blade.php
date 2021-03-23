@extends('admin.layouts.main')
@section('content')
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create publication</h6>
        </div>
        <div class="card-body">
            @include('admin.publication._form', [
                'publication' => null
            ])
        </div>
    </div>
@stop
