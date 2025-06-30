<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('.ajax-form').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var isMultipart = form.attr('enctype') === 'multipart/form-data';
        var ajaxOptions = {
            url: form.attr('action'),
            type: form.attr('method') || 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message || 'Operation successful!',
                    confirmButtonColor: '#3085d6',
                });
                form[0].reset();
            },
            error: function(xhr) {
                let msg = 'An error occurred.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    msg += '\n' + Object.values(xhr.responseJSON.errors).join('\n');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: msg,
                    confirmButtonColor: '#d33',
                });
            }
        };
        if (isMultipart) {
            var formData = new FormData(form[0]);
            ajaxOptions.data = formData;
            ajaxOptions.processData = false;
            ajaxOptions.contentType = false;
        } else {
            ajaxOptions.data = form.serialize();
        }
        $.ajax(ajaxOptions);
    });
});
</script>
