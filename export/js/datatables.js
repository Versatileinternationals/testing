
$(document).ready(function() {

	var dTable = document.getElementById('dataTable');
	if(dTable){
		$('#dataTable').DataTable();
	}

	var dTables = document.getElementsByClassName('data-table');
	if(dTables){
		$('.data-table').DataTable({
		    "columnDefs": [{ targets: 'no-sort', orderable: false }]

		});
	}

});
