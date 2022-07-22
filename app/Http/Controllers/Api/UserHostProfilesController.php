<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\HostProfileResource;
use App\Http\Resources\HostProfileCollection;

class UserHostProfilesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $hostProfiles = $user
            ->hostProfiles()
            ->search($search)
            ->latest()
            ->paginate();

        return new HostProfileCollection($hostProfiles);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', HostProfile::class);

        $validated = $request->validate([
            'name' => ['nullable', 'max:255', 'string'],
            'age' => ['nullable', 'max:255', 'string'],
            'mobile' => ['nullable', 'max:255', 'string'],
            'email' => ['nullable', 'email'],
            'gender' => ['nullable', 'max:255', 'string'],
            'photo' => ['nullable', 'file'],
            'fans_count' => ['nullable', 'max:255', 'string'],
            'followup_count' => ['nullable', 'max:255', 'string'],
            'visitor_count' => ['nullable', 'max:255', 'string'],
            'firebase_id' => ['nullable', 'max:255', 'string'],
            'token_rate_videocall' => ['nullable', 'max:255', 'string'],
            'token_rate_groupcall' => ['nullable', 'max:255', 'string'],
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('public');
        }

        $hostProfile = $user->hostProfiles()->create($validated);

        return new HostProfileResource($hostProfile);
    }
}
