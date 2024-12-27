let column_defs = [];

var table2 = $('#subTeamDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: false,
    responsive: true,
    autoWidth: false,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        colVisibility('#subTeamDataTable', column_defs),
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: { pageLength: { _: "%d rows", } }
    }
});

executeColVisibility(table2);


window.changeStatus = function (e, route)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', 'Are you sure Update Status. ');
}
