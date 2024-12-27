
let stockId = $("#stockId").val();

let columns = [
    {data: 'id'},
    {data: 'operator_id'},
    {data: 'assign_id'},
    {data: 'quantity'},
    {data: 'status'},
    {data: 'created_at'},
    {data: 'location'},
];
let column_defs = [
    { targets: 1, visible: true },
];

var table = $('#stockHistoryDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    deferRender: true,
    ajax: {
        url: BASE_URL + "/ams/stocks/" + stockId + "/history",
    },
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text : '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        { html: colVisibility('#stockHistoryDataTable', column_defs) },
    ],
    columnDefs: column_defs,
    language: {
        searchPlaceholder: "Search records",
        search: "",
        buttons: {
            pageLength: {
                _: "%d rows",
            }
        }
    }
});

executeColVisibility(table);
// End Tables
