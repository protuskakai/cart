<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to cart</title>
    <link href="./css/tailwind.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	

	<style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);
  
       
        .my-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .my-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
        .login-form
        {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }
        .login-form .row
        {
            margin-left: 0;
            margin-right: 0;
        }
		.modal
		{
		   width: 500px;
		   height: 500px;
		   position: relative;
		   left: 50%;
		   top: 50%; 
		   margin-left: -150px;
		   margin-top: -150px;
        }
		.peer{
			border: 1pxsolid #999;
		}
		.w-20{
			border-radius: 60%;
		}
		.h-12 th{
			border-bottom: .5px solid grey;
			border-top: .5px solid grey;
		}
    </style>	

</head>

<body>
    <div  class="bg-white">
        <header>
            <div class="container px-6 py-3 mx-auto">
                <div class="flex items-center justify-between">
                    
                    
                    <div class="flex items-center justify-end w-full">
                        <button" class="mx-4 text-gray-600 focus:outline-none sm:mx-0">
                            
                        </button>
                    </div>
                </div>
                <nav  class="p-6 mt-4 text-white bg-green-500 sm:flex sm:justify-center sm:items-center">
                    <div class="flex flex-col sm:flex-row ">
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="/">Home</a>
                        <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="{{ route('products.list')}}">Shop</a>
                        <a href="{{ route('cart.list') }}" class="flex items-center">
                            <svg class="w-5 h-5" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
							
                           <span class="w3-badge w3-red" >{{ Cart::getTotalQuantity()}}</span>
                        </a>
                        
                    </div>
                </nav>
            </div>
        </header>
        
        <main class="my-8">
            @yield('content')
        </main>
    
	
    </div>
	<div class="container px-6 py-3 mx-auto">
		<footer  class="p-4 mt-2 text-white bg-green-500 sm:flex sm:justify-center sm:items-center">
                <div class="flex flex-col sm:flex-row ">
                <a class="mt-3 hover:underline sm:mx-3 sm:mt-0" href="/">Copyright Cherabooks 2022</a> 
        </footer>
	</div>
	
	
	
	
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function getid(btn)
{
	//alert(btn.id);
	 $("#"+btn).modal('show');
}
$(document).ready(function() {
    $('.img').click(function(e) {
        e.preventDefault();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: 'update',
            data: { abc: 123 },
          cache: false,
          contentType: false,
          processData: false,
			dataType: 'text',
            success: function(response) {
				
                var jsonData = JSON.parse(response);
             //  console.log(response);
			 //  console.log(this.id);
                // user is logged in successfully in the back-end
                // let's redirect
			  
                if (jsonData.status == "success") {
			    /*		
					Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success',
				'successddd'
				
              )  */
			     //  alert('success');
                      //    $("#myModal").modal('show');
				        // $("#myModal").modal('show');
                } else {
                    //alert('error');
                }
            },
            error: function(jqXhr, textStatus, errorMessage) {
                console.log("Error: ", errorMessage);
                console.log(this.url);
            }
        });
    });
});
<div>

/*
$(".img").click(function(){
	// $("#show_image_popup").fadeIn();
	//alert("eeeee");
	  alert ("sddddfd");
     // alert(event.toElement.id);
})
	//$("#popup-modal").show();
*/
/*
function getId(btn)
{	
   $.ajax
   	({
          url: '{{ route('update') }}',		  
          method: 'POST',
          data: { abc: 123 },
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'JSON',
          success: function(response) 
		  {
            if (response.status == 200) 
					{
						console.log("done");
					}
          },
		  error: function(jqXhr, textStatus, errorMessage)
		  {
					console.log("Error: ", errorMessage);			
					console.log(this.url);
          }  
	}); 
	
	
}
*/
</script>
</body>

</html>