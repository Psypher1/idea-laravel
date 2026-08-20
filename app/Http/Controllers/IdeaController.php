<?php

namespace App\Http\Controllers;

use App\Actions\CreateIdea;
use App\Http\Requests\IdeaRequest;
use App\Http\Requests\StoreIdeaRequest;
use App\Http\Requests\UpdateIdeaRequest;
use App\IdeaStatus;
use App\Models\Idea;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        // ->where('status', request('status', 'all'))
        $user = Auth::user();

        $status = $request->status;

        if (!in_array($status, IdeaStatus::values())) {
            $status = null;
        }

        $ideas = $user
            ->ideas()
            ->when($request->status, fn($query, $status) => $query->where('status', $status))
            ->latest()
            ->get();

        // $statusCounts = Idea::query()->selectRaw('status, count(*) as count')->groupBy('status')->get();

        // MOVED To MODEL
        // $counts = Auth::user()->ideas()->selectRaw('status, count(*) as count')->groupBy('status')->pluck('count', 'status');

        // $statusCounts = collect(IdeaStatus::cases())->mapWithKeys(fn($status) => [
        //     $status->value => $counts->get($status->value, 0)
        // ])->put('all', Auth::user()->ideas->count());

        return view('idea.index', ['ideas' => $ideas, 'statusCounts' => Idea::statusCounts($user)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IdeaRequest $request, CreateIdea $action)
    {
        // dd($request->safe()->except('steps'));
        // dd($request->steps);
        // dd($request->all());

        // $idea = Auth::user()->ideas()->create($request->safe()->except(['steps', 'image']));
        // $idea->steps()->createMany(
        //     collect($request->steps)->map(fn($step) => ['description' => $step])
        // );

        // $imagePath = $request->image->store('ideas', 'public');

        // $idea->update(['image_path' => $imagePath]);

        // dd($request->safe()->all());
        $action->handle($request->safe()->all());

        return to_route('idea.index')->with('success', 'Your idea has been created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Idea $idea)
    {
        // METHOD 1: in Controller
        Gate::authorize('workWith', $idea);

        return view('idea.show', ['idea' => $idea]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(IdeaRequest $request, Idea $idea)
    {
        dd($request->all());
        Gate::authorize('workWith', $idea);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Idea $idea)
    {
        // authorise that this is allowed
        Gate::authorize('workWith', $idea);
        $idea->delete();

        // return redirect()->route('idea.index');
        // return redirect('/ideas');
        return to_route('idea.index');
    }
}
