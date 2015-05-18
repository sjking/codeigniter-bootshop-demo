/* custom alert functions
 * @author Steve King
 */
$(document).ready(function()
{
	// allow alerts to be hidden and come back again
	$("[data-hide]").on("click", function(){
        $("." + $(this).attr("data-hide")).hide();
    });
});