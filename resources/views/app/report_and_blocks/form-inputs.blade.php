@php $editing = isset($reportAndBlock) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="blocked_user_id"
            label="Blocked User Id"
            value="{{ old('blocked_user_id', ($editing ? $reportAndBlock->blocked_user_id : '')) }}"
            maxlength="255"
            placeholder="Blocked User Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="blocked_user_name"
            label="Blocked User Name"
            value="{{ old('blocked_user_name', ($editing ? $reportAndBlock->blocked_user_name : '')) }}"
            maxlength="255"
            placeholder="Blocked User Name"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $reportAndBlock->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
