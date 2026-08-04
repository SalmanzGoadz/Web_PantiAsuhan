{{-- Global SweetAlert2 Flash Message Handler --}}
@if(session('success') || session('error') || session('warning'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            customClass: {
                popup: 'swal2-toast-custom'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: @json(session('success'))
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: @json(session('error'))
            });
        @endif

        @if(session('warning'))
            Toast.fire({
                icon: 'warning',
                title: 'Peringatan',
                text: @json(session('warning'))
            });
        @endif
    });
</script>
@endif
