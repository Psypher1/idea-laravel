<?php

namespace App\Actions;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UpdateIdea
{


    public function handle(array $attributes, Idea $idea): void
    {

        // $user ??= Auth::user();

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
        // DB::transaction(function () use ($data, $user, $attributes) {
        //     $idea = $user->ideas()->create($data);

        //     $steps = collect($attributes['steps'] ?? [])->map(fn($step) => ['description' => $step]);

        //     $idea->steps()->createMany(
        //         $steps
        //     );
        // });
        DB::transaction(function () use ($idea, $data, $attributes) {
            $idea->update($data);

            $idea->steps()->delete();

            $idea->steps()->createMany($attributes['steps'] ?? []);
        });
    }

}

