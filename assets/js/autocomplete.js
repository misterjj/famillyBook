
$(function () {
  let searchProfile = $('#search-profile');
  
  searchProfile.autocomplete({
    source: indexProfile,
    position: { my : "right-1 top", at: "right bottom" },
    select: function (event, ui) {
      window.location = ui.item.url;
    }
  });
  
  searchProfile.autocomplete().data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    return $( "<li>" )
      .append( item.name + ' <i>dit '+item.nickname+'</i>' )
      .appendTo( ul );
  };
});

jQuery.ui.autocomplete.prototype._resizeMenu = function () {
  var ul = this.menu.element;
  ul.outerWidth(this.element.outerWidth() - 2);
};
