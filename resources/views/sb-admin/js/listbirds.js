// Setup - add a text input to each footer cell
$(document).ready(function () {
    console.log('ciao');
    jQuery('#dataTables-birds tfoot th').each(function () {
        var title = $(this).text();
        if (title != '')
            $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    });

    var table = jQuery('#dataTables-birds').DataTable({
        "ajax": "/admin/getListBirds",
        "columns": [
            {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
            },
            {"data": "number"},
            {"data": "sex"},
            {"data": "genere_specie"},
            {"data": "rna_padre"},
            {"data": "rna_madre"},
            {"data": "cage_name"},
            {"data": "date_born"}
        ],
        "order": [[5, 'asc']],
        "stateSave": true // salva l'ordinamento e i filtri in sessione
    });

    // Apply the search
    table.columns().every(function () {
        var that = this;

        $('input', this.footer()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that
                    .search(this.value)
                    .draw();
            }
        });
    });

    // Add event listener for opening and closing details
    $('#dataTables-birds tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
});

/* Formatting function for row details - modify as you need */
function format(data) {
    // `d` is the original data object for the row
    var string = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    var fields = [
                    ['Date Born', data.date_born],
                    ['Date Sale', data.date_sale],
                    ['Note', data.note]
                ];
    return string+getDataFormat(fields)+'</table>';
}

function getDataFormat(dati)
{
    var string = '';
    dati.forEach(function(dato) {
        if(dato[1]!='')
        {
            string+='<tr>' +
                '<td>' + dato[0] + ':</td>' +
                '<td>' + dato[1] + '</td>' +
                '</tr>';
        }
    });

    if(string=='')
        string+='<tr><td colspan="2">Nessun dato in più!</td></tr>';

    return string;
}