let emailId = $("#emailId").val();

let columns = [
    { data: 'id'},
    { data: 'name'},
    { data: 'email'},
    { data: 'mobile'},
    { data: 'status'},
    {
        data: 'action',
        orderable: false,
        searchable: false,
        responsive:true
    },
];
let column_defs = [
    { targets: 3, visible: true },
    { className: "text-center", targets: [0, 2, 3, 4] },
];
    
    var table = $('#dataTable').DataTable({
        order: [[0, 'desc']],
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
            url: BASE_URL + "/bulk_emails/" + emailId + "/show",
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
            {
                html: colVisibility("#dataTable", column_defs),
            },
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

window.resendEmail = function (id)
{
    loading('show');
    const url = BASE_URL + '/bulk_emails/' + id + '/resend-api';
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