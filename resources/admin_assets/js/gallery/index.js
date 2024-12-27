let columns = [
    { data: "id" },
    { data: "name" },
    { data: "category" },
    { data: "is_featured" },
    { data: "operator" },
    {
        data: "action",
        orderable: false,
        searchable: false,
        responsive: true,
    },
];

let column_defs = [
    { targets: 3, visible: true },
    { className: "text-center", targets: [0, 4, 5] },
];

var table = $("#galleryDataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/gallery",
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
        { html: colVisibility("#galleryDataTable", column_defs) },
        {
            html:'<a class="dt-button buttons-collection" href="' + BASE_URL + '/gallery/create"><i class="fas fa-plus"></i> Add New</a>',
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
