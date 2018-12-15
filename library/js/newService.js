 var script = document.createElement('script');
 script.src = "/jquery-1.11.3.min.js";
 script.type = "text/javascript";


 $(document).ready(function(){
 	alert('ready');

 	$('#service_input_r').hide();
	var n = $('#service_select').val();


	$('#service_select').change(function(){
	
	if( $('#service_select').val() != "others"){
		$('#service_select').css('opacity', 1)
		$('#service_input').hide()
	}else{
		$('#service_input').fadeIn(500, 'easeOutSine',function(){
			$('#service_select').fadeTo(500, .34, function(){
			})

		} //end fadeIn call back function
		); //end fadeIn
	}//end else


})//end change

$('#submit').bind({
	'click' : function(e){
	//	e.preventDefault()
		$('#service_form :input:not(#submit, :hidden)').each(function(){
			//alert($(this).attr('name'))
			if($(this).val() == ""){
				e.preventDefault()
				$(this).css('border','1px solid rgba(206,4,56,.6)')
				$('.info').html('<p id="error_msg">please fill all required fields!</p>')
				//$('#error_msg').next().focus();
			}else{
				$(this).css('border','')
			}
		})//end each
		var n_opa = $('#service_select').css('opacity')
		//alert(n)
		default_val = $('#service_select').val()
		if( $('#service_select').val() == 'select Service Type' && n_opa == 1){
			e.preventDefault()
			alert('please select a service type')
		}

		$('.fin input[type="checkbox"]:checked').each(function(){
			var t = $(this).attr('name');
			alert(t);
		})	

			$('#service_form').validate({
				rules:{
					 children_male, children_female : {required: true,
										digit: true,
											rangelength: [5,7]},
					 date : {
					 		date : true,
					 		required: true
					 }//end obj dt
				}
			})//end validate
	}//end click for submit bind
}) //end bind for submit

/*
$('.fin span').click(function(){
	$(this).toggleClass('glyphicon-minus')
	$(this).toggleClass('glyphicon-plus')
	$(this).toggleClass('click')
	var id = $(this).attr('id')
	var in_id = "in_"+ id
		var t = $(this).attr('class')
		//alert(t)
		if(t == "glyphicon gly glyphicon-minus click"){
		$(this).after('<div ><input class="aft_fin" type=""text id=" '+ in_id +'" /></div>')
	}
	if(t != "glyphicon gly glyphicon-minus click"){
		//$('input[id="' + in_id+'"]').replaceWith(" ")
		$(this).next().remove()
	}
})




*/

var namm = $('.fin label').attr('for')
$('.fin input').each(function(){
	$(this).hide()
})


$('.fin span').click(function(){
	$(this).toggleClass('glyphicon-minus')
	$(this).toggleClass('glyphicon-plus')
	$(this).toggleClass('click')
	var id = $(this).attr('id')
	var in_id = "in_"+ id
var t = $(this).attr('class')
		//alert(t)
		if(t == "glyphicon gly glyphicon-minus click"){
			$(this).next().show()
	}
	if(t != "glyphicon gly glyphicon-minus click"){
		//$('input[id="' + in_id+'"]').replaceWith(" ")
		$(this).next().hide()
	}
})

$('.fin div label:odd').css('margin-left','150px')


/*
$('#submit').fancybox({ //reference projectR/trialPost.php
				maxWidth 	: 800,
				maxHeight 	: 600,
				width 		: '70%',
				height 		: '70%',
				autoSize 	: false,
				closeClick	: false, //or true
				openEffect 	: 'none',
				closeEffect : 'none',
				nextEffect 	: 'none',
				prevEffect 	: 'none',
				padding 	: 0,
				margin 		: [20, 60, 20, 60],
				titlePosition : 'inside'
}); //end fancybox
 */


//$('#panex').load("main.php #ajax");
// });//end reax
});