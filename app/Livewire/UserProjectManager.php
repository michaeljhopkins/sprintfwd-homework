<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class UserProjectManager extends Component
{
    public $name;
    public $projects;

    public $projectBeingDeleted = null;
    public bool $confirmingProjectDeletion = false;

    public function mount()
    {
        $this->projects = auth()->user()->projects;
    }

    public function submit()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'name' => 'required|string|max:255'
        ]);

        $project = Project::create(['name' => $this->name]);

        auth()->user()->projects()->attach($project);

        $this->name = '';
        $this->projects = auth()->user()->projects;
    }

    public function confirmProjectDeletion($id)
    {
        $this->confirmingProjectDeletion = true;

        $this->projectBeingDeleted = $id;
    }

    public function deleteProject()
    {
        $this->projects->where('id', $this->projectBeingDeleted)->first()->delete();

        $this->projects = auth()->user()->projects;

        $this->confirmingProjectDeletion = false;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.user-project-manager', [
            'projects' => auth()->user()->projects
        ]);
    }
}
