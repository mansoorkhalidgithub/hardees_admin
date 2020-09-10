<?php

namespace App\Http\Controllers;

use App\Restaurant;
use App\RestaurantUser;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Hash;

class RestaurantUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model  = RestaurantUser::all();
		
		return view('restaurantuser/index', compact('model'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$restaurants = Restaurant::all();
		
        return view('restaurantuser/create', compact('restaurants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
		$parts = explode("@", $request['email']);
        $username = $parts[0];
		
		$data = [
			'restaurant_id' => $request->restaurant_id,
			'username' => $username,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		];
		
		$user = RestaurantUser::create($data);
		
		if($user) {
			
			$text = "Hi ". $data['username'];
			$text .= "<p>Your account information is given below:</p>";
			$text .= "Username: ". $data['username'] ."<br/>";
			$text .= "Email: ". $data['email'] ."<br/>";
			$text .= "Password: ". $request->password ."<br/>";
			
			
			
			$mail = new PHPMailer(true);

			$mail->IsSMTP();  
			$mail->SMTPAuth = true;    
			$mail->SMTPSecure = "tls";
			$mail->Host = "smtp.gmail.com";  
			$mail->Port = 587;
			$mail->Username = "mansoor.shahriya469@gmail.com";  
			$mail->Password = "mk4897589";
			
			$mail->SetFrom("mansoor.shahriya469@gmail.com", 'Hardees');
			
			$mail->IsHTML(true);
			$mail->Subject = "Login Credentials";
			$mail->Body    = $text;
			$mail->AddAddress($data['email']);
			$mail->Send();
			
		}
		
		return redirect('restaurant-users');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RestuarantUser  $restuarantUser
     * @return \Illuminate\Http\Response
     */
    public function show(RestuarantUser $restuarantUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RestuarantUser  $restuarantUser
     * @return \Illuminate\Http\Response
     */
    public function edit(RestuarantUser $restuarantUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RestuarantUser  $restuarantUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RestuarantUser $restuarantUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RestuarantUser  $restuarantUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(RestuarantUser $restuarantUser)
    {
        //
    }
}
