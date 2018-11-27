function getXMLHTTPRequest(){
	var req = false; 
	try{
		req = new XMLHttpRequest();
	}catch(err){
		try{
			req = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(err){
			try{
				req = new ActiveXObject("Microsoft.XMLHTTP");
				  }catch(err){
					req = false;
				}
		}
	}
	return req;
}