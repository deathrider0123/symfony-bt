var $ = require('jquery');
$(document).ready(function() {
	$('.update_qty').click(function() { 
	var prod_id = this.id;
	alert(prod_id);
	     $.ajax({  
               url:        '/cart/product/remove',  
               type:       'POST',   
               dataType:   'json',  
               async:      true, 
				data  : {'id':prod_id},	
               success: function(data, status) { 
			   $("#"+prod_id).remove();
			   },  
               error : function(xhr, textStatus, errorThrown) {  
                  //alert('Ajax request failed.');  
				  
				  console.log("error");
               }  
            }); 
	});
	
	$('.update_qty_update').change(function()
	{
		var id= this.id;
		var value = this.value;
		var success_data = "";
		     $.ajax({  
               url:        '/cart/qty/update',  
               type:       'POST',   
               dataType:   'json',  
               async:      true, 
				data  : {'id':this.id,'qty':value},	
               success: function(data, status) { 
			   $('#cart_price_total').text('$'+JSON.stringify(data));
			   $('#cart_grand_total').text('$'+(parseInt(JSON.stringify(data))+10));
			   console.log(JSON.stringify(data));
			   $("#"+id).removeAttr("selected");
			   $("#"+id+" option[value='"+value+"']").attr("selected", "selected");
			   },  
               error : function(xhr, textStatus, errorThrown) {  
                  //alert('Ajax request failed.');  
				  
				  console.log("error");
               }  
            });
	});
 });