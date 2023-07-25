<?php

namespace App\Http\Controllers;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response;
use App\Models\Orders;
use App\Models\Payments;
//use Illuminate\Support\Facades\Response;

class CheckoutController extends Controller
{
      public function mpassword()
    {
         $timestamp=Carbon::rawParse('now')->format('YmdHms');
         $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
		 $businessshortcode=174379;
		 $passwordd=base64_encode($businessshortcode.$passkey.$timestamp);
		 return $passwordd;
		
	}
	
	public function newaccesstoken()
    {
		$consumer_key="jl0A493BVtqSJRT0D91mMmxmuZkpmZGE";
		
        $secret="q4jy5gD1gSqvp4Pn";
		$credentials=base64_encode($consumer_key.":".$secret);
		$url="https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials."Content-Type:application/json"));
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$curl_response = curl_exec($curl);
		$access_token = json_decode($curl_response);
		
		
	//	echo $curl_response;
		curl_close($curl);
	//	echo $access_token->access_token;
		return $access_token->access_token;
		
    }
	public function stkpush(Request $request)
    {
		$amt = \Cart::getTotal();
		$telno=$request->telno;
		$amt=1;
		$telno='254717411083';
	//	echo  $telno;
        $url="https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest";
		
		
		$curl_post_data = [	
			'BusinessShortCode'=> 174379,
			'Password'=>$this->mpassword(),
			'Timestamp'=>Carbon::rawParse('now')->format('YmdHms'),
			'TransactionType'=> 'CustomerPayBillOnline',
			'Amount'=> $amt,
			'PartyA'=> $telno,
			'PartyB'=> 174379,
			'PhoneNumber'=> $telno,
			'CallBackURL'=> 'https://9d70-105-160-101-245.eu.ngrok.io/api/callback',
			'AccountReference'=> 'Shalom Royal Quarters',
			'TransactionDesc'=> 'lipa na mpesa'
		];
	
		$data_string = json_encode($curl_post_data);
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		//$acess="CKR8uZHyEGqRTrDDN0hDijwkuxxJ";
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->newaccesstoken()));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	//	$curl_response = curl_exec($curl);
	//	echo $curl_response;
		if($curl_response = curl_exec($curl) )
		{
		   return $curl_response;
		//   return view('products.list',['empss'=>$curl_response]);
		 //  return view('thanks');
		  $cartItems = \Cart::getContent();
		  echo $cartItems;
	// save cartitems as orders	  
	  foreach($cartItems as $items)	
	  {	  
		$item_no = $items->id;
		$item_name = $items->name;
		$price = $items->price;
		$qty = $items->quantity;
		
	
		$empData = ['item_id' => $item_no, 'item_name' => $items->name, 'price' => $price, 'tel_no' => $telno, 'qty' => $qty,'tot_amt'=> $amt];
		Orders::create($empData);
	  }
	  
	 //clear cart contents  
		  \Cart::clear();

      //  session()->flash('success', 'All Item Cart Clear Successfully !');



      // call confirmation/thanks view
		 // return redirect()->route('cart.thanks');
		//  return redirect()->route('registerurl');
		//  return redirect()->route('https://dd71-154-122-117-56.in.ngrok.io/api/callbackurl');
		  
		// return redirect()->route('validation');
		// return redirect()->route('confirmation');
		 }else
		 {
			 return "STK PUSH FAILED!!";
		 }
		
    }
	public function thanks(Request $request)
    {
		return view('thanks');
		
	}
	
   public function tinypesa()
    {
	   return view('tinypesa')	;
	}
	
   public function tinypesa2(Request $request)
   {
	   /* for tinypesa view 
	   echo $request->phone_number;
	   $amount = '30';
	   $phonenumber=$request->phone_number;
	   
	   */
	   // $amount = '30';
	   $amount=$request->amt2;
	   $phonenumber=$request->telno;
	 //  echo $request->amt2;
	   //	if(isset($_POST['submit'])){

 //   $amount = '2'; //Amount to transact 
 //   $phonenumber = $_POST['phone-number']; // Phone number paying
  //  echo $phonenumber;
    $Account_no = 'COMRADE MARKET'; // Enter account number optional
    $url = 'https://tinypesa.com/api/v1/express/initialize';
    $data = array(
        'amount' => $amount,
        'msisdn' => $phonenumber,
        'account_no'=>$Account_no
    );
    $headers = array(
        'Content-Type: application/x-www-form-urlencoded',
      //  'ApiKey: P8iuPZZYcK7' // Replace with your api key
		     'ApiKey: 1rR8d5m8BjN' //
     );
    $info = http_build_query($data);
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	//	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		//	curl_setopt($curl, CURLOPT_HEADER, false);
	
	//	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    $msg_resp = json_decode($resp);
  // echo "amount".$amount;
  // echo "phone".$phonenumber;
  // echo "account".$Account_no;
  // echo "response".$resp;
    
    if ($msg_resp ->success == 'true')
		{
			//  	echo "WAIT FOR  STK POP UP";
				
		                  $cartItems = \Cart::getContent();
						  echo $cartItems;
					// save cartitems as orders	  
					  foreach($cartItems as $items)	
					  {	  
						$item_no = $items->id;
						$item_name = $items->name;
						$price = $items->price;
						$qty = $items->quantity;
						
					
						$empData = ['item_id' => $phonenumber, 'item_name' => $items->name, 'price' => $price, 'tel_no' => $phonenumber, 'qty' => $qty,'tot_amt'=> $amount];
						Orders::create($empData);
					  }
					  
					    //clear cart contents  
						  \Cart::clear();
					    return redirect()->route('cart.thanks');
						//registerurl
					//	 return redirect()->route('registerurl');
					//	return redirect()->route('https://da81-105-160-45-253.in.ngrok.io/callback');
					//	dd($request->all());
						
			} else
    		{
				echo "Transaction Failed";
       
        }
		
   }
	public function callback(Request $request)
	{
			 header("Content-Type: application/json");

    $response = '{
        "ResultCode": 0, 
        "ResultDesc": "Confirmation Received Successfully"
    }';
 
     // DATA
    $mpesaResponse = file_get_contents('php://input');
    echo $mpesaResponse;
     // log the response
    $logFile = "M_PESAConfirmationResponse.txt";
 
     // write to file
    $log = fopen($logFile, "a");
 
    fwrite($log, $mpesaResponse);
    fclose($log);
 
    echo $response;

		
	}
	
	public function registerurl()
	{
		
		$ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->newaccesstoken()));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(

				'ShortCode'=>600986,

				'ResponseType'=>'Completed',

				'ConfirmationURL'=>"https://9d70-105-160-101-245.eu.ngrok.io/api/callback",

				'ValidationURL'=>"https://9d70-105-160-101-245.eu.ngrok.io/api/validation",

			  )));

			$response     = curl_exec($ch);

			curl_close($ch);

			echo $response;
	}
	
	public function confirmation(Request $request)
	{
		$content=json_decode($request->getContent());    
         echo $content;	
    /*   
		$mpesa_transaction = new MpesaTrx();
		$mpesa_transaction->TransactionType = $content->TransactionType;
		$mpesa_transaction->TransID = $content->TransID;
		$mpesa_transaction->TransTime = $content->TransTime; 
		$mpesa_transaction->TransAmount = $content->TransAmount;
		$mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
		$mpesa_transaction->BillRefNumber = $content->BillRefNumber;
		$mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
		$mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
		$mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
		$mpesa_transaction->MSISDN = $content->MSISDN;
		$mpesa_transaction->FirstName = $content->FirstName;
		$mpesa_transaction->MiddleName = $content->MiddleName;
		$mpesa_transaction->LastName = $content->LastName;
		$mpesa_transaction->save();
		// Responding to the confirmation request
		
		*/
		$response = new Response();
		$response->headers->set("Content-Type","text/html; characterset=utf-8");
		$response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
		return $response;
	}
	public function createvalidationresponse($result_code,$result_description)
	{
		$result=json_encode(["ResultCode"=>$result_code,"ResultDesc"=>$result_description]);
		$response= new Response();
		$response->headers->set("Content-Type","application/json, character=utf-8");
		$response->setContent($result);
		return $response;
	}
	public function validation(Request $request)
	{
		 $result_code= "0";
		 $result_description="Accepted validation request.";
		 return $this->createvalidationresponse($result_code,$result_description);
	}
	public function mpesaresponse(Request $request)
	{
    	$content=json_decode($request->getContent());    
         echo "response".$content;	
   // $transaction=new mpesatransaction;
   // $transaction->response=json_encode($response);
   // $transaction->save();

	}
	public function confirmation2(Request $request)
	{
				header("Content-Type: application/json");

			$response = '
			{
				"ResultCode": 0, 
				"ResultDesc": "Confirmation Received Successfully"
			}';
		 
			 // DATA
			$mpesaResponse = file_get_contents('php://input');
		 
			 // log the response
			$logFile = "M_PESAConfirmationResponse.txt";
			echo $mpesaResponse;
			 // write to file
			$log = fopen($logFile, "a");
		 
			fwrite($log, $mpesaResponse);
			fclose($log);
		 
			echo $response;
	}
	public function confirmation3()
	{
		 $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate';

			$access_token =$this->newaccesstoken(); // check file mpesa_accesstoken.php.    
			$ShortCode  = '600979'; // Shortcode. Same as the one on register_url.php
			$amount     = '1'; // amount the client/we are paying to the paybill
			$msisdn     = '254717411083'; // phone number paying 
			$billRef    = 'test'; // This is anything that helps identify the specific transaction. Can be a clients ID, Account Number, Invoice amount, cart no.. etc
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
			$curl_post_data = array
			(
				   'ShortCode' => $ShortCode,
				   'CommandID' => 'CustomerPayBillOnline',
				   'Amount' => $amount,
				   'Msisdn' => $msisdn,
				   'BillRefNumber' => $billRef
			);
			$data_string = json_encode($curl_post_data);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
			$curl_response = curl_exec($curl);
			print_r($curl_response);
			echo $curl_response;
	}
	
	public function tinypesa_calback()
	{
		
		header("Content-Type: application/json");

		$stkCallbackResponse = file_get_contents('php://input');
		$logFile = "stkTinypesaResponse.json";


		$log = fopen($logFile, "a");
		 $log2 = fopen('test2.json', "w");
		fwrite($log, $stkCallbackResponse);
		fwrite($log2, $stkCallbackResponse);
		fclose($log);
		fclose($log2);

       
			
		$log2 = fopen('test2.json', "r");
		 while(!feof($log2))
 			{	
     			$line= fgets($log2);
    			// echo "length=".strlen($line);
          		 $stkCallbackResponse=$line;
			 }
		fclose($log2);
		$len=strlen($stkCallbackResponse);
		$pos1 = strpos($stkCallbackResponse, '[');
			
		$pos2 = strpos($stkCallbackResponse, ']');
		$start = min($pos1, $pos2);
		$length = abs($pos1 - $pos2);
		$string1=substr($stkCallbackResponse, $start+1, $length-1);
		//echo ".".$string1.".";
		
		$arry=explode('},',$string1);
		//echo count($arry);
		echo $arry[0]." ".$arry[1]." ".$arry[3]." ".$arry[4];
		$Amount0=json_decode($arry[0].'}');	
		$MpesaReceiptNumber0=json_decode($arry[1].'}');
		$TransactionDate0=json_decode($arry[3].'}');
		$PhoneNumber0=json_decode($arry[4]);
		$PhoneNumber=$PhoneNumber0->Value;
		$Amount=$Amount0->Value;
		$MpesaReceiptNumber=$MpesaReceiptNumber0->Value;
		$TransactionDate= $TransactionDate0->Value;
		echo $MpesaReceiptNumber;

		$empData = ['transid' => $MpesaReceiptNumber, 'telno' => $PhoneNumber, 'transdate' => $TransactionDate, 'amt' => $Amount];
		Payments::create($empData);
	}
	public function tinypesa_stkpush()
	{
		    $amount = '1'; //Amount to transact 
			$phonenuber = '0717411083'; // Phone number paying
			$Account_no = 'test'; // Enter account number optional
			$url = 'https://tinypesa.com/api/v1/express/initialize';
			$data = array(
				'amount' => $amount,
				'msisdn' => $phonenuber,
				'account_no'=>$Account_no
			);
			$headers = array(
				'Content-Type: application/x-www-form-urlencoded',
				'ApiKey: P8iuPZZYcK7' // Replace with your api key
			 );
			$info = http_build_query($data);

			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $info);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			$resp = curl_exec($curl);
			$msg_resp = json_decode($resp);

			if($msg_resp ->success == 'true')
			{
				echo "WAIT FOR NEVEREST STK POP UP";
			//	 return redirect()->route('tinypesa_calback');
			  // echo  $resp ;
			}
	}
	
   
			
}
