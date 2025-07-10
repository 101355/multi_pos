<x-edit-button href="{{ route('warehouse.edit', $warehouse->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('warehouse.destroy', $warehouse->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
