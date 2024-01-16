// Init the widget on ready state
$(document).ready(function() {
        // Loading the Parcelshop picker widget into the <div> with id "Zone_Widget" with such settings:
        $("#Zone_Widget").MR_ParcelShopPicker({
          //
          // Settings relating to the HTML.
          //
          // JQuery selector of the HTML element receiving the Parcelshop Number (ex: here, input type text, but should be input hidden)
          Target: "#Target_Widget",
          //
          // Settings for Parcelshop data access
          //
          // Code given by Mondial Relay, 8 characters (padding right with spaces)
          // BDTEST is used for development only => a warning appears
          Brand: "BDTEST  ",
          // Default Country (2 letters) used for search at loading
          Country: "FR",
          // Default postal Code used for search at loading
          PostCode: "59000",
          // Delivery mode (Standard [24R], XL [24L], XXL [24X], Drive [DRI])
          ColLivMod: "24R",
          // Number of parcelshops requested (must be less than 20)
          NbResults: "7",
          //
          // Display settings
          //
          // Enable Responsive (nb: non responsive corresponds to the Widget used in older versions=
          Responsive: true,
                      // Show the results on Leaflet map usng OpenStreetMap. 
          ShowResultsOnMap: true
        });
      
      });