var editor_zones; // use a global for the submit and return data rendering in the examples
var dataTableLabel;
var areas;
var list;

EditorZone = {

    hiddeTopMenu: function(){
        jQuery('.sidebar').css('z-index', 0);
    },

    compileEditor: function (list, selected) {
        editor_zones = new $.fn.dataTable.Editor({
            ajax: "/admin/editzones",
            table: "#tbl_zones",
            fields: [{
                label: "Zone name:",
                name: "name"
            },
                {
                    label: "Name:",
                    name: "id_area",
                    type: "select",
                    options: list,
                    "default": selected
                }
            ]
        });


        jQuery('#tbl_zones').DataTable({
            ajax: '/admin/editzones',
            dom: 'Bfrtip',
            //serverSide: true,
            columns: [
                {data: "area_name"},
                {data: "name"}
            ],
            select: true,
            buttons: [
                {extend: "create", editor: editor_zones, text: dataTableLabel.newRecord},
                {extend: "edit", editor: editor_zones, text: dataTableLabel.editRecord},
                {extend: "remove", editor: editor_zones, text: dataTableLabel.deleteRecord}
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
            url: "/admin/getjsonarea",
            dataType: "json",
            success: function (data) {
                EditorZone.compileEditor(data);
            },
            error: function () {
                $('#notification-bar').text('An error occurred');
            }
        });
    }
};

$(document).ready(function () {

    EditorZone.hiddeTopMenu();
    EditorZone.getStateList();

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('#_token').val()
            }
        });
    });
});