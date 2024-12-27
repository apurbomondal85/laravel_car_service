let type = $("#type").val();

let columns = [
    { data: "id" },
    { data: "name" },
    { data: "logo" },
    { data: "description" },
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
    { targets: 3, visible: false },
    { className: "text-center", targets: [0, 2, 4, 5, 6] },
];

var table = $("#clientPartnerDataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    ajax: {
        url: BASE_URL + "/" + type + "/",
        data: function (d) {
            d.status  = $("#status").val(),
            d.type    = type
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
        { html: colVisibility("#clientPartnerDataTable", column_defs) },
        {
            html:
                '<a class="dt-button buttons-collection" href="' + BASE_URL + "/" + type +'/create?type='+ type +'"><i class="fas fa-plus"></i> Add New</a>',
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
    $("#status").val(status);

    table.ajax.reload();
}

window.clickImage = function(image) {
    $(".showDiv").fadeIn();
    $(".img-show img").attr("src", image);
}

window.clickClose = function() {
    $(".showDiv").fadeOut();
}
