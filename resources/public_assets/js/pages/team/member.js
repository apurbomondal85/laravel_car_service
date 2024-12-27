let id = $("#team_id").val();

let columns = [
    {data: 'id'},
    {data: 'full_name'},
    {data: 'phone'},
    {data: 'location'},
    {data: 'gender'},
    {data: 'dob'},
    {data: 'operator_id'},
];
let column_defs = [
    { targets: 4, visible: true },
    {"className": "text-center", "targets": [0,2,3,4]}
];

var table = $('#teamMemberDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/team/" + id + "/member",
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
        { html: colVisibility('#teamMemberDataTable', column_defs) },
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
