let columns = [
    { data: 'id' },
    { data: 'service_id' },
    { data: 'client_id' },
    { data: 'employee_id' },
    { data: 'category' },
    { data: 'date_time' },
    { data: 'contact_type' },
    { data: 'operator' },
];
let column_defs = [
    { targets: 5, visible: false },
    { "className": "text-center", "targets": [0, 7] }
];

var table = $('#noteReportDataTable').DataTable({
    order: [[0, 'desc']],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,
    ajax: {
        url: BASE_URL + "/report/notes",
        data: function (d) {
            d.employee   = $("#employee").val()
            d.service   = $("#service").val()
            d.status = $("#status").val()
            d.fromDate = $("#fromDate").val()
            d.toDate = $("#toDate").val()
        }
    },
    columns: columns,
    dom: 'Bfrtip',
    buttons: [
        'pageLength',
        {
            text: '<i class="fas fa-download"></i> Export',
            extend: 'collection',
            className: 'custom-html-collection pull-right',
            buttons: [
                'pdf',
                'csv',
                'excel',
            ]
        },
        { html: colVisibility('#noteReportDataTable', column_defs) },

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

$(document).ready(function () {
    $('#employee').select2({
        placeholder: "Select One",
        allowClear: true
    });
    $('#service').select2({
        placeholder: "Select One",
        allowClear: true
    });

    $('#status').select2({
        placeholder: "Select One",
        allowClear: true
    });
});

window.filterUsers = function () {
    table.ajax.reload();
}

$(function() {
    $('.date-icon').on('click', function() {
        $('#date_range').focus();
    })

    $('input[name="date_range"]').daterangepicker({
        opens: 'left'
    }, function(start, end, label) {
        $('#fromDate').val(start.format('YYYY-MM-DD'));
        $('#toDate').val(end.format('YYYY-MM-DD'));
    });
});

window.filterClear = function () {
    $('#employee').val([]).trigger('change');
    $('#service').val([]).trigger('change');
    $('#status').val([]).trigger('change');
    $('input[name="date_range"]').val([]);

    table.ajax.reload();
}
