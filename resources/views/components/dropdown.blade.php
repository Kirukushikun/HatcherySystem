<select name="{{ $data_category }}" id="{{ $data_category }}">
    @php
        $category = "";
        switch($data_category) {
            case "ps_no": 
                $category = "PS No."; 
                break;

            case "incubator_no":
                $category = "Incubator No."; 
                break;

            case "hatcher_no":
                $category = "Hatcher No.";
                break;

            case "house_no":
                $category = "House No."; 
                break;
        }
    @endphp
    <option value="">Select {{ $category }}</option>
    @foreach($data_values as $data_value)
        <option value="{{ $data_value }}" 
            {{ old($data_category, session("form_data.$data_category", '')) == $data_value ? 'selected' : '' }}>
            {{ $data_value }}
        </option>
    @endforeach
</select>
