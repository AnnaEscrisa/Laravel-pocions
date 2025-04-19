
function openDeleteModal(ruta, item) {
  document.getElementById('modal-item').textContent = item;
  document.getElementById('modal-delete-link').href = ruta;

  const modal = new bootstrap.Modal(document.getElementById('modal-delete'));
  modal.show();
}

function openCloneModal(id) {
  const existingModal = bootstrap.Modal.getInstance(document.getElementById('modal-clone'));
  if (existingModal) {
    existingModal.dispose();
  }
  document.getElementById('modal-article-id').value = id;
  const formData = new FormData(document.getElementById('codeForm'));
  $.ajax({
    url: 'qr?article=true',
    type: 'POST',
    data: Object.fromEntries(formData),
    success: function (response) {
      $("#modal-qr").html(response);
    },
  });

  const modal = new bootstrap.Modal(document.getElementById('modal-clone'));

  modal.show();
}