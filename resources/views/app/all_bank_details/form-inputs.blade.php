@php $editing = isset($bankDetails) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $bankDetails->name : '')) }}"
            maxlength="255"
            placeholder="Full Name"
        ></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="address"
            label="Address"
            value="{{ old('address', ($editing ? $bankDetails->address : '')) }}"
            maxlength="225"
            placeholder="Address"
        ></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="mobile"
            label="Mobile Number"
            value="{{ old('mobile', ($editing ? $bankDetails->mobile : '')) }}"
            placeholder="Mobile Number"
        ></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $bankDetails->email : '')) }}"
            maxlength="225"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="account_no"
            label="Account Number"
            value="{{ old('account_no', ($editing ? $bankDetails->account_no : '')) }}"
            maxlength="225"
            placeholder="Account Number"
        ></x-inputs.number>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="ifsc"
            label="IFSC"
            value="{{ old('ifsc', ($editing ? $bankDetails->ifsc : '')) }}"
            maxlength="225"
            placeholder="IFSC"
        ></x-inputs.text>
    </x-inputs.group>
     <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="upiid_1"
            label="UPIID_1"
            value="{{ old('upiid_1', ($editing ? $bankDetails->upiid_1 : '')) }}"
            maxlength="225"
            placeholder="UPIID"
        ></x-inputs.text>
    </x-inputs.group> 
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="upiid_2"
            label="UPIID_2"
            value="{{ old('upiid_2', ($editing ? $bankDetails->upiid_2 : '')) }}"
            maxlength="225"
            placeholder="UPIID_2"
        ></x-inputs.text>
    </x-inputs.group>
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="host_profile_id" label="Host Profile" required>
            @php $selected = old('host_profile_id', ($editing ? $bankDetails->host_profile_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Host Profile</option>
            @foreach($hostProfiles as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
