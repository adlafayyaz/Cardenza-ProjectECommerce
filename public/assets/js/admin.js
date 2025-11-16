/* JavaScript untuk dashboard Admin */
document.addEventListener('DOMContentLoaded', () => {
    // Konfirmasi sebelum menghapus item
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function (event) {
            if (!confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                event.preventDefault();
            }
        });
    });
});
