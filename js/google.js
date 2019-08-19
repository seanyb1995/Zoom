var x = document.getElementById("latlng");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.value = "" + position.coords.latitude + ", " + position.coords.longitude;
}

function showError(error) {
  switch(error.code) {
    case error.PERMISSION_DENIED:
      x.innerHTML = "User denied the request for Geolocation."
      break;
    case error.POSITION_UNAVAILABLE:
      x.innerHTML = "Location information is unavailable."
      break;
    case error.TIMEOUT:
      x.innerHTML = "The request to get user location timed out."
      break;
    case error.UNKNOWN_ERROR:
      x.innerHTML = "An unknown error occurred."
      break;
  }
}

$(document).ready(function(){
    getLocation();
});

function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            mapTypeControl: false,
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 14
          });
          
          var geocoder = new google.maps.Geocoder;
          var infowindow = new google.maps.InfoWindow;
          new AutocompleteDirectionsHandler(map);
          
          document.getElementById('getLocation').addEventListener('click', function() {
            geocodeLatLng(geocoder, map, infowindow);
          });
          
        }
        
    $(document).on({
        'DOMNodeInserted': function() {
            $('.pac-item, .pac-item span', this).addClass('needsclick');
        }
    }, '.pac-container');
        
    $('body').on('touchstart','.pac-container', function(e){
        e.stopImmediatePropagation();
    })
        
        function geocodeLatLng(geocoder, map, infowindow) {
        var input = document.getElementById('latlng').value;
        var latlngStr = input.split(',', 2);
        var latlng = {lat: parseFloat(latlngStr[0]), lng: parseFloat(latlngStr[1])};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              infowindow.setContent(results[0].formatted_address);
              document.getElementById("origin-input").value = results[0].formatted_address;
              infowindow.open(map, marker);
            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
        }
        
        /**
         * @constructor
         */
        function AutocompleteDirectionsHandler(map) {
          this.map = map;
          this.originPlaceId = null;
          this.destinationPlaceId = null;
          this.travelMode = 'DRIVING';
          this.directionsService = new google.maps.DirectionsService;
          this.directionsDisplay = new google.maps.DirectionsRenderer;
          this.directionsDisplay.setMap(map);
        
          var originInput = document.getElementById('origin-input');
          var destinationInput = document.getElementById('destination-input');
        
          var originAutocomplete = new google.maps.places.Autocomplete(originInput);
          // Specify just the place data fields that you need.
          originAutocomplete.setFields(['place_id']);
        
          var destinationAutocomplete =
              new google.maps.places.Autocomplete(destinationInput);
          // Specify just the place data fields that you need.
          destinationAutocomplete.setFields(['place_id']);
        
          this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
          this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
        }
        
        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        AutocompleteDirectionsHandler.prototype.setupClickListener = function(
            id, mode) {
          var radioButton = document.getElementById(id);
          var me = this;
        
          radioButton.addEventListener('click', function() {
            me.travelMode = mode;
            me.route();
          });
        };
        
        AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(
            autocomplete, mode) {
          var me = this;
          autocomplete.bindTo('bounds', this.map);
        
          autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
        
            if (!place.place_id) {
              window.alert('Please select an option from the dropdown list.');
              return;
            }
            if (mode === 'ORIG') {
              me.originPlaceId = place.place_id;
            } else {
              me.destinationPlaceId = place.place_id;
            }
            me.route();
          });
        };
        
        AutocompleteDirectionsHandler.prototype.route = function() {
          if (!this.originPlaceId || !this.destinationPlaceId) {
            return;
          }
          var me = this;
        
          this.directionsService.route(
              {
                origin: {'placeId': this.originPlaceId},
                destination: {'placeId': this.destinationPlaceId},
                travelMode: this.travelMode
              },
              function(response, status) {
                if (status === 'OK') {
                  me.directionsDisplay.setDirections(response);
                } else {
                  window.alert('Directions request failed due to ' + status);
                }
              });
              
              
        var bounds = new google.maps.LatLngBounds;
        
        var markersArray = [];
              
        var geocoder = new google.maps.Geocoder;
              
        var originInput = document.getElementById('origin-input').value;
        
        var destinationInput = document.getElementById('destination-input').value;
        
        var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';
        
        var service = new google.maps.DistanceMatrixService;
        service.getDistanceMatrix({
          origins: [originInput],
          destinations: [destinationInput],
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status) {
          if (status !== 'OK') {
            alert('Error was: ' + status);
          } else {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;
            var outputTime = document.getElementById('time');
            var outputDistance = document.getElementById('distance');
            var outputCost = document.getElementById('cost');
            outputTime.innerHTML = '';
            outputDistance.innerHTML = '';


            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
              geocoder.geocode({'address': originList[i]});
              for (var j = 0; j < results.length; j++) {
                geocoder.geocode({'address': destinationList[j]});
                outputTime.innerHTML +=  results[j].duration.text + '<br>';
                outputDistance.innerHTML +=  results[j].distance.text;
                document.getElementById('cost').innerHTML = "";
                outputCost.innerHTML +=  '$' + (((results[j].distance.value) / 1000) * 1.5);
              }
            }
              var element, name, arr;
              element = document.getElementById("output");
              name = "in-view";
              arr = element.className.split(" ");
              if (arr.indexOf(name) == -1) {
                element.className += " " + name;
              }
              
              var element, name, arr;
              element = document.getElementById("request");
              name = "in-view";
              arr = element.className.split(" ");
              if (arr.indexOf(name) == -1) {
                element.className += " " + name;
              }
              
              var requestTime = document.getElementById('time').textContent;
              var Time = requestTime.replace('mins', '');
              Time = parseInt(Time);
              document.getElementById('requestTime').value = Time;
              
              var requestDistance = document.getElementById('distance').textContent;
              var Distance = requestDistance.replace('km', '');
              Distance = parseInt(Distance);
              document.getElementById('requestDistance').value = Distance;
              
              var requestCost = document.getElementById('cost').textContent;
              var Cost = requestCost.replace('$', '');
              Cost = parseInt(Cost);
              document.getElementById('requestCost').value = Cost;
              
            }
        });
      }

