var $ = jQuery.noConflict();
console.trace()
var UTECHS = UTECHS || {};
! function(e) {
	"use strict";
	UTECHS.initialize = {
		init: function() {
			UTECHS.initialize.responsiveClasses(),
            UTECHS.initialize.verticalMiddle()
            //UTECHS.initialize.stickySidebar()
        },
        responsiveClasses: function() {
            if ("undefined" == typeof jRespond) return console.log("responsiveClasses: jRespond not Defined."), !0;
            jRespond([{
                label: "smallest",
                enter: 0,
                exit: 575
            }, {
                label: "handheld",
                enter: 576,
                exit: 767
            }, {
                label: "tablet",
                enter: 768,
                exit: 991
            }, {
                label: "laptop",
                enter: 992,
                exit: 1199
            }, {
                label: "desktop",
                enter: 1200,
                exit: 1e4
            }]).addFunc([{
                breakpoint: "desktop",
                enter: function() {
                    a.addClass("device-xl")
                },
                exit: function() {
                    a.removeClass("device-xl")
                }
            }, {
                breakpoint: "laptop",
                enter: function() {
                    a.addClass("device-lg")
                },
                exit: function() {
                    a.removeClass("device-lg")
                }
            }, {
                breakpoint: "tablet",
                enter: function() {
                    a.addClass("device-md")
                },
                exit: function() {
                    a.removeClass("device-md")
                }
            }, {
                breakpoint: "handheld",
                enter: function() {
                    a.addClass("device-sm")
                },
                exit: function() {
                    a.removeClass("device-sm")
                }
            }, {
                breakpoint: "smallest",
                enter: function() {
                    a.addClass("device-xs")
                },
                exit: function() {
                    a.removeClass("device-xs")
                }
            }])
        },
        verticalMiddle: function() {
            B.length > 0 && B.each(function() {
                var t = e(this),
                    i = t.outerHeight(),
                    n = s.outerHeight();
                t.parents("#slider").length > 0 && !t.hasClass("ignore-header") && (a.hasClass("device-xl") || a.hasClass("device-lg")) && (i -= 70, k.next("#header").length > 0 && (i += n)), (a.hasClass("device-sm") || a.hasClass("device-xs")) && t.parents(".full-screen").length && !t.parents(".force-full-screen").length ? t.children(".col-padding").length > 0 ? t.css({
                    position: "relative",
                    top: "0",
                    width: "auto",
                    marginTop: "0"
                }).addClass("clearfix") : t.css({
                    position: "relative",
                    top: "0",
                    width: "auto",
                    marginTop: "0",
                    paddingTop: "60px",
                    paddingBottom: "60px"
                }).addClass("clearfix") : t.css({
                    position: "absolute",
                    top: "50%",
                    width: "100%",
                    paddingTop: "0",
                    paddingBottom: "0",
                    marginTop: -i / 2 + "px"
                })
            })
        },
        initMap: function($el)  {
            // Find marker elements within map.
            var $markers = $el.find('.marker');

            // Create gerenic map.
            var mapArgs = {
                zoom        : $el.data('zoom') || 10,
                scrollwheel: false,
                mapTypeId   : google.maps.MapTypeId.ROADMAP,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                    position: google.maps.ControlPosition.TOP_CENTER
                },
                styles:[
                    {
                        featureType: "administrative",
                        elementType: "geometry",
                        stylers: [{
                            "visibility": "off"
                        }]
                    },
                    {
                        featureType: "poi",
                        elementType: "all",
                        stylers: [{
                            visibility: "off"
                        }]
                    }, {
                        featureType: "road",
                        elementType: "all",
                        stylers: [{
                            saturation: -100
                        }, {
                            lightness: 45
                        }]
                    }, {
                        featureType: "road.highway",
                        elementType: "all",
                        stylers: [{
                            visibility: "simplified"
                        }]
                    }, {
                        featureType: "road.arterial",
                        elementType: "labels.icon",
                        stylers: [{
                            visibility: "off"
                        }]
                    }, {
                        featureType: "transit",
                        elementType: "all",
                        stylers: [{
                            visibility: "off"
                        }]
                    }, {
                        featureType: "water",
                        elementType: "all",
                        stylers: [{
                            color: "#d7e1f2"
                        }, {
                            visibility: "on"
                        }]
                    }
                ]
            };
            var map = new google.maps.Map( $el[0], mapArgs );

            // Add markers.
            map.markers = [];
            $markers.each(function(){
                UTECHS.initialize.initMarker( $(this), map );
            });

            // Center map based on markers.
            UTECHS.initialize.centerMap( map );

            // Return map instance.
            return map;
        },
        initMarker: function( $marker, map ) {

            // Get position from marker.
            var lat = $marker.data('lat');
            var lng = $marker.data('lng');
            var title = $marker.data('title');
            var price = $marker.data('price');
            var image = $marker.data('image');
            var latLng = {
                lat: parseFloat( lat ),
                lng: parseFloat( lng )
            };
            var icon = {
                path: "M27.648-41.399q0-3.816-2.7-6.516t-6.516-2.7-6.516 2.7-2.7 6.516 2.7 6.516 6.516 2.7 6.516-2.7 2.7-6.516zm9.216 0q0 3.924-1.188 6.444l-13.104 27.864q-.576 1.188-1.71 1.872t-2.43.684-2.43-.684-1.674-1.872l-13.14-27.864q-1.188-2.52-1.188-6.444 0-7.632 5.4-13.032t13.032-5.4 13.032 5.4 5.4 13.032z",
                fillColor: '#E32831',
                fillOpacity: 1,
                strokeWeight: 0,
                scale: 0.65
            }
            // Create marker instance.
            var marker = new google.maps.Marker({
                position : latLng,
                map: map,
                icon: icon,
                
            });

            var contentString = '<div id="content" style="text-align:center">'+
                    '<div id="siteNotice"><img height="160" width="100%"src="'+image+'"></div>'+
                    '<h4 id="firstHeading" class="firstHeading">'+title+'</h4>'+
                    '<div id="bodyContent">'+
                    '<h5>'+price+'</h5>'+
                    '</div>'+
                    '</div>'

            // Append to reference for later use.
            map.markers.push( marker );
            // Create info window.
            var infowindow = new google.maps.InfoWindow({
                content: contentString,
                maxWidth: 320
            });

            // Show info window when marker is clicked.
            google.maps.event.addListener(marker, 'click', function() {
                infowindow.open( map, marker );
            });
            google.maps.event.addListenerOnce(map, 'tilesloaded', function() {
              infowindow.open(map, marker);
            });
        },
        centerMap: function( map ) {

            // Create map boundaries from all map markers.
            var bounds = new google.maps.LatLngBounds();
            map.markers.forEach(function( marker ){
                bounds.extend({
                    lat: marker.position.lat(),
                    lng: marker.position.lng()
                });
            });

            // Case: Single marker.
            if( map.markers.length == 1 ){
                map.setCenter( bounds.getCenter() );

            // Case: Multiple markers.
            } else{
                map.fitBounds( bounds );
            }
        },
        stickySidebar: function(){
            var e = 24;
            $(".right").stick_in_parent({
                offset_top: e,
                parent: '.main-wrapper'
            })
        }
        
	},UTECHS.header = {
        init: function() {
            UTECHS.header.stickyHeader(),
            UTECHS.header.removeStickyness(),
            UTECHS.header.logo(),
            UTECHS.header.stickyMenuClass(),
            UTECHS.header.responsiveMenuClass(),
            UTECHS.header.sidePanel(),
            UTECHS.header.removeSidePanel()
        },
        stickyHeader: function(i) {
            console.log(i)
            t.scrollTop() > 10 ? a.hasClass("device-xl") || a.hasClass("device-lg") ? (e("body #header").addClass("sticky-header"),e("body #cover").addClass("header-cover")) : (a.hasClass("device-sm") || a.hasClass("device-xs") || a.hasClass("device-md")) && a.hasClass("sticky-responsive-menu") && (e("#header:not(.no-sticky)").addClass("responsive-sticky-header"), UTECHS.header.stickyMenuClass()) : UTECHS.header.removeStickyness()
        },
        removeStickyness: function() {
            s.hasClass("sticky-header") && (e("body #header").removeClass("sticky-header"), e("body #cover").removeClass("header-cover"), s.removeClass().addClass(d), n.removeClass().addClass(c), n.hasClass("force-not-dark") || n.removeClass("not-dark")),
            s.hasClass("responsive-sticky-header") && e("body.sticky-responsive-menu #header").removeClass("responsive-sticky-header"), (a.hasClass("device-sm") || a.hasClass("device-xs") || a.hasClass("device-md")) && void 0 === f && (s.removeClass().addClass(d), n.removeClass().addClass(c), n.hasClass("force-not-dark") || n.removeClass("not-dark"))
        },
        logo: function() {
            !s.hasClass("dark") && !a.hasClass("dark") || n.hasClass("not-dark") ? (p && h.find("img").attr("src", p), g && m.find("img").attr("src", g)) : (v && h.find("img").attr("src", v), C && m.find("img").attr("src", C)), s.hasClass("sticky-header") && (O && h.find("img").attr("src", O), b && m.find("img").attr("src", b)), (a.hasClass("device-sm") || a.hasClass("device-xs")) && (y && h.find("img").attr("src", y), w && m.find("img").attr("src", w))
        },
        stickyMenuClass: function() {
            if (u) var e = u.split(/ +/);
            else e = "";
            var t = e.length;
            if (t > 0) {
                var a = 0;
                for (a = 0; a < t; a++) "not-dark" == e[a] ? (s.removeClass("dark"), n.addClass("not-dark")) : "dark" == e[a] ? (n.removeClass("not-dark force-not-dark"), s.hasClass(e[a]) || s.addClass(e[a])) : s.hasClass(e[a]) || s.addClass(e[a])
            }
        },
        responsiveMenuClass: function() {
            if (a.hasClass("device-sm") || a.hasClass("device-xs") || a.hasClass("device-md")) {
                if (f) var e = f.split(/ +/);
                else e = "";
                var t = e.length;
                if (t > 0) {
                    var i = 0;
                    for (i = 0; i < t; i++) "not-dark" == e[i] ? (s.removeClass("dark"), n.addClass("not-dark")) : "dark" == e[i] ? (n.removeClass("not-dark force-not-dark"), s.hasClass(e[i]) || s.addClass(e[i])) : s.hasClass(e[i]) || s.addClass(e[i])
                }
                UTECHS.header.logo()
            }
        },
        sidePanel: function(){
			e(".side-panel-trigger").click(function(){
				e("body").toggleClass("side-panel-open");
				if( e("body").hasClass('device-touch') ) {
					e("body").toggleClass("ohidden");
				}
				return false;
			});
        },
        removeSidePanel: function(){
            e(document).on('click', function(event) {
                if (!e(event.target).closest('#side-panel').length) { e("body").toggleClass('side-panel-open', false); }
                if (e(event.target).closest('#close-mobile-menu').length) { e("body").toggleClass('side-panel-open', false); }
            });
        },
    },
	UTECHS.widget = {
        init: function() {
           UTECHS.widget.textRotater(), UTECHS.widget.extras()
        },
		textRotater: function() {
            if (!e().Morphext) return console.log("textRotater: Morphext not Defined."), !0;
            tr.length > 0 && tr.each(function() {
                e(this);
                var t = e(this).attr("data-rotate"),
                    a = e(this).attr("data-speed"),
                    i = e(this).attr("data-separator");
                t || (t = "fade"), a || (a = 1200), i || (i = ","), e(this).find("#t-rotate").Morphext({
                    animation: t,
                    separator: i,
                    speed: Number(a)
                })
            })
        },
        extras: function() {
            e("#primary-menu-trigger").click(function() {
                return e("#primary-menu > ul, #primary-menu > div > ul").toggleClass("d-block"), e("body").toggleClass("primary-menu-open"), !1
            })
        }
    },
    UTECHS.documentOnReady = {
        init: function() {
			UTECHS.initialize.init(),
            UTECHS.header.init(),
        	UTECHS.widget.init(),
            UTECHS.documentOnReady.windowscroll(),
            $('.acf-map').each(function(){
                var map = UTECHS.initialize.initMap( $(this) );
            }),
            $('.testimonial').slick({
                infinite: false,
                rtl: true,
                dots: true,
				arrows: false,
                slidesToShow: 1,
                autoplay: true,
                autoplaySpeed: 2000
                
            }),
            $('.featured-posts').slick({
                infinite: true,
                rtl: true,
                dots: true,
				prevArrow: false,
   			    nextArrow: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
				variableWidth: true,
                responsive: [
                    {
                      breakpoint: 1024,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true,
                        prevArrow: false,
						nextArrow: false
                      }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
						  nextArrow: false
                        }
                      },
                      {
                        breakpoint: 480,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
    					  nextArrow: false
                        }
                      },
                ]
                
            }),
				$('.youtube-video').slick({
                infinite: true,
                rtl: true,
                dots: false,
				prevArrow: false,
   			    nextArrow: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
				variableWidth: true,
                responsive: [
                    {
                      breakpoint: 1024,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true,
                        prevArrow: false,
						nextArrow: false
                      }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
						  nextArrow: false
                        }
                      },
                      {
                        breakpoint: 480,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
    					  nextArrow: false
                        }
                      },
                ]
                
            }),
            $('.lattest-blog').slick({
                infinite: false,
                rtl: true,
                dots: true,
				prevArrow: false,
   			    nextArrow: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                responsive: [
                    {
                      breakpoint: 1024,
                      settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        dots: true,
                        prevArrow: false,
						nextArrow: false
                      }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
						  nextArrow: false
                        }
                      },
                      {
                        breakpoint: 480,
                        settings: {
                          slidesToShow: 1,
                          slidesToScroll: 1,
                          dots: true,
                          prevArrow: false,
    					  nextArrow: false
                        }
                      },
                ]
                
            })
            
        },
        windowscroll: function() {
            var a = 0,
                i = 100;
            UTECHS.header.stickyHeader(a), t.on("scroll", function() {
                UTECHS.header.stickyHeader(a), UTECHS.header.logo();
            })
        }
	},
	UTECHS.documentOnLoad = {
        init: function() {
           UTECHS.initialize.verticalMiddle()
           UTECHS.initialize.stickySidebar()

       }
       
    }
        var t = e(window),
        a = e("body"),
        tr = $(".text-rotater"),
        i = e("#wrapper"),
        o = e("#content"),
        r = e("#footer"),
        s = e("#header"),
        u = s.attr("data-sticky-class"),
        f = s.attr("data-responsive-class"),
        h = e("#logo").find(".standard-logo"),
        m = (h.find("img").outerWidth(), e("#logo").find(".retina-logo")),
        p = h.find("img").attr("src"),
        g = m.find("img").attr("src"),
        v = h.attr("data-dark-logo"),
        b = m.attr("data-sticky-logo"),
        y = h.attr("data-mobile-logo"),
        w = m.attr("data-mobile-logo"),
        d = s.attr("class"),
        n = e(".header-wrap"), 
        S = e("#page-menu"), 
        c = n.attr("class"),
        B = e(".vertical-middle"),
        O = h.attr("data-sticky-logo"),
        C = m.attr("data-dark-logo");

        e(document).ready(UTECHS.documentOnReady.init)
        e(window).load( UTECHS.documentOnLoad.init );
}(jQuery);