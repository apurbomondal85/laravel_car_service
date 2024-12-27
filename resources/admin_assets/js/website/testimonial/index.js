let columns = [
    { data: "id" },
    { data: "name" },
    { data: "avatar" },
    { data: "designation" },
    { data: "company" },
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
    { className: "text-center", targets: [0, 2, 5, 6, 7] },
];

var table = $("#testimonialDataTable").DataTable({
    order: [[0, "desc"]],
    processing: true,
    serverSide: true,
    responsive: true,
    autoWidth: false,

    ajax: {
        url: BASE_URL + "/testimonials",
        data: function (d) {
            d.status    = $("#testimonialStatus").val()
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
        { html: colVisibility("#testimonialDataTable", column_defs) },
        {
            html:
                '<a class="dt-button buttons-collection" href="' + BASE_URL + '/testimonials/create"><i class="fas fa-plus"></i> Add New</a>',
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
    $("#testimonialStatus").val(status);

    table.ajax.reload();
}

window.clickImage = function(image) {
    $(".showDiv").fadeIn();
    $(".img-show img").attr("src", image);
}

window.clickClose = function() {
    $(".showDiv").fadeOut();
}
