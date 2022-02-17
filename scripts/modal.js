<script>
$(document).ready(function() {
	$('#insert').on('click', function() {
		var name = $('#name').val();
		var position = $('#position').val();
		var radio = $('#radio').val();
          var dsm = $('#dsm').val();
		var flashlight = $('#flashlight').val();
          var tourniquet = $('#tourniquet').val();
          var utility_bag = $('#utility_bag').val();
          event.preventDefault();  
           if($('#name').val() == '') 
           {  
                alert("Must Select Name");  
           }  
           else if($('#position').val() == '')  
           {  
                alert("Must Choose Position: <br> use MISC if no relative position");  
           }  
           else if($('#radio').val() == '')  
           {  
                alert("Radio Required");  
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
                         let baseURL = "index.php";
                         let newURL = baseURL.concat(dataResult);
                         window.location.replace(newURL);

                         }
                         
                    
               });
		}

	})
});
</script>