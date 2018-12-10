import '../../../node_modules/bootstrap';
import '../../../node_modules/jquery';

window.jQuery = jQuery;

console.log(jQuery);


/**
 * Get HTML asynchronously
 * @param  {String}   url      The URL to get HTML from
 * @param  {Function} callback A callback funtion. Pass in "response" variable to use returned HTML.
 */
var getHTML = function ( url, callback ) {

	// Feature detection
	if ( !window.XMLHttpRequest ) return;

	// Create new request
	var xhr = new XMLHttpRequest();

	// Setup callback
	xhr.onload = function() {
		if ( callback && typeof( callback ) === 'function' ) {
			callback( this.responseXML );
		}
	}

	// Get the HTML
	xhr.open( 'GET', url );
	xhr.responseType = 'document';
	xhr.send();

};

(function($){
  $(document).ready(function(){
    $('#menu-main, #menu-sub').find('a').click(function (e) {
      e.preventDefault();

      var addressValue = $(this).attr("href");
      console.log(addressValue);

      history.pushState(null, null, addressValue);
      
      getHTML( addressValue, function (response) {
      	document.documentElement.innerHTML = response.documentElement.innerHTML;
      });
    });
    
  // });
  
  /**
   * When all content is loaded
   */
  // $(window).load(function(){

  });

})(jQuery);