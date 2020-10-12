@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    <div class="card">
  <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">UPDATE BOOKING NEW 1191</h1>
                <a href="{{ route('booking.index') }}"
			class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Back to Trips List</span></a>
                       
	</div>
    <div class="card-body">
    <form>
<fieldset>


<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booking_no">BOOKING #</label>  
  
  <input id="booking_no" name="booking_no" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="verification_code">VERIFICATION CODE</label>  
  
  <input id="verification_code" name="verification_code" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="ride_id">RIDE ID</label>  
  
  <input id="ride_id" name="ride_id" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="ride_point_id">RIDE POINT ID</label>  
  
  <input id="ride_point_id" name="ride_point_id" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="from_place">FROM PLACE</label>  
  
  <input id="from_place" name="from_place" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="to_place">TO PLACE</label>  
  
  <input id="to_place" name="to_place" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="ride_place">MAIN RIDE PLACE DETAILS</label>  
  
  <input id="ride_place" name="ride_place" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
   
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="user_star">USER STAR</label>  
  
  <input id="user_star" name="user_star" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_star">DRIVER STAR</label>
  
  <input id="driver_star" name="driver_star" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="no_of_seat">No. OF SEATS</label>  
  
  <input id="no_of_seat" name="no_of_seat" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="commission">COMMISSION</label>  
  
  <input id="commission" name="commission" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="ride_place">RIDE PRICE</label>  
  
  <input id="ride_place" name="ride_place" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="amount">AMOUNT</label>  
  
  <input id="amount" name="amount" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booking_date">BOOKING DATE</label>  
  
  <input id="booking_date" name="booking_date" style="border-radius: 0px" class="form-control " required="" type="date">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booking_time">BOOKING TIME</label>  
  
  <input id="booking_time" name="booking_time" style="border-radius: 0px" class="form-control " required="" type="time">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker">BOOKER</label>  
  
  <input id="booker" name="booker" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver">DRIVER</label>  
  
  <input id="driver" name="driver" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="user_comment">USER COMMENT</label>  
  
  <input id="user_comment" name="user_comment" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="driver_comment">DRIVER COMMENT</label>  
  
  <input id="driver_comment" name="driver_comment" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_first_name">BOOKER FIRST NAME</label>  
  
  <input id="booker_first_name" name="booker_first_name" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker_last_name">BOOKER LAST NAME</label>  
  
  <input id="booker_last_name" name="booker_last_name" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_address">BOOKER ADDRESS</label>  
  
  <input id="booker_address" name="booker_address" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_city">BOOKER CITY</label>  
  
  <input id="booker_city" name="booker_city" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_state">BOOKER STATE</label>  
  
  <input id="booker_state" name="booker_state" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_country">BOOKER COUNTRY</label>  
  
  <input id="booker_country" name="booker_country" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker_zip">BOOKER ZIP</label>  
  
  <input id="booker_zip" name="booker_zip" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_phone">BOOKER PHONE</label>  
  
  <input id="booker_phone" name="booker_phone" style="border-radius: 0px" class="form-control " required="" type="tel">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker_email">BOOKER EMAIL</label>  
  
  <input id="booker_email" name="booker_email" style="border-radius: 0px" class="form-control " required="" type="email">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_first_name">DRIVER FIRST NAME</label>  
  
  <input id="driver_first_name" name="driver_first_name" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="driver_last_name">DRIVER LAST NAME</label>  
  
  <input id="driver_last_name" name="driver_last_name" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_phone">DRIVER PHONE</label>  
  
  <input id="driver_phone" name="driver_phone" style="border-radius: 0px" class="form-control " required="" type="tel">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_email">DRIVER EMAIL</label>  
  
  <input id="driver_email" name="driver_email" style="border-radius: 0px" class="form-control " required="" type="email">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker_currency_code">BOOKER CURRENCY CODE</label>  
  
  <input id="booker_currency_code" name="booker_currency_code" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="booker_currency_symbol">BOOKER CURRENCY SYMBOL</label>  
  
  <input id="booker_currency_symbol" name="booker_currency_symbol" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="transaction_id">TRANSACTION ID</label>  
  
  <input id="transaction_id" name="transaction_id" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_payment_paid">BOOKER PAYMENT PAID</label>  
  
  <select id="booker_payment_paid" name="booker_payment_paid" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
        <option>Refund</option>
    </select>
  
</div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_payment_paid">DRIVER PAYMENT PAID</label>  
  
  <select id="driver_payment_paid" name="driver_payment_paid" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
        <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_confirmation">BOOKER CONFIRMATION</label>  
  
  <select id="booker_confirmation" name="booker_confirmation" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
