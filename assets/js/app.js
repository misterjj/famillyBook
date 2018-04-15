/**
 * Created by jonathan on 18/03/2018.
 */
require('jquery');
require('bootstrap');
require('bootstrap-datepicker');

$.fn.datepicker.dates['fr'] = {
  days: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
  daysShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
  daysMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
  months: ["Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Decembre"],
  monthsShort: ["Jan", "Feb", "Mar", "Avr", "Mai", "Juin", "Jui", "Aout", "Sep", "Oct", "Nov", "Dec"],
  today: "Aujourd'hui",
  clear: "Effacer",
  format: "dd/mm/yyyy",
  titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
  weekStart: 0
};

$(function () {
  $('.datepicker').datepicker({
    language: 'fr'
  });
  
  $('.google-autocomplete').each(function () {
    var input = $(this);
    var autocomplete = new google.maps.places.Autocomplete(input.get(0));
    autocomplete.addListener('place_changed', function() {
      var place = autocomplete.getPlace();
      input.parent().children('.lat').val(place.geometry.location.lat());
      input.parent().children('.lng').val(place.geometry.location.lng());
    });
  })
  
  $('.form-entre-disabled').on('keyup keypress', function(e) {
    var keyCode = e.keyCode || e.which;
    if (keyCode === 13) {
      e.preventDefault();
      return false;
    }
  });
})