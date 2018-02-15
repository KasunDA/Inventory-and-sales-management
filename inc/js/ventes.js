
function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;	
	if(rowCount < 5){	// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	
		var nom = $(".nom0").val() ;
		var qntite = $(".qty0").val();
		alert(nom+' -- '+qntite);
	}else{
		 alert("Le nombre de produit maximale est a 05.");
			   
	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
		var row = table.rows[i];
		var chkbox = row.cells[0].childNodes[0];
		if(null != chkbox && false == chkbox.checked) {
			if(rowCount <= 1) {		// limit the user from removing all the fields
				alert("Vous ne pouvez pas retirer tout les prosuits.");
				break;
			}
			table.deleteRow(i);
			rowCount--;
			i--;
		}
	}
}


var catclient = "<?php echo $catclient;  ?>";
      		var idcatclient = "<?php echo $idcatclient;  ?>";
      		var colprix = "<?php echo $colprix;  ?>";

      		function calcule () {
      			 q0 = q1 = q2 = q3 = q4 = p1 = p2 = p3 = p4 = 0;
      			 q0 = parseFloat($("#quantite0").val());
      			 if(isNaN(q0)) q0 = 0;      			 
	             p0 = parseFloat($("#total0").val());
	             if(isNaN(p0)) p0 = 0; 
	             q1 = parseFloat($("#quantite1").val());
	             if(isNaN(q1)) q1 = 0; 	          
	             p1 = parseFloat($("#total1").val());	             
	             if(isNaN(p1)) p1 = 0;
	             q2 = parseFloat($("#quantite2").val());
	             if(isNaN(q2)) q2 = 0;
	             p2 = parseFloat($("#total2").val());
	             if(isNaN(p2)) p2 = 0;
	             q3 = parseFloat($("#quantite3").val());
	             if(isNaN(q3)) q3 = 0;
	             p3 = parseFloat($("#total3").val());
	             if(isNaN(p3)) p3 = 0;
	             q4 = parseFloat($("#quantite4").val());
	             if(isNaN(q4)) q4 = 0;
	             p4 = parseFloat($("#total4").val());
	             if(isNaN(p4)) p4 = 0;
	             $("#totale1").val(parseFloat(q0+q1+q2+q3+q4));
      			 $("#totale2").val(parseFloat(p0+p1+p2+p3+p4));
      		}
      		
		$("#quantite0").change(function() { 

			 var nom0 = $("#nom0").val();
			
			 var tab = 'nomprod='+nom0+'&colprix='+colprix;			
			
	         url_send = '<?php echo site_url("ProduitController/loadPrixU")?>'; 
	       
	          $.ajax({
	            url: url_send,
	            type: "GET",
	            data: tab,	           
	            async: false,
	            success: function(arg){	           		
	             paie = parseFloat(arg);
	             var qntite = parseFloat($("#quantite0").val());
	             $("#prix0").val(paie);
	             $("#total0").val(qntite*paie);
	             
      			 calcule();     			 

	            },
	            error: function(){            
	              alert('error ');
	            }
	            });                  
           });

		$("#quantite1").change(function() { 

			 var nom1 = $("#nom1").val();
			
			 var tab = 'nomprod='+nom1+'&colprix='+colprix;			
			
	         url_send = '<?php echo site_url("ProduitController/loadPrixU")?>'; 
	       
	          $.ajax({
	            url: url_send,
	            type: "GET",
	            data: tab,	           
	            async: false,
	            success: function(arg){	           		
	              paie = parseFloat(arg);
	             var qntite = parseFloat($("#quantite1").val());
	             $("#prix1").val(paie);
	             $("#total1").val(qntite*paie);

      			 calcule();  
	             
	            },
	            error: function(){            
	              alert('error ');
	            }
	            });                  
           });	

		$("#quantite2").change(function() { 

			 var nom2 = $("#nom2").val();
			
			 var tab = 'nomprod='+nom2+'&colprix='+colprix;			
			
	         url_send = '<?php echo site_url("ProduitController/loadPrixU")?>'; 
	       
	          $.ajax({
	            url: url_send,
	            type: "GET",
	            data: tab,	           
	            async: false,
	            success: function(arg){	           		
	              paie = parseFloat(arg);
	             var qntite = parseFloat($("#quantite2").val());
	             $("#prix2").val(paie);
	             $("#total2").val(qntite*paie);
	             
      			 calcule();  
	             
	            },
	            error: function(){            
	              alert('error ');
	            }
	            });                  
           });	

		$("#quantite3").change(function() { 

			 var nom3 = $("#nom3").val();
			
			 var tab = 'nomprod='+nom3+'&colprix='+colprix;			
			
	         url_send = '<?php echo site_url("ProduitController/loadPrixU")?>'; 
	       
	          $.ajax({
	            url: url_send,
	            type: "GET",
	            data: tab,	           
	            async: false,
	            success: function(arg){	           		
	              paie = parseFloat(arg);
	             var qntite = parseFloat($("#quantite3").val());
	             $("#prix3").val(paie);
	             $("#total3").val(qntite*paie);
	             
      			 calcule();  
	             
	            },
	            error: function(){            
	              alert('error ');
	            }
	            });                  
           });	
		
		$("#quantite4").change(function() { 

			 var nom4 = $("#nom4").val();
			
			 var tab = 'nomprod='+nom4+'&colprix='+colprix;			
			
	         url_send = '<?php echo site_url("ProduitController/loadPrixU")?>'; 
	       
	          $.ajax({
	            url: url_send,
	            type: "GET",
	            data: tab,	           
	            async: false,
	            success: function(arg){	           		
	             paie = parseFloat(arg);
	             var qntite = parseFloat($("#quantite4").val());
	             $("#prix4").val(paie);
	             $("#total4").val(qntite*paie);

      			 calcule();  
	             
	            },
	            error: function(){            
	              alert('error ');
	            }
	            });                  
           });	