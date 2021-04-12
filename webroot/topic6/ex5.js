const max_val = 15;

document.write("<table>");

for(let y = 0; y < max_val+1; y++){
	
	document.write("<tr>");
	
	for(let x = 0; x < max_val + 1; x++){
		if(y == 0){ // Top row
			
			document.write("<th>");
			
			if(x == 0){ // First column
				document.write("X");
			} else{
				document.write(x);
			}
			
			document.write("</th>");
		} else{
			if(x == 0){ // First column
			
				document.write("<th>" + y + "</th>");
			}else{
				document.write("<td>" + (x * y) + "</td>")
			}
		}
	}
	
	document.write("</tr>");
}

document.write("</table>");