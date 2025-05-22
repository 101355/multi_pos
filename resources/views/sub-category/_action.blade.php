<x-edit-button href="{{ route('sub-category.edit', $sub_category->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('sub-category.destroy', $sub_category->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
