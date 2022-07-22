@php $editing = isset($withdrawlTransaction) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token"
            label="Token"
            value="{{ old('token', ($editing ? $withdrawlTransaction->token : '')) }}"
            maxlength="255"
            placeholder="Token"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="total_amount"
            label="Total Amount"
            value="{{ old('total_amount', ($editing ? $withdrawlTransaction->total_amount : '')) }}"
            maxlength="255"
            placeholder="Total Amount"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="recieved_amount"
            label="Recieved Amount"
            value="{{ old('recieved_amount', ($editing ? $withdrawlTransaction->recieved_amount : '')) }}"
            maxlength="255"
            placeholder="Recieved Amount"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="commision"
            label="Commision"
            value="{{ old('commision', ($editing ? $withdrawlTransaction->commision : '')) }}"
            maxlength="255"
            placeholder="Commision"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="status"
            label="Status"
            value="{{ old('status', ($editing ? $withdrawlTransaction->status : '')) }}"
            maxlength="255"
            placeholder="Status"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="date"
            label="Date"
            value="{{ old('date', ($editing ? optional($withdrawlTransaction->date)->format('Y-m-d') : '')) }}"
            max="255"
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $withdrawlTransaction->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
