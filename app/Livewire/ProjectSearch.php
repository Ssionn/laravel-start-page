<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Scout\Scout;
use Livewire\Attributes\On;
use Livewire\Component;

class ProjectSearch extends Component
{
    public $title = 'Search all repositories';
    public $description = 'Index of all of your repositories you have access to';
    public $search = '';
    public $suggestions = [];

    public function updatedSearch(): array|Collection
    {
        if (strlen($this->search) < 1) {
            return $this->suggestions = [];
        }

        return $this->suggestions = Project::search($this->search)
            ->options([
                "query_by" => "name,full_name"
            ])
            ->take(5)
            ->get();
    }

    public function selectSearchTerm(int $projectId): void
    {
        $project = Project::find($projectId);

        $this->search = $project->name;

        $this->suggestions = [];
    }

    #[On('reIndexScout')]
    public function reIndexScout(): void
    {
        Scout::removeFromSearchUsing(Project::class);

        Scout::makeSearchableUsing(Project::all());
    }

    public function render(): View
    {
        return view('livewire.project-search');
    }
}
