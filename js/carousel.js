$( document ).ready(function() {
  $("#carouselItemContainer").children().first().addClass('actif');
  $(".defilement-container").height($(".carousel").height());

  $( "#carouselNext" ).click(function() {
    var $actif = $('.actif');
    var $nextActif = $('.actif').next();

    // Si c'est le dernier enfant
    if ($nextActif.parent().get(0) != $actif.parent().get(0)){
      // Retourne au premier enfant
      $nextActif = $actif.parent().children().first();
    }

    $actif.removeClass('actif');
    $nextActif.addClass('actif');
  });

  $( "#carouselPrevious" ).click(function() {
    var $actif = $('.actif');
    var $previousActif = $('.actif').prev();

    // Si on est avant le premier enfant
    if ($previousActif.parent().get(0) != $actif.parent().get(0)){
      // Retourne au dernier enfant
      $previousActif = $actif.parent().children().last();
    }

    $actif.removeClass('actif');
    $previousActif.addClass('actif');
  });
});
