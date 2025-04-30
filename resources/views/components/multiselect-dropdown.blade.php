@php
    $fieldName = $data_category;
    $selected = old($fieldName, $selected_values ?? []);
@endphp

@foreach($data_values as $value)
    <option value="{{ $value }}" {{ in_array($value, $selected) ? 'selected' : '' }}>
        {{ $value }}
    </option>
@endforeach
