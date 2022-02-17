<script>
$(document).ready(function() {
	$('#insert').on('click', function() {
		var product = $('#product').val();
		var cord_color = $('#cord_color').val();
		var quantity = $('#quantity').val();
          var purchased_product = $('#purchased_component').val();
		var price = $('#price').val();
          var sale_type = $('#sale_type').val();
          var orderid = $('#order_id').val();
          var orderid = $('#order_id').val();
          event.preventDefault();  
           if($('#product').val() == ''&& purchased_product=="") 
           {  
                alert("Choose a product");  
           }  
           else if($('#cord_color').val() == ''&& purchased_product=="")  
           {  
                alert("Cord Color Required");  
           }  
           else if($('#quantity').val() == '')  
           {  
                alert("Set quantity");  
           }  
           else if($('#price').val() == '')  
           {  
                alert("Set Price");  
           }
           else if($('#sale_type').val() == '')  
           {  
                alert("Set Sale Type");  
           }
           else  
           {
               $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: {
                         product: product,
                         cord_color: cord_color,
                         purchased_product: purchased_product,
                         quantity: quantity,
                         price: price,
                         sale_type: sale_type,
                         orderid: orderid				
                    },
                    beforeSend:function(){  
                              $('#insert').val("Inserting");},

                    success: function(dataResult){

                         var dataResult = dataResult;
                         var inputVal = document.getElementById("myInput").value;

                         let baseURL = "http://www.ims.treehuggersystems.com/sales/add_sale_manually.php?id=";
                         let newURL = baseURL.concat(dataResult);
                         window.location.replace(newURL);

                         }
                         
                    
               });
		}

	})
});

</script>