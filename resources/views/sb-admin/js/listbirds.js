// Setup - add a text input to each footer cell
$(document).ready(function() {
    console.log('ciao');
jQuery('#dataTables-birds tfoot th').each( function () {
    var title = $(this).text();
    console.log(title);
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
} );

    var table = jQuery('#dataTables-birds').DataTable({
    stateSave: true // salva l'ordinamento e i filtri in sessione
});

    console.log(table);
    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );
} );