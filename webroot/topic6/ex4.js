var arr = [1, 2, 2, 3, 7, 9];

alert("Mean: " + calcMean(arr));
alert("Median: " + calcMedian(arr));


function calcMean(array){
	let sum = 0;
	
	array.forEach(element => sum += element);
	
	let mean = sum / array.length;
	
	return mean;
}

function calcMedian(array){
	let index = ((array.length - 1) / 2);
	
	console.log("index: " + index);
	
	let sum = 0;
	
	sum += array[Math.floor(index)];
	sum += array[Math.ceil(index)];
	
	let median = sum / 2;
	
	return median;
}
