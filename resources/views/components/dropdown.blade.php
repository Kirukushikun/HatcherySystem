<select name="{{ $data_category }}" id="{{ $data_category }}">
    <option value="">Select an option</option>
    @foreach($data_values as $data_value)
        <option value="{{ $data_value }}" 
            {{ old($data_category, session("form_data.$data_category", '')) == $data_value ? 'selected' : '' }}>
            {{ $data_value }}
        </option>
    @endforeach
</select>
