<div>

    <x-form-section submit="submit">
        <x-slot name="title">
            {{ __('Create Project') }}
        </x-slot>

        <x-slot name="description">
            {{ __('The name of your new project.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" type="text" class="mt-1 block w-full" wire:model="name" autofocus />
                @error('name')
                    <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                <@enderror
            </div>

        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="created">
                {{ __('Created.') }}
            </x-action-message>

            <x-button>
                {{ __('Create') }}
            </x-button>
        </x-slot>
    </x-form-section>

    @if (auth()->user()->projects->isNotEmpty())
        <x-section-border />

        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Manage Projects') }}
                </x-slot>

                <x-slot name="description">&nbsp;</x-slot>

                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->projects->sortBy('name') as $project)
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $project->name }}
                                </div>

                                <div class="flex items-center ms-2">
                                    <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="confirmProjectDeletion({{ $project->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Delete Project Confirmation Modal -->
    <x-confirmation-modal wire:model.live="confirmingProjectDeletion">
        <x-slot name="title">
            {{ __('Delete Project') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you would like to delete this project?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingProjectDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3" wire:click="deleteProject" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-danger-button>
        </x-slot>
    </x-confirmation-modal>
</div>
