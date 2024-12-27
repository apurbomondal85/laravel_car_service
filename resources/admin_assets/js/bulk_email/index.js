let columns = [
        { data: "id" },
        { data: "subject" },
        { data: "sent_at" },
        { data: "sent_by" },
        {
            data: "action",
            orderable: false,
            searchable: false,
            responsive: true,
        },
    ];

    let column_defs = [
        { targets: 3, visible: true },
        { className: "text-center", targets: [0, 2, 3, 4] },
    ];

    var table = $("#dataTable").DataTable({
        order: [[0, "desc"]],
        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        ajax: {
             url: BASE_URL + "/bulk_emails",
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
            {
                html:'<a class="dt-button buttons-collection" href="' + BASE_URL + '/bulk_emails/create"><i class="fas fa-plus"></i> Add New</a>',
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

    // End Tables

    // For Filtering
    function filterStatus(status, type = '')
    {
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
    // End Filtering

    window.restoreEmployee = function(id)
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
