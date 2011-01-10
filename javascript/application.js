jQuery(document).ready(function() {
	//global vars
	var searchBoxInput = jQuery("#header_search_form input");
	var searchBoxDefaultName = "Skriv inn søkeord";

	//Searchbox show/hide default text if needed  
	searchBoxInput.focus(function(){  
		if($(this).val() == searchBoxDefaultName) $(this).val(""); 
	});  
	searchBoxInput.blur(function(){  
		if($(this).val() == "") $(this).val(searchBoxDefaultName);  
	}); 
	
  jQuery("#featured_holder").carousel( { direction: "vertical", autoSlide: true, pagination: true, autoSlideInterval: 5000 }  );
})