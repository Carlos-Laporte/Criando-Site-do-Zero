const page = "products";

const popupTitle  = "Edit Product";

const deleteTitle = "Delete product?";
const deleteText  = "This product will be removed.";

const updateUrl = "../ajax/update.php";
const deleteUrl = "../ajax/delete.php";

const popupFormHtml = `
<input id="swalProduct" class="swal2-input" placeholder="Product Name">
<input id="swalCodigo" class="swal2-input" placeholder="Product Code">
<input id="swalComment" class="swal2-input" placeholder="Comment">
`;

function getPopupData(){
    return {
        page: "products",
        product_name: document.getElementById("swalProduct").value,
        codigo: document.getElementById("swalCodigo").value,
        comment: document.getElementById("swalComment").value
    };
}