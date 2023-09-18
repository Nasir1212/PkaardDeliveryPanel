<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CardDelivery;
use App\Models\card_registation;
use App\Models\All_Reference;
class HomeController extends Controller
{
  public function get_card_delivery(){
   return  \DB::select('SELECT  card_delivery.*, card_registation.full_name FROM   card_delivery  LEFT JOIN  card_registation  ON card_registation.card_id = card_delivery.registation_no WHERE card_delivery.packing IS null');
  }  

  public function handle_packing(Request $req){
    $result = CardDelivery::where(['registation_no'=>$req->input("registration")])->update([
      'amount'=>$req->input("amount"),
      'card_no'=>$req->input("card_number"),
      'packing'=>true,
    ]);

    if($result){
      return json_encode(["condition"=>true,'message'=>"Successfully Packing "]);

     }else{
      return json_encode(["condition"=>false,"message"=>"Packing Failed "]);

     }
  }

  public function show_all_packing_card(){

    return  \DB::select('SELECT  card_delivery.*, card_registation.full_name FROM   card_delivery  LEFT JOIN  card_registation  ON card_registation.card_id = card_delivery.registation_no WHERE card_delivery.packing IS true AND card_delivery.is_picked is NULL');

  }

  public function redelivery($id){
    $result = CardDelivery::where(['id'=>$id])->update([
      'picked_by'=>null,
      'return_card'=>null,
      'is_picked'=>null,
    ]);

    if($result){
      return json_encode(["condition"=>true,'message'=>"Successfully Reback "]);

     }else{
      return json_encode(["condition"=>false,"message"=>"Reback Failed "]);

     }
  }

  public function card_register($regi_no){
    $result =  \DB::select("SELECT card_delivery.card_no, card_registation.card_id, card_registation.phone_number,card_registation.full_name,card_registation.phone_number,card_registation.phone_number,card_registation.phone_number,card_registation.phone_number,card_registation.cda_division,card_registation.cda_district,card_registation.cda_upzilla,card_registation.cda_Thana,card_registation.cda_village, card_registation.cda_road_no,card_registation.cda_house_no,card_registation.cda_apartment_no,card_registation.cda_address_details FROM card_registation  LEFT JOIN card_delivery ON card_registation.card_id = card_delivery.registation_no WHERE card_registation.card_id = '$regi_no'");
    return $result;
  }


  public function all_picked_card(){
    return \DB::select("SELECT  card_delivery.*,rider_signup.name FROM card_delivery LEFT JOIN  rider_signup ON rider_signup.id  = card_delivery.picked_by  WHERE card_delivery.is_picked IS true ");
  }

  public function show_return_card(){
    return   \DB::select('SELECT  card_delivery.*, rider_signup.name FROM   card_delivery  LEFT JOIN rider_signup  ON card_delivery.picked_by = rider_signup.id WHERE card_delivery.return_card IS true ');

  }

  public function all_picked_card_by_search($card_no){
    return \DB::select("SELECT  card_delivery.*,rider_signup.name FROM card_delivery LEFT JOIN  rider_signup ON rider_signup.id  = card_delivery.picked_by  WHERE card_delivery.is_picked IS true AND card_delivery.card_no LIKE concat('%',$card_no,'%')");
  }
  public function show_all_packing_card_by_search ($card_no){
    return  \DB::select("SELECT  card_delivery.*, card_registation.full_name FROM   card_delivery  LEFT JOIN  card_registation  ON card_registation.card_id = card_delivery.registation_no WHERE card_delivery.packing IS true AND card_delivery.is_picked is NULL AND card_delivery.card_no LIKE concat('%',$card_no,'%')");

  }

  

  public function paid_input(Request $req){

    $result = CardDelivery::where(['id'=>$req->input("id")])->update([
      'paid'=>$req->input("paid"),
    ]);

    if($result){
      $registation =CardDelivery::where(['id'=>$req->input("id")])->get();
      $get_id =  card_registation::where(['card_id'=>$registation[0]->registation_no])->get(['id']);
       $this->delevery_stutus($get_id[0]->id);
      return json_encode(["condition"=>true,'message'=>"Payment Paid  ".$api_req ]);
     }else{
      return json_encode(["condition"=>false,"message"=>"Payment Paid Failed "]);
     }
  }

  public function unpacking_card($id){
    $result = CardDelivery::where(['id'=>$id])->update([
      'amount'=>NULL,
      'card_no'=>NULL,
      'packing'=>NULL,
    ]);

    if($result){
      return json_encode(["condition"=>true,'message'=>"Card Unpacking "]);

     }else{
      return json_encode(["condition"=>false,"message"=>"Card Unpaking  Failed "]);

     }

  }

  public function delevery_stutus($id){
    // return $req;
  
         
        $result =  card_registation::where(['id'=>$id])->update([
            'status'=>2
         ]);
          $reference_code =  card_registation::where(['id'=>$id])->get(['reference_code']);
   
         $wallet =   All_Reference::where(['reference_code'=>strtolower($reference_code[0]['reference_code'])])->get();

         $wallet_value ='';
           if(count($wallet) >0){
              $amount = 0;
              if(strlen($wallet[0]['wallet']) <= 0){
               $amount =20;
              }else{
               $amount = $wallet[0]['wallet']+20;
              }
              
           
            $wallet_update =   All_Reference::where(['reference_code'=>strtolower($reference_code[0]['reference_code'])])->update([
               'wallet' =>  $amount 
               ]);
         
          }
         
         if( $result){
            return json_encode(array('condition'=>true,'message'=>'Status Change Successfully'));
         }else{
            return json_encode(array('condition'=>false ,'message'=>'Status Change Failed'));
         }

        
      }
  
}
