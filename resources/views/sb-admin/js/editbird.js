$(function() {
    $( "#date_born" ).datepicker({dateFormat: "dd/mm/yy"});
    $( "#date_sale" ).datepicker({dateFormat: "dd/mm/yy"});
    $.widget( "custom.catcomplete", $.ui.autocomplete, {
        _create: function() {
            this._super();
            this.widget().menu( "option", "items", "> :not(.ui-autocomplete-category)" );
        },
        _renderMenu: function( ul, items ) {
            var that = this,
                currentCategory = "";
            $.each( items, function( index, item ) {
                var li;
                if ( item.category != currentCategory ) {
                    ul.append( "<li class='ui-autocomplete-category'>" + item.category + "</li>" );
                    currentCategory = item.category;
                }
                li = that._renderItemData( ul, item );
                if ( item.category ) {
                    li.attr( "aria-label", item.category + " : " + item.label );
                }
            });
        }
    });
});


$(function() {
    console.log('liste');
    $( "#id_padre" ).autocomplete({
        source: "/admin/getlistrna?sex=M",
        minLength: 2
    });
    $( "#id_madre" ).autocomplete({
        source: "/admin/getlistrna?sex=F",
        minLength: 2
    });
    $( "#id_specie" ).catcomplete({
        source: "/admin/getjsonspecie",
        minLength: 2
    });


});
