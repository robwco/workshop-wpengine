var ZtlPluginUser = new Object();

jQuery(function() {
	ZtlPluginUser = {
		data: {
			firstVisitDate:null,
			numOfVisits:0,
			lastVisitDate:null,
			optinDate:null,
			lastPitchDate:null,
			numTimesPitched: 0
		},
		initialize: function(){
			var hasExistingCookie = ZtlPluginUser.cookie.read();
			var dateToday = ZtlPluginUser.daysToDate(0);
			//ZtlPluginUser.printTimeStamp('dateToday',dateToday);
			if (!hasExistingCookie) {
				//new user
				ZtlPluginUser.data.firstVisitDate = dateToday;
				ZtlPluginUser.data.lastVisitDate = dateToday;
				ZtlPluginUser.data.optinDate = dateToday;
				ZtlPluginUser.data.lastPitchDate = dateToday;
			}
			
			// Set Today's values
			ZtlPluginUser.data.numOfVisits++; // Increase Number of Visits
			ZtlPluginUser.data.lastVisitDate = dateToday;	// Set Last Visit to today
			
			ZtlPluginUser.cookie.write();
		},
		cookie: {
			name: 'ztl-plugin-user',
			write: function(){
				var date = new Date();
				date.setTime(date.getTime()+(365*24*60*60*1000));
				var expires = "; expires="+date.toGMTString();
				var value = JSON.stringify(ZtlPluginUser.data);
				document.cookie = ZtlPluginUser.cookie.name+"="+value+expires+"; path=/";
			},
			read: function(){
				var nameEQ = ZtlPluginUser.cookie.name + "=";
				var ca = document.cookie.split(';');
				for(var i=0;i < ca.length;i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') c = c.substring(1,c.length);
					if (c.indexOf(nameEQ) == 0){
						var jValue = c.substring(nameEQ.length,c.length);
						jValue = JSON.parse( jValue );		
						ZtlPluginUser.data = ZtlPluginUser.prevData = jValue;
						return true;
					}
				}	
				return false;
			},
		},
		daysToDate: function(days){
			var date = new Date();
			return date.setTime(date.getTime()+(days*24*60*60*1000));
		},
		daysBetween: function(from, to){
			var distanceMillis = new Date(to) - new Date(from);
			
			var seconds = Math.abs(distanceMillis) / 1000;
			var minutes = seconds / 60;
			var hours = minutes / 60;
			var days = hours / 24;
			var years = days / 365;
							
			return Math.floor(days);
		},	
		printTimeStamp: function(textLabel, timeStamp) {
			var m = new Date(timeStamp);
			var dateString = m.getUTCFullYear() +"/"+ (m.getUTCMonth()+1) +"/"+ m.getUTCDate() + " " + m.getUTCHours() + ":" + m.getUTCMinutes() + ":" + m.getUTCSeconds();							
			console.log(textLabel+": "+dateString);
		}					
	};
});