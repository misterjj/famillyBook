
$(function () {
  let searchProfile = $('#search-profile');
  
  if (searchProfile.length > 0) {
    
    searchProfile.autocomplete({
      source: indexProfile,
      position: { my : "right-1 top", at: "right bottom" },
      select: function (event, ui) {
        if (ui.item !== undefined) {
          window.location = ui.item.url;
        } else {
          $('#create-profile').modal('show')
        }
      }
    });
    
    searchProfile.autocomplete().data( "ui-autocomplete" )._renderMenu = function( ul, items ) {
      let that = this;
      $.each( items, function( index, item ) {
        that._renderItemData( ul, item );
      });
      if (items.length < 5) {
        $( "<li class='add-profile'>" )
          .append( '<i class="far fa-plus-square"></i> Ajouter un profile' )
          .appendTo( ul );
      }
    };
  
    searchProfile.autocomplete().data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( item.name + ' <i>dit '+item.nickname+'</i>' )
        .appendTo( ul );
    };
    
    searchProfile.on( "autocompleteresponse", function( event, ui ) {
      let items = ui.content;
      if (items.length === 0) {
        searchProfile.autocomplete().data( "ui-autocomplete" )._suggest(items)
      }
    });
    searchProfile.on( "autocompleteclose", function( event, ui ) {
      if ($(event.target).hasClass('ui-autocomplete-loading')) {
        $(searchProfile.autocomplete( "widget" )).show();
      }
    });
  }
});

jQuery.ui.autocomplete.prototype._resizeMenu = function () {
  var ul = this.menu.element;
  ul.outerWidth(this.element.outerWidth() - 2);
};
