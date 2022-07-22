@php $editing = isset($videoCallTransaction) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="reciever_id"
            label="Reciever Id"
            value="{{ old('reciever_id', ($editing ? $videoCallTransaction->reciever_id : '')) }}"
            maxlength="255"
            placeholder="Reciever Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sender_id"
            label="Sender Id"
            value="{{ old('sender_id', ($editing ? $videoCallTransaction->sender_id : '')) }}"
            maxlength="255"
            placeholder="Sender Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="call_duration"
            label="Call Duration"
            value="{{ old('call_duration', ($editing ? $videoCallTransaction->call_duration : '')) }}"
            maxlength="255"
            placeholder="Call Duration"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token_charge"
            label="Token Charge"
            value="{{ old('token_charge', ($editing ? $videoCallTransaction->token_charge : '')) }}"
            maxlength="255"
            placeholder="Token Charge"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $videoCallTransaction->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
