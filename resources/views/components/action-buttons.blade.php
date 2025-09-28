{{-- Action buttons component for consistent styling 
     
     Usage examples:
     
     Edit + Delete:
     <x-action-buttons 
         :editRoute="route('cotisations.edit', $cotisation)" 
         :deleteRoute="route('cotisations.destroy', $cotisation)"
         confirmMessage="Êtes-vous sûr de supprimer cette cotisation ?" />
     
     View + Edit + Delete:
     <x-action-buttons 
         :viewRoute="route('cotisations.show', $cotisation)"
         :editRoute="route('cotisations.edit', $cotisation)" 
         :deleteRoute="route('cotisations.destroy', $cotisation)" />
     
     Edit only:
     <x-action-buttons :editRoute="route('cotisations.edit', $cotisation)" />
--}}

@props(['editRoute' => null, 'deleteRoute' => null, 'viewRoute' => null, 'confirmMessage' => null])

<div class="btn-group" role="group">
    @if($viewRoute)
        <button class="btn btn-sm btn-info" onclick="loadModal('{{ $viewRoute }}')">
            <i class="fas fa-eye"></i>
        </button>
    @endif

    @if($editRoute)
        <button class="btn btn-sm btn-warning" onclick="loadModal('{{ $editRoute }}')">
            <i class="fas fa-pen"></i>
        </button>
    @endif

    @if($deleteRoute)
        @php
            $defaultMessage = __('app.confirm') . ' ?';
            $message = $confirmMessage ?? $defaultMessage;
        @endphp
        <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $deleteRoute }}', '{{ $message }}')">
            <i class="fas fa-trash"></i>
        </button>
    @endif
</div>