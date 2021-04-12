let arr = new Array();

for(let i = 0; i < 5; i++){
	arr.push(prompt("Insert next number: "));
}

alert("Largest: " + Math.max(...arr));