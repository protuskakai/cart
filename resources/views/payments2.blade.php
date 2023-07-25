@extends('frontend')


@section('content')
          <main class="my-8">
            <div class="container px-6 mx-auto">
                <div class="flex justify-center my-6">
                    <div class="flex flex-col w-full p-2 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-2/5 lg:w-2/5">
                     
                        <h3 class="text-3xl text-bold">Check Out</h3>
                      


                   
                    </div>
					
					
                  
				  <br>
				  <br>
				  
				    
            </div>
        </main>
		<div class="container px-6 mx-auto">
            <div class="flex justify-center my-6">
				 <div class="flex flex-col w-full p-2 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-2/5 lg:w-2/5">
                       
                     
                        <div>
							<br>
			<!	for mpesa payments		      <form class="p-1 bg-grey rounded-lg drop-shadow-lg space-y-4" action="{{ route('payment') }}"> 
		<form class="p-1 bg-grey rounded-lg drop-shadow-lg space-y-4" action="{{ route('tinypesa2') }}"> 
		@csrf
			
			<h1 class="text-xl font-light"><b>Payment Details</b></h1>

        <!-- Name -->
		
        <div class="flex flex-col">
            <label for="amt">Amount [ Kshs ]</label>
            <input type="text" name="amt" id="amt" required class="peer pl-3 pt-3 border-t-2 border-r-2 border-l-2 border-b-2 border-grey-700" value="{{ Cart::getTotal() }} " disabled>
             <input type="hidden" name="amt2" id="amt2" required class="peer " value="{{ Cart::getTotal() }}" >
            <p class="invisible peer-invalid:visible text-red-700 font-light">
                Please enter amount
            </p>
        </div>

        <!-- Email -->
        <div class="flex flex-col">
            <label for="telno">Tel No.[254---------]</label>
			
            <input type="telno" name="telno" id="telno" required class="peer pl-3 pt-3  border-t-2 border-r-2 border-l-2 border-b-2 border-grey-700" >
            <p class="invisible peer-invalid:visible text-red-700 font-light">
                Please enter a valid telephone no.
            </p>
        </div>

        
        <button type="submit" class="px-11 py-2 text-red-800 bg-blue-300">Pay</button>
		
    </form>
	
                        </div> 
						   
						


                      
                </div>
			</div>
		</div>	
    @endsection