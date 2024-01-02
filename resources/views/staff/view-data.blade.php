{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
<div class="container">
    <h2>Submitted Data</h2>

    @foreach ($unitSpecificData as $key => $value)
        <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong></p>

        @if (is_string($value) &&
                (Str::endsWith($value, '.png') ||
                    Str::endsWith($value, '.jpg') ||
                    Str::endsWith($value, '.jpeg') ||
                    Str::endsWith($value, '.gif')))
            <img style="max-width: 500px; height: auto;" src="{{ asset('storage/' . $value) }}" alt="{{ $key }}"
                class="img-fluid">
        @else
            <p>{{ $value }}</p>
        @endif

        <hr>
    @endforeach
</div>
{{-- @endsection --}}
