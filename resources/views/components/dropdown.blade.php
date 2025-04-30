<select name="{{ $data_category }}" id="{{ $data_category }}">
    @php
        // Use base label depending on normalized category
        $label = match($data_category) {
            'ps_no', 'left_ps_no', 'right_ps_no' => 'PS No.',
            'incubator_no' => 'Incubator No.',
            'hatcher_no' => 'Hatcher No.',
            'house_no' => 'House No.',
            default => ucfirst(str_replace('_', ' ', $data_category)),
        };

        $selectedValue = old($data_category, $data_value ?? session("form_data.$data_category", ''));
    @endphp

    <option value="">Select {{ $label }}</option>
    @foreach($data_values as $data_value)
        <option value="{{ $data_value }}" {{ $selectedValue == $data_value ? 'selected' : '' }}>
            {{ $data_value }}
        </option>
    @endforeach
</select>