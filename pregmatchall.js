/*
* Want preg_match_all in JS ? use this, although it returns the array of matches instead of using a reference to a local variable.
* Also, I named the function "js*Preg*MatchAll, but it isn't magic : regex implementation varies from PHP's PCRE to JS.
* Please let met know if you find it usefull or if you know how to improve it (especially the offset part) !
* https://github.com/Eartz/pregMatchAll.js
* camille.hodoul [cat] gmail.com
*/
function jsPregMatchAll(pattern,s,flag,offset) {
	var order = flag || "PREG_PATTERN_ORDER";
	var matches = [];
	
	if(typeof(offset)!=="undefined" && offset>0) {
		// try to reproduce the behavior of the offset parameter, but I'm not sure how to test it.
		// I have to rebuild a pattern.
		var ps = pattern.toString();
		var delimiter = ps.charAt(0);
		/*
		* FIXME : If the user has escaped his delimiter in the pattern, I should unescape it before passing it to the RegExp constructor.
		* but this should be done after the .join() ofc
		*/
		var t = ps.split(delimiter); 
        t.shift();
		var flags = t.pop();
		t[0] = ".{"+offset+"}"+t[0];
		ps = t.join(delimiter);
		
		pattern = new RegExp(ps,flags); // Have to rebuild it at runtime so no literal...
		
	}
	/**
	*	 If the flag is 2 or 3, I should init the matches array with n+1 arrays
	*    Where n = nb of capturing parentheses
	*/
	s.replace(pattern,function(){
			var args = [].slice.call(arguments);
			// Remove unnecessary elements from the args array
			var fullMatch = args.pop();
			var offset = args.pop();
			var substr = args[0];
			// args now only contains the matches
			if(order==="PREG_SET_ORDER") {
			  matches.push(args);
			}
			else if(order==="PREG_PATTERN_ORDER") {
			  var l = args.length;
			  if(!matches[0]) matches[0] = [];
			  matches[0].push(substr);
			  for(var i=1;i<l;i++) {
				  if(!matches[(i+1)]) matches[(i+1)] = [];
				  matches[(i+1)].push(args[i]);
			  }
			}
			else if(order==="PREG_OFFSET_CAPTURE") {
				if(!matches[0]) matches[0] = [];
				matches[0].push([args[0],offset]);
				var l = args.length;
				for(var i=1;i<l;i++) {
					if(!matches[i]) matches[i] = [];
					matches[i].push([args[i],fullMatch.indexOf(args[i])]);
				}
			}
	});
	return matches;
}

