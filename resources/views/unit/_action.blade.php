<x-edit-button href="{{ route('unit.edit', $unit->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('unit.destroy', $unit->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
