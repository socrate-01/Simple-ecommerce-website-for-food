<?php  
	require('top.php');

?>

        <div class="all-page-title page-breadcrumb">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-12">
                    <h1>Contact</h1>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Pages -->
    
    <!-- Start Contact -->
    <div class="contact-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>Contact</h2>
                        <p>Envoyez nous un message</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom complet" required data-error="Veuillez saisir votre nom">
                                    <div class="help-block with-errors"></div>
                                </div>                                 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Votre adresse mail" id="email" class="form-control" name="name" required data-error="Veuillez saisir votre adresse email">
                                    <div class="help-block with-errors"></div>
                                </div> 
                            </div>
                             <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Votre numéro de téléphone" id="mobile" class="form-control" name="name" required data-error="Veuillez saisir votre numéro de téléphone">
                                    <div class="help-block with-errors"></div>
                                </div> 
                            </div>
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <textarea class="form-control" id="comment" placeholder="Votre message" rows="4" data-error="Saisissez votre message" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn btn-common" id="button" onclick="send_message()">Send Message</button>
                                </div>
                            </div>
                        </div>            
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact -->
    
    <!-- Start Contact info -->
    <div class="contact-imfo-box">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <i class="fa fa-volume-control-phone"></i>
                    <div class="overflow-hidden">
                        <h4>Phone</h4>
                        <p class="lead">
                            776295947
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <i class="fa fa-envelope"></i>
                    <div class="overflow-hidden">
                        <h4>Email</h4>
                        <p class="lead">
                            baabdoulaziz00@gmail.com
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Contact info -->

         <!-- Google Map js -->
    <script src="js/main.js"></script>
    <script type="text/javascript">
        function send_message() {
            var name=jQuery("#name").val(); 
            var email=jQuery("#email").val();
            var mobile=jQuery("#mobile").val();
            var comment=jQuery("#comment").val();

            if(name==""){
                alert('S\'il vous plaît saisissez votre nom');
            }else if(email==""){
                alert('S\'il vous plaît saisissez votre email');
            }else if(mobile==""){
                alert('S\'il vous plaît saisissez votre numéro de téléphone');
            }else if(comment==""){
                alert('S\'il vous plaît saisissez votre message');
            }else{
                jQuery.ajax({
                    url:'send_message.php',
                    type:'post',
                    data:'name='+name+'&email='+email+'&mobile='+mobile+'&comment='+comment,
                    success:function(result){
                        jQuery('#button').hide();
                        alert(result);
                    }
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBmGmeot5jcjdaJTvfCmQPfzeoG_pABeWo "></script>
    <script src="js/contact-map.js"></script>
    <script>
        // When the window has finished loading create our google map below
        google.maps.event.addDomListener(window, 'load', init);

        function init() {
            // Basic options for a simple Google Map
            // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
            var mapOptions = {
                // How zoomed in you want the map to start at (always required)
                zoom: 12,

                scrollwheel: false,

                // The latitude and longitude to center the map (always required)
                center: new google.maps.LatLng(14.7042, -17.4684), // New York

                // How you would like to style the map. 
                // This is where you would paste any style found on Snazzy Maps.
                 styles: 
        [ {
                "featureType": "all",
                "elementType": "labels.text.fill",
                "stylers": [
                    {
                        "saturation": 36
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 40
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.text.stroke",
                "stylers": [
                    {
                        "visibility": "on"
                    },
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "all",
                "elementType": "labels.icon",
                "stylers": [
                    {
                        "visibility": "off"
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "administrative",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    },
                    {
                        "weight": 1.2
                    }
                ]
            },
            {
                "featureType": "landscape",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 20
                    }
                ]
            },
            {
                "featureType": "poi",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 21
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.fill",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 17
                    }
                ]
            },
            {
                "featureType": "road.highway",
                "elementType": "geometry.stroke",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 29
                    },
                    {
                        "weight": 0.2
                    }
                ]
            },
            {
                "featureType": "road.arterial",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 18
                    }
                ]
            },
            {
                "featureType": "road.local",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 16
                    }
                ]
            },
            {
                "featureType": "transit",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#000000"
                    },
                    {
                        "lightness": 19
                    }
                ]
            },
            {
                "featureType": "water",
                "elementType": "geometry",
                "stylers": [
                    {
                        "color": "#141516"
                    },
                    {
                        "lightness": 17
                    }
                ]
            }
        ]
            };

            // Get the HTML DOM element that will contain your map 
            // We are using a div with id="map" seen below in the <body>
            var mapElement = document.getElementById('googleMap');

            // Create the Google Map using our element and options defined above
            var map = new google.maps.Map(mapElement, mapOptions);

            // Let's also add a marker while we're at it
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(14.7042, -17.4684),
                map: map,
                title: 'Ramble!',
                icon: 'images/icons/map-2.png',
                animation:google.maps.Animation.BOUNCE

            });
        }
    </script>
<?php  
	require('footer.php');
?> 