let columns = [
    { data: "id" },
    { data: "name" },
    { data: "short_description" },
    { data: "is_active" },
    { data: "is_featured" },
    { data: "operator_id" },
    {
        data: "action",
        orderable: false,
        searchable: false,
        responsive: true,
    },
];

let column_defs = [
    { targets: 2, visible: false },
    { className: "text-center", targets: [0, 2, 3, 4, 5, 6] },
];

var table = $("#dataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/teams"
    },
    columns: columns,
    dom: "Bfrtip",
    buttons: [
        "pageLength",
        {
            text: '<i class="fas fa-download"></i> Export',
            extend: "collection",
            className: "custom-html-collection pull-right",
            buttons: ["pdf", "csv", "excel"],
        },
        { html: colVisibility("#dataTable", column_defs) },
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: {
            pageLength: {
                _: "%d rows",
            },
        },
    },
});

executeColVisibility(table);
// End Tables

window.changeActiveStatus = function (e, route, confirmation_msg)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', confirmation_msg);
    table.ajax.reload();
}

window.changeFeatureStatus = function (e, route, confirmation_msg)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', confirmation_msg);
    table.ajax.reload();
}

const showTeamModal = "#showTeamModal";

window.showViewModal = function (id) {
    loading('show');
    let base_url = getBaseUrl();
    const url = base_url + '/teams/' + id + '/show';
    axios.post(url)
    .then(response => {
        $('#name').html(response.data.name);
        $('#short_description').html(response.data.short_description);
        $(showTeamModal).modal('show');
    })
    .catch(error => {
        const response = error.response;
        if (response)
            notify(response.data.message, 'error');
    })
    .finally(() => {
        loading('hide');
    });
}


window.restoreEmployee = function (id)
{
    loading('show');
    let base_url = getBaseUrl();
    const url = base_url + '/users/' + id + '/restore-api';
    axios.post(url)
    .then(response => {
        notify(response.data.message, 'success');
        table.ajax.reload();
    })
    .catch(error => {
        const response = error.response;
        if (response)
            notify(response.data.message, 'error');
    })
    .finally(() => {
        loading('hide');
    });
}