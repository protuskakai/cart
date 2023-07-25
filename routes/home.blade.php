@extends('frontend')


@section('content')
          <main class="my-8">
            <div class="container px-6 mx-auto">
                <div class="flex justify-center my-6">
                    <div class="flex flex-col w-full p-2 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-2/5 lg:w-2/5">
                     
                        <h3 class="text-3xl text-bold">Home</h3>
                      <div>
							<br>
						  <form action="{{ route('products.list') }}" method="GET">
                            @csrf
                            
							<button class="px-11 py-2 text-red-800 bg-blue-300">Click here to start shopping</button>
                          </form>
                        </div>
                   
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
						      
                        </div> 
						   
						


                      
                </div>
			</div>
		</div>	
    @endsection