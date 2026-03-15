const page = "users";

const popupTitle  = "Edit User";

const deleteTitle = "Delete user?";
const deleteText  = "This user will be removed.";

const updateUrl = "../ajax/update.php";
const deleteUrl = "../ajax/delete.php";

const popupFormHtml = `
<input id="swalFirst" class="swal2-input" placeholder="First Name">
<input id="swalLast" class="swal2-input" placeholder="Last Name">
<input id="swalEmail" class="swal2-input" type="email" placeholder="Email">
<input id="swalPassword" class="swal2-input" type="password" placeholder="New Password (optional)">
`;

function getPopupData(){
    return {
        page: "users",
        first_name: document.getElementById("swalFirst").value,
        last_name: document.getElementById("swalLast").value,
        email: document.getElementById("swalEmail").value,
        password: document.getElementById("swalPassword").value
    };
}