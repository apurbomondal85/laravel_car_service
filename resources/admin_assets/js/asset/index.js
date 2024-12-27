let columns = [
    {data: 'id'},
    {data: 'operator'},
    {data: 'name'},
    {data: 'asset_type'},
    {data: 'quantity'},
    {data: 'price'},
    {data: 'total'},
    {data: 'stock'},
    {data: 'purchased_date'},
    {
        data: "action",
        orderable: false,
        searchable: false,
        responsive: true,
    },
];

let column_defs = [
    { targets: 3, visible: true },
    { className: "text-center", targets: [0, 2, 5, 6, 7] },
];

var table = $("#assetDataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    ajax: {
        url: BASE_URL + "/assets",
        data: function (d) {
            d.status    = $("#assetStatus").val()
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
        { html: colVisibility("#assetDataTable", column_defs) },
        {
            html:
                '<a class="dt-button buttons-collection" href="' + BASE_URL + '/assets/create"><i class="fas fa-plus"></i> Add New</a>',
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
    $("#assetStatus").val(status);

    table.ajax.reload();
}
