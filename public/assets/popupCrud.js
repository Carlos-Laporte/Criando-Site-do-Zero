$(document).ready(function () {

    $(document).on('click', '.editBtn', function () {

        const itemId = $(this).data('id');

        Swal.fire({
            title: popupTitle,   // agora vem da página
            html: popupFormHtml, // formulário muda por página
            confirmButtonText: 'Save',
            showCancelButton: true,

            preConfirm: () => {
                return getPopupData(); // função da página
            }

        }).then((result) => {

            if (!result.isConfirmed) return;

            const params = new URLSearchParams(result.value);

            params.append("id", itemId);

            fetch(updateUrl, {     // URL dinâmica
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: params.toString()
            })
            .then(r => r.text())
            .then(r => {

                if (r.trim() !== 'success') {
                    Swal.fire('Error', 'Could not update.', 'error');
                } else {
                    Swal.fire('Updated!', 'Saved successfully.', 'success')
                    .then(()=>location.reload());
                }

            });

        });

    });


    $(document).on('click', '.deleteBtn', function () {

        const itemId = $(this).data('id');

        Swal.fire({
            title: deleteTitle,
            text: deleteText,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete'
        }).then((result) => {

            if (!result.isConfirmed) return;

            fetch(deleteUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${itemId}&page=${page}`
            })
            .then(r => r.text())
            .then(r => {
                console.log(r);
                if (r.trim() !== 'deleted') {
                    Swal.fire('Error', 'Could not delete.', 'error');
                } else {
                    Swal.fire('Deleted!', 'Removed successfully.', 'success')
                    .then(()=>location.reload());
                }

            });

        });

    });

});