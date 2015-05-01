/**
 * for one list box selector
 * left items in leftItems
 * right items in rightItems
 * call initList() and buttonListeners() in $(document).ready(function(){});
 * after populating leftItems and rightItems to initialize;
 */
var leftItems = [];
var rightItems = [];
var leftSelected = [];
var rightSelected = [];
var shift = false;
var ctrl = false;
 
function updateListHighlights() {
	for( var i = 0; i < leftItems.length; i++ ) {
		$("#left" + i).removeClass('highlight');
	}

	for( var i in leftSelected ) {
		$("#left" + leftSelected[i]).addClass('highlight');
	}
	
	for( var i = 0; i < rightItems.length; i++ ) {
		$("#right" + i).removeClass('highlight');
	}

	for( var i in rightSelected ) {
		$("#right" + rightSelected[i]).addClass('highlight');
	}
}

function listListeners() {
	$("p[id^='left']").click(function() {
		var n = $(this).attr('id').substring(4);
		console.log(n);
		if( shift && leftSelected.length > 0 ) {
			var leftBegin = leftSelected[0];
			var i = n < leftBegin ? n : leftBegin;
			var j = n < leftBegin ? leftBegin : n;
			for( leftSelected = []; i <= j; i++ ) {
				leftSelected.push( i );
			}
		} else if( ctrl && leftSelected.length > 0 ) {
			var find = false;
			for( var i in leftSelected ) {
				if( leftSelected[i] == n ) {
					find = true;
					leftSelected.splice(i,1);
					break;
				}
			}
			if( !find ) {
				leftSelected.push(n);
				leftSelected.sort(function(a,b){return a-b;});
			}
		} else {
			leftSelected = [];
			leftSelected.push(n);
		}
	
		updateListHighlights();
		updateButtons();
	});
	
	$("p[id^='right']").click(function() {
		var n = $(this).attr('id').substring(5);
		console.log(n);
		if( shift && rightSelected.length > 0 ) {
			var rightBegin = rightSelected[0];
			var i = n < rightBegin ? n : rightBegin;
			var j = n < rightBegin ? rightBegin : n;
			for( rightSelected = []; i <= j; i++ ) {
				rightSelected.push( i );
			}
		} else if( ctrl && rightSelected.length > 0 ) {
			var find = false;
			for( var i in rightSelected ) {
				if( rightSelected[i] == n ) {
					find = true;
					rightSelected.splice(i,1);
					break;
				}
			}
			if( !find ) {
				rightSelected.push(n);
				rightSelected.sort(function(a,b){return a-b;});
			}
		} else {
			rightSelected = [];
			rightSelected.push(n);
		}
	
		updateListHighlights();
		updateButtons();
	});
}

function updateButtons() {
	if( leftItems.length > 0 && leftSelected.length > 0 ) {
		$("#moveRight, #allRight").prop('disabled',false);
	} else {
		$("#moveRight, #allRight").prop('disabled',true);
	}

	if( rightItems.length > 0 && rightSelected.length > 0 ) {
		$("#moveLeft, #allLeft").prop('disabled',false);
	} else {
		$("#moveLeft, #allLeft").prop('disabled',true);
	}		
}

function initList() {
	var htmlStr = "";
	for( var i in leftItems ) {
		htmlStr += '<p id="left' + i + '">' + leftItems[i] 
					+ '</p>\n';
	}
	$("#leftBox").html( htmlStr );
	
	var htmlStr = "";
	for( var i in rightItems ) {
		htmlStr += '<p id="right' + i + '">' + rightItems[i] 
						+ '</p>\n';
	}				
	$("#rightBox").html( htmlStr );
	
	leftBegin = -1;
	rightBegin = -1;
	leftEnd = -1;
	rightEnd = -1;
	
	$('p[id^="left"], p[id^="right"]').mousedown(function(e) {
			if( e.ctrlKey || e.shiftKey ) {
				e.preventDefault();
			}
		});
	listListeners();
	updateButtons();
	updateListHighlights();
}

function buttonListeners() {
	$("#moveLeft").click(function() {
		for( var i = rightSelected.length - 1; i >= 0; i-- ) {
			leftItems.push(rightItems[rightSelected[i]]);
			rightItems.splice(rightSelected[i],1);
		}
		rightSelected = [];
		var temp = [];
		for( var i in leftSelected ) {
			temp.push( leftItems[leftSelected[i]] );
		}
		
		leftItems.sort(function(a,b) { 
			return a.toLowerCase() > b.toLowerCase() 
		});
		
		leftSelected = [];
		
		for( var i in leftItems ) {
			for( var j in temp ) {
				if( leftItems[i] === temp[j] ) {
					leftSelected.push(i);
					break;
				}
			}
		}
		initList();
	});

	$("#moveRight").click(function() {
		for( var i = leftSelected.length - 1; i >= 0; i-- ) {
			rightItems.push(leftItems[leftSelected[i]]);
			leftItems.splice(leftSelected[i],1);
		}
		leftSelected = [];
		
		var temp = [];
		for( var i in rightSelected ) {
			temp.push( rightItems[rightSelected[i]] );
		}
		
		rightItems.sort(function(a,b) { 
			return a.toLowerCase() > b.toLowerCase() 
		});
		
		rightSelected = [];
		
		for( var i in rightItems ) {
			for( var j in temp ) {
				if( rightItems[i] === temp[j] ) {
					rightSelected.push(i);
					break;
				}
			}
		}initList();
	});

	$("#allLeft").click(function() {
		for( var i in rightItems ) {
			leftItems.push(rightItems[i]);
		}
		rightItems = [];
		leftItems.sort(function(a,b) { 
			return a.toLowerCase() > b.toLowerCase() 
		});
		console.log( leftItems + "\n" + rightItems );
		initList();
	});

	$("#allRight").click(function() {
		for( var i in leftItems ) {
			rightItems.push(leftItems[i]);
		}
		leftItems = [];
		rightItems.sort(function(a,b) { 
			return a.toLowerCase() > b.toLowerCase() 
		});
		console.log( leftItems + "\n" + rightItems );
		initList();
	});
}

$(document).on('keydown keyup',function(e) {
	shift = e.shiftKey;
	ctrl = e.ctrlKey;
	return true;
});	
