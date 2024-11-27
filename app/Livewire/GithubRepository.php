<?php

namespace App\Livewire;

use App\Jobs\UserRepos;
use App\Models\Project;
use Illuminate\Contracts\View\View;
use Laravel\Scout\Scout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class GithubRepository extends Component
{
    use WithPagination;

    public $title = 'Recent Repositories';
    public $description = '*Loading project may take a while so be patient!';

    #[On('refreshData')]
    public function loadRepos(): void
    {
        UserRepos::dispatch(auth()->user()->username, auth()->user()->id)->onConnection('sync');

        Scout::makeSearchableUsing(Project::class);
    }

    public function render(): View
    {
        return view('livewire.github-repository', [
            'repos' => Project::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(5),
        ]);
    }
}
