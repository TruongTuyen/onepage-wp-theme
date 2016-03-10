$(document).ready(function() {
			/*$('#fullpage').fullpage({
				anchors: ['firstPage', 'secondPage', '3rdPage', '4rdPage','5rdPage','6rdPage'],
				scrollOverflow: false,
                autoScrolling:false,
                fitToSection:false,
                verticalCentered: false,
                
                menu: '#menu',
                afterResize: function(){
                    var h_1 = $('#section2 #picture_left').height();
                    $('#picture_right').height(h_1);
                }
			});*/
            
            $('.list_sporter li.item').hover(
                function(){
                    $(this).children().find('.desc_spoert').slideDown();
                },
                function(){
                    $(this).children().find('.desc_spoert').slideUp();
                }
                );
           
            $( 'a[href*=#]:not([href=#])' ).click( function()
				{
					if( location.pathname.replace( /^\// , '' ) == this.pathname.replace( /^\// , '' ) && location.hostname == this.hostname )
					{
						var target = $( this.hash );
						target = target.length ? target : $( '[name='+this.hash.slice( 1 )+']' );
						if( target.length )
						{
							$( 'html,body' ).stop().animate(
							{
								scrollTop:target.offset().top - 120
							} , 1000 );
							return false;
						}
					}
				});
		});
        
var videos = document.getElementsByTagName("video"), fraction = 0.8;

function checkScroll() {

    for(var i = 0; i < videos.length; i++) {

        var video = videos[i];

        var x = video.offsetLeft, y = video.offsetTop, w = video.offsetWidth, h = video.offsetHeight, r = x + w, //right
            b = y + h, //bottom
            visibleX, visibleY, visible;

            visibleX = Math.max(0, Math.min(w, window.pageXOffset + window.innerWidth - x, r - window.pageXOffset));
            visibleY = Math.max(0, Math.min(h, window.pageYOffset + window.innerHeight - y, b - window.pageYOffset));

            visible = visibleX * visibleY / (w * h);

            if (visible > fraction) {
                video.play();
            } else {
                video.pause();
            }

    }

}

window.addEventListener('scroll', checkScroll, false);
window.addEventListener('resize', checkScroll, false);
