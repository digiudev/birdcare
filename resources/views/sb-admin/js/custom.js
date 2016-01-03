var editor; // use a global for the submit and return data rendering in the examples
var dataTableLabel;

    $(document).ready(function() {

        jQuery('.navbar-static-top').css('z-index', 0);

        editor = new $.fn.dataTable.Editor( {
            ajax: "/admin/editareas",
            table: "#example",
            fields: [ {
                label: "Area name:",
                name: "name"
            },
                {name: "_token", type: "hidden", def:$('#_token').val()}
            ]
        } );

        $('#example').DataTable( {
            ajax: '/admin/editareas',
            dom: 'Bfrtip',
            //serverSide: true,
            columns: [
                { data: null, render: function ( data, type, row ) {
                    // Combine the first and last names into a single table field
                    return data.name;
                } }],
            select: true,
            buttons: [
                { extend: "create", editor: editor, text: dataTableLabel.newRecord },
                { extend: "edit",   editor: editor, text: dataTableLabel.editRecord },
                { extend: "remove", editor: editor, text: dataTableLabel.deleteRecord }
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
                    "first":      dataTableLabel.paginate_first,
                    "last":       dataTableLabel.paginate_last,
                    "next":       dataTableLabel.paginate_next,
                    "previous":   dataTableLabel.paginate_previous
                },
            }
            
        } );

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': $('#_token').val()
                }
            });
        });
    } );