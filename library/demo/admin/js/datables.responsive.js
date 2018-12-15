 "use strict";
$(document).on('ready', function() {
$('#dataTables-example').DataTable({
			responsive: true,
			pageLength:6,
			sPaginationType: "full_numbers",
			oLanguage: {
					oPaginate: {
							sFirst: "<<",
							sPrevious: "<",
							sNext: ">", 
							sLast: ">>" 
					}
			}
	});
});