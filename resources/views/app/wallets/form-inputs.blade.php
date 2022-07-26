@php $editing = isset($wallet) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token"
            label="Token"
            value="{{ old('token', ($editing ? $wallet->token : '')) }}"
            maxlength="255"
            placeholder="Token"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="free_token"
            label="Free Token"
            value="{{ old('free_token', ($editing ? $wallet->free_token : '')) }}"
            maxlength="255"
            placeholder="Free Token"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $wallet->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
