<div>

    <h1>Changes Attributes</h1>
    @foreach($publication->getAttributes() as $attribute => $value)

        <p>{{ $attribute }}: {{ $value }}</p>

    @endforeach

</div>
