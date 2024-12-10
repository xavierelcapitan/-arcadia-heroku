// Public/assets/js/datatables_setup.js

$(document).ready(function() {
  $('#veterinaryReportsTable').DataTable({
      "paging": true,
      "searching": true,
      "order": [[ 1, "desc" ]]  // Tri par date décroissante
  });
});
