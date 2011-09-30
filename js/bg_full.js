$(window).load(function() {    

        var theWindow        = $(window),
            $bg              = $("#bg"),
            aspectRatio      = $bg.width() / $bg.height();

        function resizeBg() {

                if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
                    $bg
                        .removeClass()
                        .addClass('bgheight');
                } else {
                    $bg
                        .removeClass()
                        .addClass('bgwidth');
                }
                a = $(window).height()-300;
                $("#content").css("height",a+"px");
                $("#content_shim").css("height",a+"px");
                
                
                a = $(window).width()-80;
                $("#content").css("width",a+"px");                
                $("#content_shim").css("width",a+"px");

        }

        theWindow.resize(function() {
                resizeBg();
        }).trigger("resize");

		$('#content').html($('.about-text').html());

		/*$('#content').show('slow');
		$('#content_shim').show('slow');*/
		
		
});