<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class UserProjectManager extends Component
{
    public Project $project;

    protected $rules = [
        'project.name' => 'required|string|max:255'
    ];
    public $projectBeingDeleted = null;
    public bool $confirmingProjectDeletion = false;

    public function submit()
    {
        $this->resetErrorBag();

        $this->validate();

        $this->project->save();
    }

    public function confirmProjectDeletion($id)
    {
        $this->confirmingProjectDeletion = true;

        $this->projectBeingDeleted = $id;
    }

    public function deleteProject()
    {
        auth()->user()->projects()->where('id', $this->projectBeingDeleted)->first()->delete();


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
