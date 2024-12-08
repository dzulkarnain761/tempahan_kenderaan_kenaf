$(document).ready(function () {
    "use strict";
    $("#products-datatable").each(function () {
        // Target the current table
        const table = $(this);

        // Dynamically configure columns based on the table header
        const columnConfigs = [];
        table.find("thead th").each(function () {
            // You can add conditions to set specific column options dynamically
            columnConfigs.push({ orderable: $(this).hasClass("non-sortable") ? false : true });
        });

        // Initialize DataTable for the current table
        table.DataTable({
            language: {
                paginate: {
                    previous: "<i class='mdi mdi-chevron-left'>",
                    next: "<i class='mdi mdi-chevron-right'>",
                },
                info: "Showing entries _START_ to _END_ of _TOTAL_",
                lengthMenu:
                    'Display <select class="form-select form-select-sm ms-1 me-1">' +
                    '<option value="5">5</option>' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="-1">All</option>' +
                    '</select> entries',
            },
            pageLength: 5,
            columns: columnConfigs, // Apply the dynamically created column configuration
            order: [[0, "asc"]], // Default sorting on the first column
            drawCallback: function () {
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded");
                $(".dataTables_length label").addClass("form-label");
                document
                    .querySelector(".dataTables_wrapper .row")
                    .querySelectorAll(".col-md-6")
                    .forEach(function (e) {
                        e.classList.add("col-sm-6");
                        e.classList.remove("col-sm-12");
                        e.classList.remove("col-md-6");
                    });
            },
        });
    });
});
