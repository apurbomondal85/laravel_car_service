let columns = [
    {data: 'id'},
    {data: 'title'},
    {data: 'job_type'},
    {data: 'company_name'},
    {data: 'deadline'},
    {data: 'location'},
    {
        data: "action",
        orderable: false,
        searchable: false,
        responsive: true,
    },
];

let column_defs = [
    { className: "text-center", targets: [0, 4] },
];

var table = $("#careerDataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    ajax: {
        url: BASE_URL + "/careers",
        data: function (d) {
            d.status    = $("#careerStatus").val()
        }
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
        { html: colVisibility("#careerDataTable", column_defs) },
        {
            html:
                '<a class="dt-button buttons-collection" href="' + BASE_URL + '/careers/create"><i class="fas fa-plus"></i> Add New</a>',
        },
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


// For Filtering
window.filterStatus = function(status)
{
    $("#careerStatus").val(status);

    table.ajax.reload();
}

window.changePrimary = function (e, route)
{
    e.preventDefault();
    confirmFormModal(route, 'Confirmation', 'Are you sure to change the status?');
}
