<?php

namespace App\Jobs;

use App\Models\Membership;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateMembership implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected User $user;
    protected Organization $organization;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user, Organization $organization)
    {
        $this->user = $user;
        $this->organization = $organization;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Membership::create([
            'user_id' => $this->user->id,
            'organization_id' => $this->organization->id,
            'start_at' => Carbon::now(),
        ]);

        // @todo Dispatch event
    }
}
