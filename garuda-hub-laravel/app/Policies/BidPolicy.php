<?php
// NIM: 252410102107

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;

class BidPolicy
{
    /**
     * Hanya klien pemilik proyek yang boleh memberi rating,
     * hanya untuk bid pemenang, dan hanya sekali per bid.
     */
    public function rate(User $user, Bid $bid): bool
    {
        return $bid->is_winner
            && $user->id === $bid->project->client_id
            && ! $bid->rating()->exists();
    }
}
