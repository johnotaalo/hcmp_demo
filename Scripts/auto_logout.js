/*
 * Auto logout
 */
var timer = 0;
function set_interval() {
	// the interval 'timer' is set as soon as the page loads
	timer = setInterval("auto_logout()", 3600000);
	// the figure '180000' above indicates how many milliseconds the timer be set to.
	// Eg: to set it to 5 mins, calculate 3min = 3x60 = 180 sec = 180,000 millisec.
	// So set it to 180000
}

function reset_interval() {
	//resets the timer. The timer is reset on each of the below events:
	// 1. mousemove   2. mouseclick   3. key press 4. scroliing
	//first step: clear the existing timer

	if(timer != 0) {
		clearInterval(timer);
		timer = 0;
		// second step: implement the timer again
		timer = setInterval("auto_logout()", 10000);
		// completed the reset of the timer
	}
}

function auto_logout() {
	var base_url = $("#base_url").val();
	// this function will redirect the user to the logout script
	window.location = base_url + "user_management/logout";
}

/*
* Auto logout end
*/