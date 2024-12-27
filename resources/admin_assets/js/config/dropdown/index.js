$(document).ready( function () {
    let columns = [
        {
            data: 'id',
            name: 'id'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false,
            responsive:true
        },
    ];

    let column_defs = [];

    var table = $('#dropdownTable').DataTable({
        order: [[0, "desc"]],
        processing: true,
        responsive: true,
        autoWidth: false,

        columns: columns,
        dom: 'Bfrtip',

        buttons: [
            'pageLength',
            {
                html: colVisibility('#dropdownTable', column_defs),
            },
            {
                html: '<button type="button" class="dt-button buttons-collection" onclick="clickAddAction()"><i class="fas fa-plus"></i>Add New</button>',
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
});
