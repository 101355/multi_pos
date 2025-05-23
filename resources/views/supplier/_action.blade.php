<x-edit-button href="{{ route('supplier.edit', $supplier->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('supplier.destroy', $supplier->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
