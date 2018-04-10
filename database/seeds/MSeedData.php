<?php

use Illuminate\Database\Seeder;

use App\IdType;
use App\Nationality;
use App\Bank;
use App\MProperty;

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
        $id_types=['رقم قومى','إقامة','جواز سفر','سجل تجارى'];
        foreach($id_types as $key=>$value){
            $add = new IdType;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Nationality
        $nationality=['السعودية','مصر','الامارات','الكويت'];
        foreach($nationality as $key=>$value){
            $add = new Nationality;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Bank
        $bank=['NSGB','NSG','QNB','SAB'];
        foreach($bank as $key=>$value){
            $add = new Bank;
            $add->name = $value;
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
        $property->units = 12;
        $property->elevators = 2;
        $property->parking = 1;
        $property->year_of_construction = 2015;
        $property->property_instrument_no = "123456789";
        $property->property_instrument_issuer = 1;
        $property->property_instrument_date = "2015-05-02";
        $property->property_instrument_place = "c";
        
        $property->owner_user_id = 2;
        $property->owner_name = "Mohamed";
        $property->owner_nationality = 1;
        $property->owner_address = "address";
        $property->owner_id_type = 1;
        $property->owner_id_no = "54684653";
        $property->owner_id_issuer = 1;
        $property->owner_id_date = "2015-05-02";
        $property->owner_id_exp_date = "2015-05-02";
        $property->owner_email = "a@fdsf.muk";
        $property->owner_mobile = "123456789";
        $property->owner_bank = 1;
        $property->owner_bank_iban = "321654987";
        $property->owner_is_agent = 0;

        $property->agent_user_id = 1;
        $property->agent_name = "ahmed";
        $property->agent_nationality = 1;
        $property->agent_address = "address";
        $property->agent_id_type = 1;
        $property->agent_id_no = "321321321";
        $property->agent_id_issuer = 1;
        $property->agent_id_date = "2015-05-02";
        $property->agent_id_exp_date = "2015-05-02";
        $property->agent_email = "kj@fdsf.muk";
        $property->agent_mobile = "123456789";
        $property->agent_instrument_no = "16461315";
        $property->agent_instrument_issuer = 1;
        $property->agent_instrument_date = "2015-05-02";
        $property->agent_instrument_exp_date = "2015-05-02";
        $property->agent_bank = 1;
        $property->agent_bank_iban = "654321987";
        $property->commercial_register_name = "الحمد للتسويق";
        $property->commercial_register_no = "56464654546";
        $property->commercial_register_issuer = 1;
        $property->commercial_register_date = "2015-05-02";
        $property->commercial_register_exp_date = "2015-05-02";

        $property->created_by = 2;
        $property->save();
        
    }
}
