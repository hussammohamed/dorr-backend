<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App;
use App\Contract;
use App\Unit;
use App\ContractUnit;
use App\Companion;
use App\User;
use App\Agency;
use App\MProperty;
use App\Payment;
use App\Http\Controllers\CalendarController;

//use App\Http\Requests\BankRequest;
use App\Http\Resources\ContractResource;
use App\Http\Resources\UnitResource;
use App\Http\Resources\ContractUnitResource;
use App\Http\Resources\CompanionResource;
use App\Http\Resources\PaymentResource;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class ContractController extends Controller
{

    private $modelname = "contract";
    private $modelnames = "contracts";

    public function __construct()
    {
        $this->middleware('auth:api');//->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [ $this->modelnames => ContractResource::collection(Contract::get())];
    }
    public function indexByMProperty($id)
    {
        return [ $this->modelnames => ContractResource::collection(Contract::Where('m_property_id',$id)->get())];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if (Auth::check()) {

            $data = (array) json_decode($request->request->get('data'));
            
            $data_units = (array) json_decode($request->request->get('units'), true);
            $data_companions = (array) json_decode($request->request->get('companions'), true);
            $data_payments = (array) json_decode($request->request->get('payments'), true);

            $data["contract_status"] = 0;
            $data["created_by"] = Auth::user()->id;



            if ($data["contract_calender_type"] == 2 ){
                $data["contract_date"] = CalendarController::dateFromHijri($data["contract_date"]);
                $data["contract_start_date"] = CalendarController::dateFromHijri($data["contract_start_date"]);
                $data["contract_end_date"] = CalendarController::dateFromHijri($data["contract_end_date"]);
                $data["rent_payment_issued_date"] = CalendarController::dateFromHijri($data["rent_payment_issued_date"]);
                $data["rent_payment_due_date"] = CalendarController::dateFromHijri($data["rent_payment_due_date"]);
            }

            if ($data["m_property_id"]!=null){

                $m_property = MProperty::find($data["m_property_id"]);

                $data["m_property_address"] = $m_property->address;
                $data["m_property_type"] = $m_property->type;
                $data["m_property_floors"] = $m_property->floors;
                $data["m_property_units_no"] = $m_property->units_no;
                $data["m_property_elevators"] = $m_property->elevators;
                $data["m_property_parking"] = $m_property->parking;

            }else{
                return response()->json(["error"=>"There is no MProperty"], Response::HTTP_BAD_REQUEST);
            }

            if ($m_property->owner_user_id!=null){

                $user = User::find($m_property->owner_user_id);

                $data["owner_user_id"] = $m_property->owner_user_id;
                $data["owner_name"] = $user->name;
                $data["owner_nationality"] = $user->nationality;
                //$data["owner_address"] = $user->address;
                $data["owner_id_type"] = $user->id_type;
                $data["owner_id_no"] = $user->id_no;
                //$data["owner_id_issuer"] = $user->id_issuer;
                //$data["owner_id_issued_date"] = $user->id_issued_date;
                //$data["owner_id_id_exp_date"] = $user->id_id_exp_date;
                $data["owner_id_image"] = $user->id_image;
                $data["owner_mobile"] = $user->mobile1;
                $data["owner_email"] = $user->email;
            }else{
                return response()->json(["error"=>"There is no Owner"], Response::HTTP_BAD_REQUEST);
            }

            if ($m_property->agent_user_id!=null){

                $user = User::find($m_property->agent_user_id);
                $data["agent_user_id"] = $m_property->agent_user_id;
                $data["agent_name"] = $user->name;
                $data["agent_nationality"] = $user->nationality;
                //$data["agent_address"] = $user->address;
                $data["agent_id_type"] = $user->id_type;
                $data["agent_id_no"] = $user->id_no;
                //$data["agent_id_issuer"] = $user->id_issuer;
                //$data["agent_id_issued_date"] = $user->id_issued_date;
                //$data["agent_id_id_exp_date"] = $user->id_id_exp_date;
                $data["agent_id_image"] = $user->id_image;
                $data["agent_mobile"] = $user->mobile1;
                $data["agent_email"] = $user->email;

                $agency = Agency::where('user_id',$m_property->agent_user_id)->first();

                $data["agency_id"] = $agency->id;
                $data["agency_name"] = $agency->commercial_register_name;
                $data["agency_address"] = $agency->commercial_register_address;
                $data["agency_commercial_register_no"] = $agency->commercial_register_no;
                $data["agency_phone"] = $agency->phone;
                $data["agency_fax"] = $agency->fax;
            }

            if ($data["renter_user_id"]==null){

                $user = new User;
                $user->name = $data["renter_name"];
                $user->email = $data["renter_email"];
                $user->mobile1 = $data["renter_mobile"];
                $user->nationality = $data["renter_nationality"];
                //$user->address = $data["renter_address"];
                $user->id_type = $data["renter_id_type"];
                $user->id_no = $data["renter_id_no"];
                //$user->id_issuer = $data["renter_id_issuer"];
                //$user->id_issued_date = $data["renter_id_issued_date"];
                //$user->id_exp_date = $data["renter_id_exp_date"];
                
                $user->save();
                $data["renter_user_id"] = $user->id;

                if ($request->hasFile('renter_id_image')) {
                    $file = $request->file('renter_id_image');
                    $extension = $file->getClientOriginalExtension();
                    $id_fileName = str_random(20).".".$extension;
                    $folderpath  = 'upload/users/id/';
                    $file->move($folderpath , $id_fileName);
                    $user->id_image = $id_fileName;
                    $user->save();
                }
                $data["renter_id_image"] = $id_fileName;
            }else{

                $user = User::find($data["renter_user_id"]);

                $data["renter_name"] = $user->name;
                $data["renter_nationality"] = $user->nationality;
                //$data["renter_address"] = $user->address;
                $data["renter_id_type"] = $user->id_type;
                $data["renter_id_no"] = $user->id_no;
                //$data["renter_id_issuer"] = $user->id_issuer;
                //$data["renter_id_issued_date"] = $user->id_issued_date;
                //$data["renter_id_id_exp_date"] = $user->id_id_exp_date;
                $data["renter_id_image"] = $user->id_image;
                $data["renter_mobile"] = $user->mobile;
                $data["renter_email"] = $user->email;

            }

            $contract = Contract::create($data);

            if ($request->hasFile('contract_image')) {
                $file = $request->file('contract_image');
                $extension = $file->getClientOriginalExtension();
                $contract_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/contracts/';
                $file->move($folderpath , $contract_fileName);

                $contract->contract_image = $contract_fileName;
                $contract->save();
            }



            foreach ($data_units as $data_unit) {
                
                $unit = Unit::find($data_unit["id"]);
                if (count($unit) > 0) {
                    $contract_unit = new ContractUnit;
                    $contract_unit->contract_id = $contract->id;
                    $contract_unit->m_property_id = $unit->m_property_id;
                    $contract_unit->unit_id = $data_unit["id"];
                    $contract_unit->no = $unit->no;
                    $contract_unit->type = $unit->type;
                    $contract_unit->floor = $unit->floor;
                    $contract_unit->furnished = $unit->furnished;
                    $contract_unit->furnished_status = $unit->furnished_status;
                    $contract_unit->kitchen_cabinet = $unit->kitchen_cabinet;
                    $contract_unit->bed_rooms = $unit->bed_rooms;
                    $contract_unit->living_rooms = $unit->living_rooms;
                    $contract_unit->reception_rooms = $unit->reception_rooms;
                    $contract_unit->bath_rooms = $unit->bath_rooms;
                    $contract_unit->split_air_conditioner = $unit->split_air_conditioner;
                    $contract_unit->window_air_conditioner = $unit->window_air_conditioner;
                    $contract_unit->electricity_meter = $unit->electricity_meter;
                    $contract_unit->water_meter = $unit->water_meter;
                    $contract_unit->gas_meter = $unit->gas_meter;
                    $contract_unit->electricity_measurement = $data_unit["electricity_measurement"];
                    $contract_unit->water_measurement = $data_unit["water_measurement"];
                    $contract_unit->gas_measurement = $data_unit["gas_measurement"];
                    
                    $contract_unit->save();
                }
            }
            
            foreach ($data_companions as $data_companion) {
                if($data_companion["name"]!=null){
                    $companion = new Companion;
                    $companion->contract_id = $contract->id;
                    $companion->renter_user_id = $contract->renter_user_id;
                    $companion->name = $data_companion["name"];
                    $companion->nationality = $data_companion["nationality"];
                    $companion->id_type = $data_companion["id_type"];
                    $companion->id_no = $data_companion["id_no"];
                    $companion->relation = $data_companion["relation"];
                    $companion->mobile = $data_companion["mobile"];
                    $companion->email = $data_companion["email"];
                    
                    $companion->save();
                }
            }
            $serial = 0;
            foreach ($data_payments as $data_payment) {
                
                    $serial++;
                    $payment = new Payment;
                    $payment->contract_id = $contract->id;
                    $payment->owner_user_id = $contract->owner_user_id;
                    $payment->renter_user_id = $contract->renter_user_id;
                    $payment->serial = $serial;
                    $payment->issued_date = $data_payment["issued_date"];
                    $payment->due_date = $data_payment["due_date"];
                    $payment->amount = $data_payment["amount"];
                    
                    $payment->save();
            }

            return [ $this->modelname => new ContractResource($contract)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
        return [ $this->modelname => new ContractResource($contract)];

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */


    

    public function update(Request $request, $id)
    {
       
        if (Auth::check()) {

            DB::table('contract_units')->where('contract_id', '=', $id)->delete();
            DB::table('companions')->where('contract_id', '=', $id)->delete();
            DB::table('payments')->where('contract_id', '=', $id)->delete();
            
            $contract = Contract::find($id); 
            
            DB::table('users')->where('id', '=', $contract->renter_user_id)->where('registered', '=', 0)->delete();
            
            

            $data = (array) json_decode($request->request->get('data'));
            $data_units = (array) json_decode($request->request->get('units'), true);
            $data_companions = (array) json_decode($request->request->get('companions'), true);
            $data_payments = (array) json_decode($request->request->get('payments'), true);

            $data["contract_status"] = 0;
            $data["created_by"] = Auth::user()->id;

            
            if ($data["contract_calender_type"] == 2 ){
                $data["contract_date"] = CalendarController::dateFromHijri($data["contract_date"]);
                $data["contract_start_date"] = CalendarController::dateFromHijri($data["contract_start_date"]);
                $data["contract_end_date"] = CalendarController::dateFromHijri($data["contract_end_date"]);
                $data["rent_payment_issued_date"] = CalendarController::dateFromHijri($data["rent_payment_issued_date"]);
                $data["rent_payment_due_date"] = CalendarController::dateFromHijri($data["rent_payment_due_date"]);
            }

            if ($data["m_property_id"]!=null){

                $m_property = MProperty::find($data["m_property_id"]);

                $data["m_property_address"] = $m_property->address;
                $data["m_property_type"] = $m_property->type;
                $data["m_property_floors"] = $m_property->floors;
                $data["m_property_units_no"] = $m_property->units_no;
                $data["m_property_elevators"] = $m_property->elevators;
                $data["m_property_parking"] = $m_property->parking;

            }else{
                return response()->json(["error"=>"There is no MProperty"], Response::HTTP_BAD_REQUEST);
            }

            if ($m_property->owner_user_id!=null){

                $user = User::find($m_property->owner_user_id);

                $data["owner_user_id"] = $m_property->owner_user_id;
                $data["owner_name"] = $user->name;
                $data["owner_nationality"] = $user->nationality;
                //$data["owner_address"] = $user->address;
                $data["owner_id_type"] = $user->id_type;
                $data["owner_id_no"] = $user->id_no;
                //$data["owner_id_issuer"] = $user->id_issuer;
                //$data["owner_id_issued_date"] = $user->id_issued_date;
                //$data["owner_id_id_exp_date"] = $user->id_id_exp_date;
                $data["owner_id_image"] = $user->id_image;
                $data["owner_mobile"] = $user->mobile;
                $data["owner_email"] = $user->email;
            }else{
                return response()->json(["error"=>"There is no Owner"], Response::HTTP_BAD_REQUEST);
            }

            if ($m_property->agent_user_id!=null){

                $user = User::find($m_property->agent_user_id);
                $data["agent_user_id"] = $m_property->agent_user_id;
                $data["agent_name"] = $user->name;
                $data["agent_nationality"] = $user->nationality;
                //$data["agent_address"] = $user->address;
                $data["agent_id_type"] = $user->id_type;
                $data["agent_id_no"] = $user->id_no;
                //$data["agent_id_issuer"] = $user->id_issuer;
                //$data["agent_id_issued_date"] = $user->id_issued_date;
                //$data["agent_id_id_exp_date"] = $user->id_id_exp_date;
                $data["agent_id_image"] = $user->id_image;
                $data["agent_mobile"] = $user->mobile;
                $data["agent_email"] = $user->email;

                $agency = Agency::where('user_id',$m_property->agent_user_id)->first();

                $data["agency_id"] = $agency->id;
                $data["agency_name"] = $agency->commercial_register_name;
                $data["agency_address"] = $agency->commercial_register_address;
                $data["agency_commercial_register_no"] = $agency->commercial_register_no;
                $data["agency_phone"] = $agency->phone;
                $data["agency_fax"] = $agency->fax;
            }

            if ($data["renter_user_id"]==null){

                $user = new User;
                $user->name = $data["renter_name"];
                $user->email = $data["renter_email"];
                $user->mobile1 = $data["renter_mobile"];
                $user->nationality = $data["renter_nationality"];
                //$user->address = $data["renter_address"];
                $user->id_type = $data["renter_id_type"];
                $user->id_no = $data["renter_id_no"];
                $user->registered = 0;
                //$user->id_issuer = $data["renter_id_issuer"];
                //$user->id_issued_date = $data["renter_id_issued_date"];
                //$user->id_exp_date = $data["renter_id_exp_date"];
                
                $user->save();
                $data["renter_user_id"] = $user->id;

                if ($request->hasFile('renter_id_image')) {
                    $file = $request->file('renter_id_image');
                    $extension = $file->getClientOriginalExtension();
                    $id_fileName = str_random(20).".".$extension;
                    $folderpath  = 'upload/users/id/';
                    $file->move($folderpath , $id_fileName);
                    $user->id_image = $id_fileName;
                    $user->save();
                    $data["renter_id_image"] = $id_fileName;
                }
                
            }else{

                $user = User::find($data["renter_user_id"]);

                $data["renter_name"] = $user->name;
                $data["renter_nationality"] = $user->nationality;
                //$data["renter_address"] = $user->address;
                $data["renter_id_type"] = $user->id_type;
                $data["renter_id_no"] = $user->id_no;
                //$data["renter_id_issuer"] = $user->id_issuer;
                //$data["renter_id_issued_date"] = $user->id_issued_date;
                //$data["renter_id_id_exp_date"] = $user->id_id_exp_date;
                $data["renter_id_image"] = $user->id_image;
                $data["renter_mobile"] = $user->mobile;
                $data["renter_email"] = $user->email;

            }

            $contract->update($data);

            if ($request->hasFile('contract_image')) {
                $file = $request->file('contract_image');
                $extension = $file->getClientOriginalExtension();
                $contract_fileName = str_random(20).".".$extension;
                $folderpath  = 'upload/contracts/';
                $file->move($folderpath , $contract_fileName);

                $contract->contract_image = $contract_fileName;
                $contract->save();
            }



            foreach ($data_units as $data_unit) {
                
                $unit = Unit::find($data_unit["id"]);
                if (count($unit) > 0) {
                    $contract_unit = new ContractUnit;
                    $contract_unit->contract_id = $contract->id;
                    $contract_unit->m_property_id = $unit->m_property_id;
                    $contract_unit->unit_id = $data_unit["id"];
                    $contract_unit->no = $unit->no;
                    $contract_unit->type = $unit->type;
                    $contract_unit->floor = $unit->floor;
                    $contract_unit->furnished = $unit->furnished;
                    $contract_unit->furnished_status = $unit->furnished_status;
                    $contract_unit->kitchen_cabinet = $unit->kitchen_cabinet;
                    $contract_unit->bed_rooms = $unit->bed_rooms;
                    $contract_unit->living_rooms = $unit->living_rooms;
                    $contract_unit->reception_rooms = $unit->reception_rooms;
                    $contract_unit->bath_rooms = $unit->bath_rooms;
                    $contract_unit->split_air_conditioner = $unit->split_air_conditioner;
                    $contract_unit->window_air_conditioner = $unit->window_air_conditioner;
                    $contract_unit->electricity_meter = $unit->electricity_meter;
                    $contract_unit->water_meter = $unit->water_meter;
                    $contract_unit->gas_meter = $unit->gas_meter;
                    $contract_unit->electricity_measurement = $data_unit["electricity_measurement"];
                    $contract_unit->water_measurement = $data_unit["water_measurement"];
                    $contract_unit->gas_measurement = $data_unit["gas_measurement"];
                    
                    $contract_unit->save();
                }
            }
            
            foreach ($data_companions as $data_companion) {
                if($data_companion["name"]!=null){
                    $companion = new Companion;
                    $companion->contract_id = $contract->id;
                    $companion->renter_user_id = $contract->renter_user_id;
                    $companion->name = $data_companion["name"];
                    $companion->nationality = $data_companion["nationality"];
                    $companion->id_type = $data_companion["id_type"];
                    $companion->id_no = $data_companion["id_no"];
                    $companion->relation = $data_companion["relation"];
                    $companion->mobile = $data_companion["mobile"];
                    $companion->email = $data_companion["email"];
                    
                    $companion->save();
                }
            }
            $serial = 0;
            foreach ($data_payments as $data_payment) {
                
                    $serial++;
                    $payment = new Payment;
                    $payment->contract_id = $contract->id;
                    $payment->owner_user_id = $contract->owner_user_id;
                    $payment->renter_user_id = $contract->renter_user_id;
                    $payment->serial = $serial;
                    $payment->issued_date = $data_payment["issued_date"];
                    $payment->due_date = $data_payment["due_date"];
                    $payment->amount = $data_payment["amount"];
                    
                    $payment->save();
            }

            return [ $this->modelname => new ContractResource($contract)];
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
        
    }

    public function changeStatus($id,$status)
    {
        if (Auth::check()) {
            
            $contract = Contract::find($id); 
            $contract->contract_status = $status;
            $contract->save();

            return response([ "$this->modelname" => new ContractResource($contract)],Response::HTTP_OK);
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        //
        $contract->delete();
        return response(null,Response::HTTP_NO_CONTENT);
    }


    public function delete($id)
    {
        if (Auth::check()) {
            $contract = Contract::find($id);
            if (count($contract) < 1) {
                return response()->json(["error"=>"This Contract is not exists"], Response::HTTP_NO_CONTENT);
            }else{
                if($contract->user_id == Auth::user()->id){
                    if($contract->deleted == 0 ){
                        $contract->deleted = 1;
                        $contract->save();
                        return new ContractResource($contract);
                    }else{
                        return response()->json(["error"=>"This Contract is already deleted"], Response::HTTP_NOT_MODIFIED);
                    }
                }else{
                    return response()->json(["error"=>"You are not allowd to delete this contract"], Response::HTTP_METHOD_NOT_ALLOWED);
                }
            }
        }else{
            return response()->json(["error"=>"There is no logined user"], Response::HTTP_UNAUTHORIZED);
        }
    }

    


}
