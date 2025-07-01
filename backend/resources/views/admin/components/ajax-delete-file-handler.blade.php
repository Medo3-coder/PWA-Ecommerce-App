<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $(document).on('submit', '.delete-file-form', function(e) {
        e.preventDefault();
        var form = $(this);
        var row = form.closest('tr');
        Swal.fire({
            title: 'Are you sure?',
            text: 'This file will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method') || 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
                    },
                    data: form.serialize(),
                    success: function(response) {
                        Swal.fire('Deleted!', response.message || 'File deleted.', 'success');
                        if(row.length) row.remove();
                    },
                    error: function(xhr) {
                        let msg = 'An error occurred.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = xhr.responseJSON.message;
                        }
                        Swal.fire('Error', msg, 'error');
                    }
                });
            }
        });
    });
});
</script>
