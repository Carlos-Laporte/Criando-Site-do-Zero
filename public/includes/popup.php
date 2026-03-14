<?php if(!empty($sucess_message)) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '<?= $sucess_message ?>',
            confirmButtonColor: '#3085d6'
        });
    </script>
<?php } ?>

<?php if(!empty($error_message)) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '<?= $error_message ?>',
            confirmButtonColor: '#d33'
        });
    </script>
<?php } ?>