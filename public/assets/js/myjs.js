// $(document).ready(function () {
//     $("table.display").DataTable();
// });

new DataTable('.display', {
    lengthMenu: [
        [7,10, 25, 50, -1],
        [5,10, 25, 50, 'All']
    ]
});

new DataTable('table.display-noorder', {
    ordering:false,
    lengthMenu: [
        [7,10, 25, 50, -1],
        [7,10, 25, 50, 'All']
    ]
});
