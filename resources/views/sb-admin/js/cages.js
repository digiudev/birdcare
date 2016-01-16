var editor_zones; // use a global for the submit and return data rendering in the examples
var dataTableLabel;
var areas;
var list;

EditorCage = {

    hiddeTopMenu: function(){
        jQuery('.sidebar').css('z-index', 0);
    },

    compileEditor: function (areas, positions) {
        editor_cages = new $.fn.dataTable.Editor({
            ajax: "/admin/editcages",
            table: "#tbl_cages",
            fields: [{
                label: "Cage name:",
                name: "name"
            },
                {
                    label: "Area:",
                    name: "id_area",
                    type: "select",
                    options: areas
                },
                {
                    label: "Zone:",
                    name: "id_position",
                    type: "select",
                    options: positions
                }
            ]
        });


        jQuery('#tbl_cages').DataTable({
            ajax: '/admin/editcages',
            dom: 'Bfrtip',
            //serverSide: true,
            columns: [
                {data: "name"},
                {data: "area_name"},
                {data: "position_name"}
            ],
            select: true,
            buttons: [
                {extend: "create", editor: editor_cages, text: dataTableLabel.newRecord},
                {extend: "edit", editor: editor_cages, text: dataTableLabel.editRecord},
                {extend: "remove", editor: editor_cages, text: dataTableLabel.deleteRecord}
            ],
            responsive: true,
            language: {
                "lengthMenu": dataTableLabel.lengthMenu,
                "zeroRecords": dataTableLabel.zeroRecords,
                "info": dataTableLabel.info,
                "infoEmpty": dataTableLabel.infoEmpty,
                "infoFiltered": dataTableLabel.infoFiltered,
                "search": dataTableLabel.search,
                "paginate": {
                    "first": dataTableLabel.paginate_first,
                    "last": dataTableLabel.paginate_last,
                    "next": dataTableLabel.paginate_next,
                    "previous": dataTableLabel.paginate_previous
                }
            }

        });
    },
    getStateList: function () {

        $.ajax({
            url: "/admin/getjsonposition",
            dataType: "json",
            success: function (data) {
                console.log(data);
                EditorCage.compileEditor(data['areas'], data['positions']);
            },
            error: function () {
                $('#notification-bar').text('An error occurred');
            }
        });
    }
};

$(document).ready(function () {

    EditorCage.hiddeTopMenu();
    EditorCage.getStateList();

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('#_token').val()
            }
        });
    });
});