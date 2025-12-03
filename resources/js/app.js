import './bootstrap';
import './color-sync';
import Swal from 'sweetalert2';

// Setup CSRF token for axios
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Setup SweetAlert2 with minimal theme
Swal.mixin({
    customClass: {
        popup: 'minimal-swal-popup',
        confirmButton: 'minimal-swal-confirm',
        cancelButton: 'minimal-swal-cancel',
        title: 'minimal-swal-title',
        htmlContainer: 'minimal-swal-content'
    },
    buttonsStyling: false,
    confirmButtonColor: getComputedStyle(document.documentElement).getPropertyValue('--primary-color') || '#111827',
    cancelButtonColor: '#6b7280'
});

// Setup SweetAlert2
window.Swal = Swal;

// Show success/error messages from session
document.addEventListener('DOMContentLoaded', function() {
    const successMessage = document.getElementById('success-message');
    const errorMessage = document.getElementById('error-message');

    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: successMessage.getAttribute('data-message'),
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'minimal-swal-toast',
                icon: 'minimal-swal-icon'
            }
        });
    }

    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: errorMessage.getAttribute('data-message'),
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'minimal-swal-toast',
                icon: 'minimal-swal-icon'
            }
        });
    }

    // Handle delete confirmations
    document.querySelectorAll('[data-confirm-delete]').forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();
            const url = this.getAttribute('href') || this.closest('form').action;
            const message = this.getAttribute('data-confirm-delete') || 'Apakah Anda yakin ingin menghapus item ini?';

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (this.tagName === 'A') {
                        window.location.href = url;
                    } else {
                        this.closest('form').submit();
                    }
                }
            });
        });
    });

    // Handle form delete confirmations
    document.querySelectorAll('form.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const button = this.querySelector('[data-confirm-delete]');
            const message = button ? button.getAttribute('data-confirm-delete') : 'Apakah Anda yakin ingin menghapus item ini?';

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });

    // Handle form submit confirmations (create/update)
    document.querySelectorAll('form[data-confirm-submit]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const message = this.getAttribute('data-confirm-submit') || 'Apakah Anda yakin ingin menyimpan perubahan?';
            const action = this.getAttribute('data-action') || 'menyimpan';

            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    });
});

// Export for use in other files
export default Swal;
