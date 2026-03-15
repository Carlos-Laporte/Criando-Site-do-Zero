const page = "supplier";

const popupTitle  = "Edit Supplier";

const deleteTitle = "Delete supplier?";
const deleteText  = "This supplier will be removed.";

const updateUrl = "../ajax/update.php";
const deleteUrl = "../ajax/delete.php";

const popupFormHtml = `
<input id="swalSupplier" class="swal2-input" placeholder="Supplier Name">
<input id="swalLocation" class="swal2-input" placeholder="Supplier Location">
<input id="swalEmail" class="swal2-input" type="email" placeholder="Email">
`;

function getPopupData(){
    return {
        page: "supplier",
        first_name: document.getElementById("swalSupplier").value,
        last_name: document.getElementById("swalLocation").value,
        email: document.getElementById("swalEmail").value
    };
}