</div>
<div class="row">
    
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="payment_type">PAYMENT TYPE</label>  
  
  <select id="payment_type" name="payment_type" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Paypal</option>
        <option>Cc</option>
    </select>
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="trip_return">TRIP RETURN</label>  
  
  <select id="trip_return" name="trip_return" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="payment_date">PAYMENT DATE</label>  
  
  <input id="payment_date" name="payment_date" style="border-radius: 0px" class="form-control " required="" type="date">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="ride_status">RIDE STATUS</label>  
  
  <select id="ride_status" name="ride_status" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>ACTIVE</option>
        <option>INACTIVE</option>
        <option>CANCELLED</option>
        <option>ARCHIEVED</option>
        <option>COMPLETE</option>
    </select>
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="time_zone">TIME ZONE</label>  
  
  <input id="time_zone" name="time_zone" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="sms_code">SMS CODE</label>  
  
  <input id="sms_code" name="sms_code" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_transaction_id">DRIVER PAYMENT TRANSACTION ID</label>  
  
  <input id="driver_transaction_id" name="driver_transaction_id" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
        <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="driver_payment_type">DRIVER PAYMENT TYPE</label>  
  
  <select id="driver_payment_type" name="driver_payment_type" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Paypal</option>
        <option>Cc</option>
        <option>Bank Transfer</option>
    </select>
  
</div>
    </div>
</div>
<div class="row">
    
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="adaptive_payment_type">ADAPTIVE PAYMENT TYPE</label>  
  
  <input id="adaptive_payment_type" name="adaptive_payment_type" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="cancel_by">CANCEL BY</label>  
  
  <select id="cancel_by" name="cancel_by" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Driver</option>
        <option>Passenger</option>
    </select>
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="cancel_reason">CANCEL REASON</label>  
  
  <textarea id="booking_no" name="booking_no" style="border-radius: 0px" rows="4" class="form-control " required="" type="text"></textarea>
  
</div>
    </div>
    
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="cancel_date">CANCEL DATE</label>  
  
  <input id="cancel_date" name="cancel_date" style="border-radius: 0px" class="form-control " required="" type="date">
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_refund_amount">DRIVER REFUND AMOUNT</label>  
  
  <input id="driver_refund_amount" name="driver_refund_amount" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_amount_refund_by">DRIVER AMOUNT REFUND BY</label>  
  
 <select id="driver_amount_refund_by" name="driver_amount_refund_by" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Paypal</option>
        <option>Bank</option>
    </select>
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="driver_amount_refund_date">DRIVER AMOUNT REFUND DATE</label>  
  
  <input id="driver_amount_refund_date" name="driver_amount_refund_date" style="border-radius: 0px" class="form-control " required="" type="date">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="driver_refund_paid">DRIVER REFUND PAID</label>  
  
 <select id="driver_refund_paid" name="driver_refund_paid" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="passenger_refund_amount">PASSENGER REFUND AMOUNT</label>  
  
  <input id="passenger_refund_amount" name="passenger_refund_amount" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="passenger_amount_refund_by">PASSENGER AMOUNT REFUND BY</label>  
  
  <select id="passenger_amount_refund_by" name="passenger_amount_refund_by" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Paypal</option>
        <option>Bank</option>
    </select>
  
</div>
    </div>
        <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="passenger_refund_date">PASSENGER REFUND DATE</label>  
  
  <input id="passenger_refund_date" name="passenger_refund_date" style="border-radius: 0px" class="form-control " required="" type="date">
  
</div>
    </div>
</div>
<div class="row">
    
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="passenger_refund_paid">PASSENGER REFUND PAID</label>  
  
  <select id="passenger_refund_paid" name="passenger_refund_paid" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="site_refund_amount">SITE REFUND AMOUNT</label>  
  
  <input id="site_refund_amount" name="site_refund_amount" style="border-radius: 0px" class="form-control " required="" type="text">
  
</div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="issue_reason">ISSUE REASON</label>  
  
  <textarea id="issue_reason" name="issue_reason" style="border-radius: 0px" rows="4" class="form-control " required="" type="text"></textarea>
  
</div>
    </div>
    
</div>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="issue_status">ISSUE STATUS</label>  
  
    <select id="issue_status" name="issue_status" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
  <label class=" " style="color: black; font-size: 12px; font-weight: 700" for="booker_credited">BOOKER CREDITED</label>  
  
    <select id="booker_credited" name="booker_credited" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-12">
        <div class="form-group">
  <label class="" style="color: black; font-size: 12px; font-weight: 700" for="trans_request">TRANS REQUEST</label>  
  
  <select id="trans_request" name="trans_request" style="border-radius: 0px" class="form-control">
        <option></option>
        <option>Yes</option>
        <option>No</option>
    </select>
  
</div>
    </div>
</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">
  
      <button id="update_booking" name="update_booking" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">UPDATE BOOKING</button>
  
  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
