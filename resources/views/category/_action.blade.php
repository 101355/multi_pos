<x-edit-button href="{{ route('category.edit', $category->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('category.destroy', $category->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
