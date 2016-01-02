var editor; // use a global for the submit and return data rendering in the examples

    $(document).ready(function() {

        editor = new $.fn.dataTable.Editor( {
            //ajax: "../php/staff.php",
            table: "#example",
            fields: [ {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Last name:",
                name: "last_name"
            }, {
                label: "Position:",
                name: "position"
            }, {
                label: "Office:",
                name: "office"
            }, {
                label: "Extension:",
                name: "extn"
            }, {
                label: "Start date:",
                name: "start_date",
                type: "datetime"
            }, {
                label: "Salary:",
                name: "salary"
            }
            ]
        } );

        $('#example').DataTable( {
            //ajax: '/api/staff',
            dom: 'Bfrtip',
            select: true,
            buttons: [
                { extend: "create", editor: editor },
                { extend: "edit",   editor: editor },
                { extend: "remove", editor: editor }
            ]
        } );
    } );