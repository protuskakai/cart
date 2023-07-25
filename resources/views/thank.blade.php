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
						      <form class="p-1 bg-grey rounded-lg drop-shadow-lg space-y-4" action="{{ route('payment') }}">
        <h1 class="text-xl font-light">Payment Details</h1>

        <!-- Name -->
        <div class="flex flex-col">
            <label for="amt">Amount</label>
            <input type="text" name="amt" id="amt" required class="peer border border-slate-400" value="{{ Cart::getTotal() }}" disabled>

            <p class="invisible peer-invalid:visible text-red-700 font-light">
                Please enter amount
            </p>
        </div>

        <!-- Email -->
        <div class="flex flex-col">
            <label for="telno">Tel No.</label>
            <input type="telno" name="telno" id="telno" required class="peer border border-slate-400">
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