@php $editing = isset($hostProfile) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="name"
            label="Name"
            value="{{ old('name', ($editing ? $hostProfile->name : '')) }}"
            maxlength="255"
            placeholder="Name"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="age"
            label="Age"
            value="{{ old('age', ($editing ? $hostProfile->age : '')) }}"
            maxlength="255"
            placeholder="Age"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="mobile"
            label="Mobile"
            value="{{ old('mobile', ($editing ? $hostProfile->mobile : '')) }}"
            maxlength="255"
            placeholder="Mobile"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            value="{{ old('email', ($editing ? $hostProfile->email : '')) }}"
            maxlength="255"
            placeholder="Email"
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="gender"
            label="Gender"
            value="{{ old('gender', ($editing ? $hostProfile->gender : '')) }}"
            maxlength="255"
            placeholder="Gender"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <div
            x-data="imageViewer('{{ $editing && $hostProfile->photo ? \Storage::url($hostProfile->photo) : '' }}')"
        >
            <x-inputs.partials.label
                name="photo"
                label="Photo"
            ></x-inputs.partials.label
            ><br />

            <!-- Show the image -->
            <template x-if="imageUrl">
                <img
                    :src="imageUrl"
                    class="object-cover rounded border border-gray-200"
                    style="width: 100px; height: 100px;"
                />
            </template>

            <!-- Show the gray box when image is not available -->
            <template x-if="!imageUrl">
                <div
                    class="border rounded border-gray-200 bg-gray-100"
                    style="width: 100px; height: 100px;"
                ></div>
            </template>

            <div class="mt-2">
                <input
                    type="file"
                    name="photo"
                    id="photo"
                    @change="fileChosen"
                />
            </div>

            @error('photo') @include('components.inputs.partials.error')
            @enderror
        </div>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="fans_count"
            label="Fans Count"
            value="{{ old('fans_count', ($editing ? $hostProfile->fans_count : '')) }}"
            maxlength="255"
            placeholder="Fans Count"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="followup_count"
            label="Followup Count"
            value="{{ old('followup_count', ($editing ? $hostProfile->followup_count : '')) }}"
            maxlength="255"
            placeholder="Followup Count"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="visitor_count"
            label="Visitor Count"
            value="{{ old('visitor_count', ($editing ? $hostProfile->visitor_count : '')) }}"
            maxlength="255"
            placeholder="Visitor Count"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="firebase_id"
            label="Firebase Id"
            value="{{ old('firebase_id', ($editing ? $hostProfile->firebase_id : '')) }}"
            maxlength="255"
            placeholder="Firebase Id"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token_rate_videocall"
            label="Token Rate Videocall"
            value="{{ old('token_rate_videocall', ($editing ? $hostProfile->token_rate_videocall : '')) }}"
            maxlength="255"
            placeholder="Token Rate Videocall"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="token_rate_groupcall"
            label="Token Rate Groupcall"
            value="{{ old('token_rate_groupcall', ($editing ? $hostProfile->token_rate_groupcall : '')) }}"
            maxlength="255"
            placeholder="Token Rate Groupcall"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $hostProfile->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
