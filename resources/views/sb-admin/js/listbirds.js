// Setup - add a text input to each footer cell
var dataTableLabel;

$(document).ready(function () {

    $('#dataTables-birds tfoot th').each(function () {
        var title = $(this).text();
        if (title != '')
            $(this).html('<input type="text" placeholder=" '+ dataTableLabel.search +' ' + title + '" />');
    });

    var table = $('#dataTables-birds').DataTable({
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
            {"data": "rna_padre_madre"},
            {"data": "cage_name"}
        ],
        "language": {
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
        },
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

/**
 * Funzione che viene chiamata per mostrare i dati extra del record
 * altrimenti non ci starebbero tutti in un unico
 * @param data
 * @returns {string}
 */
function format(data) {

    var string = '<table class="dataTable_extra">';
    var fields = [
                    [data.fields_name.col_padre, data.rna_padre],
                    [data.fields_name.col_madre, data.rna_madre],
                    [data.fields_name.col_date_born, data.date_born],
                    [data.fields_name.col_date_sale, data.date_sale],
                    [data.fields_name.col_note, data.note]
                ];

    return string + getDataExtra(fields) + '</table>';
}

/**
 * Recupera i dati per popolare la tabella con le informazioni extra
 * Ritorna i record della tabella
 * @param dati
 * @returns {string}
 */
function getDataExtra(dati)
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