
/** FUNÇÃO DE PESQUISA ASSINCRONO SETROES INTERNOS **/

			function limparDestinatario(){
				
				$(".inputIDDestino").val('');
		  		$(".inputDestino").val('');
		  		$(".inputDestino").focus();
				
			}
			
			function buscarDestinatario(){

			    busca = $("#ministrante").val();
			    if(busca!=''){
			    	$.ajax({
			    		  url: "http://localhost/semanauniversitaria/painel/minicursos/externo_informacoes/"+busca,
			    		  type: "POST",
			    		  dataType: "json",
			    		  data: 'busca='+busca,
			    		  success: function(json){
			    			  
				    			if(json == 1){
				  					alert('Destinatário não cadastrado.');
				  					$("#ministrante").val('');
				  					$("#ministrante_cod").val('');
				  					$("#ministrante").focus();
				  					
				      		  	}else{
				      		  		$("#ministrante_cod").val(json.id);
				      		  		$("#ministrante").val(json.nome);

				  					$("#curriculo").focus();
				      		  	}
			      		  	
			    		  }
			    		    
			    		});
			    	

			    }
			    else{
			        $("#ministrante").val('');
			        $("#ministrante").focus();
			        //window.alert("O Destinatário deve ser preenchido");
			    }

			}

			function buscarcoautor1(){

			    busca = $("#coautor1").val();
			    if(busca!=''){
			    	$.ajax({
			    		  url: "http://localhost/semanauniversitaria/painel/artigos/externo_informacoes/"+busca,
			    		  type: "POST",
			    		  dataType: "json",
			    		  data: 'busca='+busca,
			    		  success: function(json){
			    			  
				    			if(json == 1){
				  					alert('Coautor 1 não cadastrado.');
				  					$("#coautor1").val('');
				  					$("#coautor1_cod").val('');
				  					$("#coautor1").focus();
				  					
				      		  	}else{
				      		  		$("#coautor1_cod").val(json.id);
				      		  		$("#coautor1").val(json.nome);

				  					$("#coautor2").focus();
				      		  	}
			      		  	
			    		  }
			    		    
			    		});
			    	

			    }
			    else{
			        $("#coautor1").val('');
			        $("#coautor1").focus();
			        //window.alert("O Destinatário deve ser preenchido");
			    }

			}
			function buscarcoautor2(){

			    busca = $("#coautor2").val();
			    if(busca!=''){
			    	$.ajax({
			    		  url: "http://localhost/semanauniversitaria/painel/artigos/externo_informacoes/"+busca,
			    		  type: "POST",
			    		  dataType: "json",
			    		  data: 'busca='+busca,
			    		  success: function(json){
			    			  
				    			if(json == 1){
				  					alert('Coautor 2 não cadastrado.');
				  					$("#coautor2").val('');
				  					$("#coautor2_cod").val('');
				  					$("#coautor2").focus();
				  					
				      		  	}else{
				      		  		$("#coautor2_cod").val(json.id);
				      		  		$("#coautor2").val(json.nome);

				      		  		$("#coautor3").focus();

				      		  	}
			      		  	
			    		  }
			    		    
			    		});
			    	

			    }
			    else{
			        $("#coautor2").val('');
			        $("#coautor2").focus();
			        //window.alert("O Destinatário deve ser preenchido");
			    }

			}

			function buscarcoautor3(){

			    busca = $("#coautor3").val();
			    if(busca!=''){
			    	$.ajax({
			    		  url: "http://localhost/semanauniversitaria/painel/artigos/externo_informacoes/"+busca,
			    		  type: "POST",
			    		  dataType: "json",
			    		  data: 'busca='+busca,
			    		  success: function(json){
			    			  
				    			if(json == 1){
				  					alert('Coautor 3 não cadastrado.');
				  					$("#coautor3").val('');
				  					$("#coautor3_cod").val('');
				  					$("#coautor3").focus();
				  					
				      		  	}else{
				      		  		$("#coautor3_cod").val(json.id);
				      		  		$("#coautor3").val(json.nome);

				      		  		$("#doc").focus();

				      		  	}
			      		  	
			    		  }
			    		    
			    		});
			    	

			    }
			    else{
			        $("#coautor3").val('');
			        $("#coautor3").focus();
			        //window.alert("O Destinatário deve ser preenchido");
			    }

			}
			
			
			
			$(function () {
				  $('[data-toggle="tooltip"]').tooltip()
				})
			
			$(document).ready(function () {


				$("#teste").hide();
				
				   $("input:radio[name=opcao]").click(function () {  
				      if( $("#inputTipoRecebido").is(':checked') ){
				    	  	$("#CodigoRastreamento").hide();
				      } 
				      if( $("#inputTipoExpedido").is(':checked') ){
				    	  	$("#CodigoRastreamento").show();
				    	  	
				      }
				  
				   });

				 
				});
			
			$(function(){
				$("#datepicker").datepicker({
					dateFormat: 'dd/mm/yy',
				    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
				    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
				    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
				    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
				    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
				    nextText: 'Próximo',
				    prevText: 'Anterior'
				});
			})
			


