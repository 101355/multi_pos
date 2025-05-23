import "./bootstrap";

import Alpine from "alpinejs";
import Swal from "sweetalert2/dist/sweetalert2.js";

window.Swal = Swal;
window.Alpine = Alpine;

window.deleteDialog = Swal.mixin({
    title: "Are you sure, you want to delete?",
    icon: "error",
    customClass: {
        confirmButton: "btn btn-danger",
        cancelButton: "btn btn-secondary",
    },
    reverseButtons: true,
    showCancelButton: true,
    cancelButtonText: "Cancel",
    confirmButtonText: "Confirm",
    buttonsStyling: false,
});

Alpine.start();
