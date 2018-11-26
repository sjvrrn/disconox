(function ($) {

    $.fn.flickrGalleryThumbs = function (options) {


        return this.each(function () {
            var PhotoSetID = $(this).attr("id");
			
			var thisSet = $(this);  

            var url = "https://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&api_key=f0b84fba1c00631410b85b90720f52ba";
            var src;
            $.getJSON(url + "&photoset_id=" + PhotoSetID + "&format=json&jsoncallback=?", function (data) {
			
			 
      var settings = $.extend({
            // These are the defaults.
            height: "180",
            width: "240",
			showTitle: true,
			titlePostion: "top",
			showTotal: true,
			showOwner: true
			
        }, options );
 
                var photosetTitle = data.photoset.title;
                if (settings.showTitle == true && settings.titlePostion == "top") {
				
				$( "<div class='setTitle'>" + photosetTitle + "</div>" ).insertBefore(thisSet);
				
				}	

				
				 var photosetOwner = data.photoset.ownername;
				 
				 if (settings.showOwner == true) {
				 
				 $( "<div class='owner'>by " + photosetOwner + "</div>" ).insertAfter(thisSet);
				 
				 }

				 var photosetTotal = data.photoset.total;
				 
				 if (settings.showTotal == true) {
				 
				 $( "<div class='total'>" + photosetTotal + " images</div>" ).insertAfter(thisSet);
				 
				 }
				 
				if (settings.showTitle == true && settings.titlePostion == "bottom") {
				
				$( "<div class='setTitle'>" + photosetTitle + "</div>" ).insertAfter(thisSet);
				
				}	
				 
				  
               				

                $.each(data.photoset.photo, function (i, item) {
                    src = "http://farm" + item.farm + ".static.flickr.com/" + item.server + "/" + item.id + "_" + item.secret + ".jpg";
                    title = item.title;

                    $("<a>").attr({
                        "href": src,
                            "class": "gallery",
                            "rel": PhotoSetID,
                            "title": title
                    }).html(
                    $("<img />").attr({
                        "src": src,
                            "alt": title,
                            "class": (i === 0 ? "show" : "hide"),
                            "width": settings.width,
                            "height": settings.height
                    })

                    ).appendTo("#" + PhotoSetID);
                    $("a.gallery[rel=" + PhotoSetID + "]").colorbox();

                });
				
				 

            });
			
			

        });

    };

}(jQuery));