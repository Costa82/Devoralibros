$(document).ready(function() {
  $(window).scroll(function()
              {
                  if ($(this).scrollTop() > 250){
                       $('#lista_principal').addClass("lista_principal_scroll");
                       $('#lista_principal_index').addClass("lista_principal_scroll");
                  }
                  else {
                      $('#lista_principal').removeClass("lista_principal_scroll");
                      $('#lista_principal_index').removeClass("lista_principal_scroll");
                  }
              });
  });