@php $editing = isset($giftTransaction) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="reciever_id"
            label="Reciever Id"
            value="{{ old('reciever_id', ($editing ? $giftTransaction->reciever_id : '')) }}"
            maxlength="255"
            placeholder="Reciever Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="sender_id"
            label="Sender Id"
            value="{{ old('sender_id', ($editing ? $giftTransaction->sender_id : '')) }}"
            maxlength="255"
            placeholder="Sender Id"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="gift_id"
            label="Gift Id"
            value="{{ old('gift_id', ($editing ? $giftTransaction->gift_id : '')) }}"
            maxlength="255"
            placeholder="Gift Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="gift_name"
            label="Gift Name"
            value="{{ old('gift_name', ($editing ? $giftTransaction->gift_name : '')) }}"
            maxlength="255"
            placeholder="Gift Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token"
            label="Token"
            value="{{ old('token', ($editing ? $giftTransaction->token : '')) }}"
            maxlength="255"
            placeholder="Token"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $giftTransaction->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
