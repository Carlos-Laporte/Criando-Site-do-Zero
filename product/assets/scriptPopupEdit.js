$(document).ready(function () {
 
    // ── EDIT ──────────────────────────────────────────────────────────────────
    $(document).on('click', '.editBtn', function () {
 
        const userId    = $(this).data('id');
        const firstName = $(this).data('first');
        const lastName  = $(this).data('last');
        const email     = $(this).data('email');
 
        Swal.fire({
            title: 'Edit User',
            html: `
                <input id="swalFirst"    class="swal2-input" placeholder="First Name"         value="${firstName}">
                <input id="swalLast"     class="swal2-input" placeholder="Last Name"          value="${lastName}">
                <input id="swalEmail"    class="swal2-input" type="email" placeholder="Email" value="${email}">
                <input id="swalPassword" class="swal2-input" type="password" placeholder="New Password (optional)">
            `,
            confirmButtonText: 'Save',
            showCancelButton: true,
            preConfirm: () => {
                return {
                    first_name : document.getElementById('swalFirst').value,
                    last_name  : document.getElementById('swalLast').value,
                    email      : document.getElementById('swalEmail').value,
                    password   : document.getElementById('swalPassword').value,
                };
            }
        }).then((result) => {
            if (!result.isConfirmed) return;
 
            const d = result.value;
 
            const params = new URLSearchParams({
                id         : userId,
                first_name : d.first_name,
                last_name  : d.last_name,
                email      : d.email,
                password   : d.password
            });
 
            fetch('../ajax/update_user.php', {
                method  : 'POST',
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
                body    : params.toString()
            })
            .then(r => r.text())
            .then(() => {
                Swal.fire('Updated!', 'User updated successfully.', 'success')
                    .then(() => location.reload());
            })
            .catch(() => {
                Swal.fire('Error', 'Could not update user.', 'error');
            });
        });
    });
 
    // ── DELETE ────────────────────────────────────────────────────────────────
    $(document).on('click', '.deleteBtn', function () {
 
        const userId = $(this).data('id');
 
        Swal.fire({
            title: 'Delete user?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete'
        }).then((result) => {
            if (!result.isConfirmed) return;
 
            fetch('../ajax/delete_user.php', {
                method  : 'POST',
                headers : { 'Content-Type': 'application/x-www-form-urlencoded' },
                body    : `id=${userId}`
            })
            .then(r => r.text())
            .then(() => {
                Swal.fire('Deleted!', 'User removed successfully.', 'success')
                    .then(() => location.reload());
            })
            .catch(() => {
                Swal.fire('Error', 'Could not delete user.', 'error');
            });
        });
    });
 
});