<x-edit-button href="{{ route('role-createPage.edit', $role->id) }}"><i class="fas fa-edit"></i></x-edit-button>
<x-delete-button href="#" class="delete-button" data-url="{{ route('role-createPage.destroy', $role->id) }}"><i
        class="fas fa-trash-alt"></i></x-delete-button>
