// Initialiser le widget après le chargement complet de la page
$(document).ready(function() {
    // Charge le widget dans la DIV d'id "Zone_Widget" avec les paramètres indiqués
    $("#Zone_Widget").MR_ParcelShopPicker({
      //
      // Paramétrage de la liaison avec la page.
      //
      // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais (ex: input hidden)
      Target: "#Target_Widget",
      // Selecteur de l'élément dans lequel est envoyé l'ID du Point Relais pour affichage
      TargetDisplay: "#TargetDisplay_Widget",
      // Selecteur de l'élément dans lequel sont envoysé les coordonnées complètes du point relais
      TargetDisplayInfoPR: "#TargetDisplayInfoPR_Widget",
      //
      // Paramétrage du widget pour obtention des point relais.
      //
      // Le code client Mondial Relay, sur 8 caractères (ajouter des espaces à droite)
      // BDTEST est utilisé pour les tests => un message d'avertissement apparaît
      Brand: "BDTEST  ",
      // Pays utilisé pour la recherche: code ISO 2 lettres.
      Country: "FR",
      // Code postal pour lancer une recherche par défaut
      PostCode: "59000",
      // Mode de livraison (Standard [24R], XL [24L], XXL [24X], Drive [DRI])
      ColLivMod: "24R",
      // Nombre de Point Relais à afficher
      NbResults: "7",
      //
      // Paramétrage d'affichage du widget.
      //
      // Afficher les résultats sur une carte?
      ShowResultsOnMap: true,
      // Afficher les informations du point relais à la sélection sur la carte?
      DisplayMapInfo: true,
      // Fonction de callback déclenché lors de la selection d'un Point Relais
      OnParcelShopSelected:
        // Fonction de traitement à la sélection du point relais.
        // Remplace les données de cette page par le contenu de la variable data.
        // data: les informations du Point Relais
        function(data) {
          $("#cb_ID").html(data.ID);
          $("#cb_Nom").html(data.Nom);
          $("#cb_Adresse").html(data.Adresse1 + ' ' + data.Adresse2);
          $("#cb_CP").html(data.CP);
          $("#cb_Ville").html(data.Ville);
          $("#cb_Pays").html(data.Pays);

          $("#cb_Nom2").val(data.Nom);

          // Update the new form fields
    if ($("#relayDelivery").is(":checked")) {
        $("#name").val(data.Nom);
        $("#address").val(data.Adresse1 + " " + data.Adresse2);
        $("#postalCode").val(data.CP);
        $("#city").val(data.Ville);
        }
    }});
      //
      // Autres paramétrages.
      //
      // Filtrer les Points Relais selon le Poids (en grammes) du colis à livrer
      // Weight: "",
      // Spécifier le nombre de jours entre la recherche et la dépose du colis dans notre réseau
      // SearchDelay: "3",
      // Limiter la recherche des Points Relais à une distance maximum
      // SearchFar: "",										
      // Liste des pays selectionnable par l'utilisateur pour la recherche: codes ISO 2 lettres
      // AllowedCountries: "FR,ES",
      // Force l'utilisation de Google Map si la librairie est présente? 
      // EnableGmap: true,                  
      // Activer la recherche de la position lorsque le navigateur de l'utilisateur le supporte?
      // EnableGeolocalisatedSearch: "true",
      // Spécifier l'utilisation de votre feuille de style CSS lorsque vous lui donnez la valeur "0"
      // CSS: "1",
      // Activer le zoom on scroll sur la carte des résultats?
      //,MapScrollWheel: "false",
      // Activer le mode Street View sur la carte des résultats (attention aux quotas imposés par Google)
      // MapStreetView: "false"
      var homeDeliveryRadio = document.querySelector('#homeDelivery');
        var relayDeliveryRadio = document.querySelector('#relayDelivery');
        var deliveryAddressBox = document.querySelector('#deliveryAddressBox');
        var nom = $('main').data('nom');
        var prenom = $('main').data('prenom');
        var adresseLivraison1 = $('main').data('adresse-livraison1');
        var codePostal = $('main').data('codePostal');
        var ville = $('main').data('ville');

        homeDeliveryRadio.addEventListener('change', function() {
            if (homeDeliveryRadio.checked) {
                console.log('codePostal:', codePostal);
            // Update the new form fields with the home delivery details
            $("#name").val(nom + " " + prenom);
            $("#address").val(adresseLivraison1 );
            $("#postalCode").val(codePostal);
            $("#city").val(ville);
            }
        });
    
        relayDeliveryRadio.addEventListener('change', function() {
            if (relayDeliveryRadio.checked) {
                deliveryAddressBox.textContent = relayDeliveryRadio.nextElementSibling.textContent;
            }
        });
  });