<?php

use Illuminate\Database\Seeder;

use App\Properties;
use App\Types;
use App\Purposes;
use App\FinishTypes;
use App\RegionsTypes;
use App\Regions;
use App\Overlooks;
use App\PaymentMethods;
use App\User;

class AllData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //Seed Types
        $types=['شقة','فيلا','شاليه','محل'];
        foreach($types as $key=>$value){
            $add = new Types;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Purposes
        $purposes=['شراء','بيع','مطلوب للايجار','عرض للايجار'];
        foreach($purposes as $key=>$value){
            $add = new Purposes;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed FinishTypes
        $finishTypes=['بدون تشطيب','نص تشطيب','تشطيب كامل','سوبر لوكس'];
        foreach($finishTypes as $key=>$value){
            $add = new FinishTypes;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Overlooks
        $overlooks=['شاطئ','شارع رئيسى','ميدان','حديقة'];
        foreach($overlooks as $key=>$value){
            $add = new Overlooks;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed PaymentMethods
        $paymentMethods=['كاش','تقسيط','استثمار عقارى'];
        foreach($paymentMethods as $key=>$value){
            $add = new PaymentMethods;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }

        //Seed RegionsTypes
        $regionsTypes=['مدينة','حى'];
        foreach($regionsTypes as $key=>$value){
            $add = new RegionsTypes;
            $add->name = $value;
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Regions
        $regions=['الرياض','الدرعية','المونسية','المشاعل','المدينة المنورة','ابيار على','شوران','طيبة'];
        $parent=[0,1,1,1,0,5,5,5];
        $types=[1,2,2,2,1,2,2,2];
        foreach($regions as $key=>$value){
            $add = new Regions;
            $add->name = $value;
            $add->parent = $parent[$key];
            $add->type = $types[$key];
            $add->order = $key+1;
            $add->save();
        }

        //Seed Users
        $users=['user1','user2','user3','user4'];
        $emails=['user1@gmail.com','user2@gmail.com','user3@gmail.com','user4@gmail.com'];
        $mobiles=['1111111111','2222222222','3333333333','4444444444'];
        foreach($users as $key=>$value){
            $add = new User;
            $add->name = $value;
            $add->email = $emails[$key];
            $add->mobile1 = $mobiles[$key];
            $add->password = bcrypt('123456');
            $add->save();
        }
        
        //Seed Properties
        $property = new Properties;
        $property->type = 1;
        $property->purpose = 1;
        $property->title = "شقة فى احسن ضواحى الرياض";
        $property->ownerID = 1;
        $property->address = "شارع 5";
        $property->region = "2";
        $property->lat = "2.2222";
        $property->long = "3.222";
        $property->description = "اى كلام";
        $property->price = 5000000;
        $property->pricePerMeter = 50000;
        $property->dateOfConstruction = "2000-01-02";
        $property->area = 100;
        $property->floor = 2;
        $property->finishType = 4;
        $property->overlooks = 4;
        $property->paymentMethods = 1;
        $property->rooms = 6;
        $property->bathrooms = 3;
        $property->adID = "123456789";
        $property->hits = 12;
        $property->youtube = "http://youtube.com";
        $property->advertiserType = 1;
        $property->dateOfPublication = "2017-01-02";
        $property->save();

        //Seed Properties
        $property = new Properties;
        $property->type = 2;
        $property->purpose = 2;
        $property->title = "فيلا سوبر لوكس";
        $property->ownerID = 1;
        $property->address = "شارع 4";
        $property->region = "6";
        $property->lat = "5.2222";
        $property->long = "6.222";
        $property->description = "اى كلام";
        $property->price = 7000000;
        $property->pricePerMeter = 70000;
        $property->dateOfConstruction = "2000-01-02";
        $property->area = 100;
        $property->floor = 1;
        $property->finishType = 3;
        $property->overlooks = 1;
        $property->paymentMethods = 1;
        $property->rooms = 6;
        $property->bathrooms = 3;
        $property->adID = "123456789";
        $property->hits = 12;
        $property->youtube = "";
        $property->advertiserType = 1;
        $property->dateOfPublication = "2017-01-02";
        $property->save();        
    }
}
