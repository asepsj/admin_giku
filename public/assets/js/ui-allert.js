'use strict';

document.addEventListener('DOMContentLoaded', function() {
    let deleteForm;
    const deleteButtons = document.querySelectorAll('.delete-button');
    const confirmDeleteButton = document.getElementById('confirmDeleteButton');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            deleteForm = this.closest('form');
            const confirmDeleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
            confirmDeleteModal.show();
        });
    });

    confirmDeleteButton.addEventListener('click', function() {
        deleteForm.submit();
    });
});