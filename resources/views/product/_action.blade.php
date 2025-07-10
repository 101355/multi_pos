<x-edit-button href="{{ route('product.edit', $product->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('product.destroy', $product->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
