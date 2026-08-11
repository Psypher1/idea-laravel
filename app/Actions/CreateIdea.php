<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateIdea
{
    public function handle(array $attributes, User $user = null): void
    {
        /**
         * @var User
         */
        $user ??= Auth::user();

        $data = collect($attributes)->only([
            'title',
            'description',
            'status',
            'links',
        ])->toArray();

        if ($attributes['image'] ?? false) {
            $data['image_path'] = $attributes['image']->store('ideas', 'public');
        }

        // in the tutorial, jeffery didn't have attributes in this closure, thereby making steps to not get added
        DB::transaction(function () use ($data, $user, $attributes) {
            $idea = $user->ideas()->create($data);

            $steps = collect($attributes['steps'] ?? [])->map(fn($step) => ['description' => $step]);

            $idea->steps()->createMany(
                $steps
            );
        });
    }

}

