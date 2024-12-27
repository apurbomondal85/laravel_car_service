let columns = [
    {data: 'id'},
    {data: 'unique_id'},
    {data: 'asset_type'},
    {data: 'asset_name'},
    {data: 'category_name'},
    {data: 'assigned_date'},
    {data: 'quantity'},
    {data: 'acknowledgement_status'},
    {data: 'acknowledgement'},
    {data: 'operator_id'},
    {data: 'action', name: 'action', orderable: false, searchable: false, responsive:true},
];

let column_defs = [
    // { targets: 6, visible: false },
    {"className": "text-center", "targets": [0,6,7,8,9]}
];

var table = $('#dataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/ams/stock-assign",
        data: function (d) {
            d.status    = $("#userStatus").val()
            d.is_deleted = $("#isDeleted").val()
        }
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
        { html: colVisibility('#dataTable', column_defs) },
        { html: '<a class="dt-button buttons-collection" href="'+ BASE_URL +'/ams/stock-assign/create"><i class="fas fa-plus"></i> Add New</a>' }
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

window.filterStatus = function (status, type = '') {
    if(type == 'is_deleted')
    {
        $("#isDeleted").val(1);
    }
    else{
        $("#userStatus").val(status);
        $("#isDeleted").val(0);
    }
    table.ajax.reload();
}
