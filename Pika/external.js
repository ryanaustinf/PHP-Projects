function home() {
	location = '/Pika';
}

function checkNaN() {
	var str = document.getElementById("smiles").value;
	console.log(str);
	var str2 = str + ( isNaN(str) ? ' is not a number' : ' is a number' );
	console.log( str2 );
	var ret;
	if( !isNaN(str) ) {
		ret = true;
		if( str * 1.0 < 0 ) {
			alert('Input is negative. Please input a non-negative number.');
			ret = false;
		} 
	} else {
		alert( '"' + str + '"' + ' is not a fucking number, you fucking fuck! Please input a non-negative number.');
		ret = false;
	}

	return ret;
}