<?php

namespace App\Livewire;

use App\Models\Project;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ProjectSearch extends Component
{
    public $search = '';
    public $suggestions = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            return $this->suggestions = [];
        }

        $this->suggestions = Project::search($this->search)
            ->options([
                "query_by" => "full_name,description"
            ])
            ->take(5)
            ->get();
    }

    public function selectSearchTerm(int $projectId)
    {
        $project = Project::find($projectId);

        $this->search = $project->name;

        $this->suggestions = [];
    }

    public function render()
    {
        return view('livewire.project-search');
    }
}
