@extends('frontend')
@section('content')
    <div class="container px-6 mx-auto">
        <h3 class="text-2xl font-medium text-gray-700 text-green-700  border-b-8 border-x-4
  border-y-4 border-blue-200 rounded-md shadow-md">Contacts</h3>
		
			
        <div class="grid grid-cols-1 gap-6 mt-6   sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-1">
               <div class="px-5 py-3">
                    <h6 class="text-gray-700 ">Email Address: nrelectronics@gmail.com</h6>
					<p class="text-gray-700">Tel. 0717411083</p>
                   
				   </div>	
		   <div>
							<br>
						  <form action="{{ route('products.list') }}" method="GET">
                            @csrf
                            
							<button class="px-11 py-2 text-red-800 bg-blue-300">Click here to shop again</button>
                          </form>
                        </div>
		 </div>  
@endsection