let teamId = $("#teamId").val();

let column_defs = [];
var table = $("#dataTable").DataTable({
    order: [[0, 'asc']],
    processing: true,
    responsive: true,
    autoWidth: false,
    serverSide: false,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        colVisibility('#dataTable', column_defs),
        '<a class="dt-button buttons-collection" href="' + BASE_URL + '/teams/' + teamId +'/member/create"><i class="fas fa-plus"></i> Add New Member</a>'
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: { pageLength: { _: "%d rows", } }
    }
});
executeColVisibility(table);

const showTeamModal = "#showTeamModal";
window.showViewModal = function () {
    loading('show');
    $(showTeamModal).modal('show');
    loading('hide');
}

window.changeActiveStatus = function (route, confirmation_msg)
{
    confirmFormModal(route, 'Confirmation', confirmation_msg);
}

window.changeFeatureStatus = function (route, confirmation_msg)
{
    confirmFormModal(route, 'Confirmation', confirmation_msg);
}
