(function() {

	var wb = {
		
	};

	function runObject() {
    for (var key in wb){
      if (wb[key].test()){
        wb[key].run();
      }
    }
  }
  
  runObject();

}());