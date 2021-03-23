@php
    /** @var \App\Models\Publication $publication  */
@endphp
<form action="{{ $publication ? route('admin.publication.update', ['publication' =>$publication]) : route('admin.publication.store') }}" method="post">
    @csrf
    @if($publication)
        @method('PUT')
    @endif
    <div class="mb-1 small">Image</div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" value="{{ $publication ? $publication->image : '' }}"
               placeholder="image" name="image">
        @error('image')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 small">Title</div>
    <div class="form-group">
        <input type="text" class="form-control form-control-user" value="{{ $publication ? $publication->title : '' }}"
               placeholder="Title" name="title">
        @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 small">Text</div>
    <div class="form-group">
        <textarea name="text" class="form-control form-control-user" cols="30" rows="10" placeholder="Text">
            {!! $publication ? $publication->text : '' !!}
        </textarea>
        @error('text')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-1 small">Published</div>
    <div class="form-group">
        <select class="form-control form-control-user"  name="published" >
            <option value="1" {{ $publication ? $publication->published ? 'selected="selected"' : '' : '' }}>Да</option>
            <option value="0" {{ $publication ? $publication->published ? '' : 'selected="selected"' : '' }}>Нет</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success btn-user btn-block">
        Save
    </button>
</form>
