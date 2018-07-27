<?php

use Illuminate\Database\Seeder;

use App\IdType;
use App\Nationality;
use App\Bank;
use App\MProperty;
use App\User;
use App\Agency;
use App\ContractType;
use App\UsageType;

class MSeedData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Seed ID_Types
        $id_types_ar=['هوية وطنية','إقامة','جواز سفر','سجل تجارى'];
        $id_types_en=['National ID','Stay','Passport','Commercial Register'];
        foreach($id_types_ar as $key=>$value){
            $add = new IdType;
            $add->name_ar = $value;
            $add->name_en = $id_types_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Nationality
        $nationality_ar=['السعودية','مصر','الامارات','الكويت'];
        $nationality_en=['Saudi','Egypt','UAE','Kuwait'];
        foreach($nationality_ar as $key=>$value){
            $add = new Nationality;
            $add->name_ar = $value;
            $add->name_en = $nationality_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Bank
        $bank_ar=['الاهلى سوستيه','مصر','قطر الدولى','السعودى'];
        $bank_en=['NSGB','Misr','QNB','SAB'];
        foreach($bank_ar as $key=>$value){
            $add = new Bank;
            $add->name_ar = $value;
            $add->name_en = $bank_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        
        //Seed MProperties

        $property = new MProperty;
        $property->name = "Villa 2115";
        $property->type = 2;
        $property->district = 6;
        $property->address = "55 street";
        $property->lat = 22.22222;
        $property->long = 42.22222;
        $property->floors = 5;
        $property->units_no = 12;
        $property->elevators = 2;
        $property->parking = 1;
        $property->year_of_construction = 2015;
        $property->property_instrument_no = "123456789";
        $property->property_instrument_issuer = 1;
        $property->property_instrument_date = "2015-05-02";
        $property->property_instrument_place = "c";
        $property->user_relation = 2;
        $property->created_by = 2;
        $property->save();



        $owner = new User;
        $owner->name = "Mohamed";
        $owner->nationality = 1;
        $owner->address = "address";
        $owner->id_type = 1;
        $owner->id_no = "54684653";
        $owner->id_issuer = 1;
        $owner->id_issued_date = "2015-05-02";
        $owner->id_exp_date = "2015-05-02";
        $owner->email = "a@fdsf.muk";
        $owner->mobile1 = "1434567895";
        $owner->bank = 1;
        $owner->bank_iban = "321654987";
        $owner->save();
        

        $property->owner_user_id = $owner->id;
        $property->save();




        $agent = new User;
        $agent->name = "ahmed";
        $agent->nationality = 1;
        $agent->address = "address";
        $agent->id_type = 1;
        $agent->id_no = "321321321";
        $agent->id_issuer = 1;
        $agent->id_issued_date = "2015-05-02";
        $agent->id_exp_date = "2015-05-02";
        $agent->email = "kj@fdsf.muk";
        $agent->mobile1 = "1234567890";
        $agent->bank = 1;
        $agent->bank_iban = "654321987";
        $agent->save();

        $property->agent_user_id = $agent->id;
        $property->save();


        $property->agency_instrument_no = "16461315";
        $property->agency_instrument_issuer = 1;
        $property->agency_instrument_date = "2015-05-02";
        $property->agency_instrument_exp_date = "2015-05-02";
        $property->save();

        $agency = new Agency;
        $agency->user_id = $agent->id;
        $agency->commercial_register_name = "الحمد للتسويق";
        $agency->commercial_register_no = "56464654546";
        $agency->commercial_register_issuer = 1;
        $agency->commercial_register_date = "2015-05-02";
        $agency->commercial_register_exp_date = "2015-05-02";
        $agency->save();

        

        //Seed ContractType
        $contract_type_ar=['العقد الموحد','عقد دور','عقد الوسيط العقاري'];
        $contract_type_en=['United Contract','Dorr Contract','Agency Contract'];
        foreach($contract_type_ar as $key=>$value){
            $add = new ContractType;
            $add->name_ar = $value;
            $add->name_en = $contract_type_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed UsageType
        $usage_type_ar=['سكنى عائلى','سكنى أفراد'];
        $usage_type_en=['Family','Individual'];
        foreach($usage_type_ar as $key=>$value){
            $add = new UsageType;
            $add->name_ar = $value;
            $add->name_en = $usage_type_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        
    }
}
