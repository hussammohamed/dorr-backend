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
use App\Language;
use App\SocialMedia;
use App\Settings;
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
        $types_ar=['شقة','فيلا','شاليه','محل'];
        $types_en=['Appartment','Villa','Chalete','Shop'];
        foreach($types_ar as $key=>$value){
            $add = new Types;
            $add->name_ar = $value;
            $add->name_en = $types_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Purposes
        $purposes_ar=['شراء','بيع','مطلوب للايجار','عرض للايجار'];
        $purposes_en=['Sell','Buy','For Rent','To Rent'];
        foreach($purposes_ar as $key=>$value){
            $add = new Purposes;
            $add->name_ar = $value;
            $add->name_en = $purposes_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed FinishTypes
        $finishTypes_ar=['بدون تشطيب','نص تشطيب','تشطيب كامل','سوبر لوكس'];
        $finishTypes_en=['Not Finished','Semi Finish','Full Finish','Super Lux'];
        foreach($finishTypes_ar as $key=>$value){
            $add = new FinishTypes;
            $add->name_ar = $value;
            $add->name_en = $finishTypes_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Overlooks
        $overlooks_ar=['شاطئ','شارع رئيسى','ميدان','حديقة'];
        $overlooks_en=['Beach','Main Street','Square','Garden'];
        foreach($overlooks_ar as $key=>$value){
            $add = new Overlooks;
            $add->name_ar = $value;
            $add->name_en = $overlooks_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed PaymentMethods
        $paymentMethods_ar=['كاش','تقسيط','استثمار عقارى'];
        $paymentMethods_en=['Cash','Installment','Real Estate Investment'];
        foreach($paymentMethods_ar as $key=>$value){
            $add = new PaymentMethods;
            $add->name_ar = $value;
            $add->name_en = $paymentMethods_en[$key];
            $add->order = $key+1;
            $add->save();
        }

        //Seed Languages
        $languages=['عربى','English'];
        $languages_short_name=['ع','En'];
        $languages_code=['ar','en'];
        foreach($languages as $key=>$value){
            $add = new Language;
            $add->name = $value;
            $add->short_name = $languages_short_name[$key];
            $add->code = $languages_code[$key];
            $add->order = $key+1;
            $add->save();
        }

        //Seed SocialMedia
        $social_media=['Facebook','Instagram','Twitter'];
        $social_media_alias=['facebook','instagram','twitter'];
        $social_media_link=['http://facebook.com','http://instagram.com','http://twitter.com'];
        foreach($social_media as $key=>$value){
            $add = new SocialMedia;
            $add->name = $value;
            $add->alias = $social_media_alias[$key];
            $add->link = $social_media_link[$key];
            $add->target = "_blank";
            $add->order = $key+1;
            $add->save();
        }

        //Seed Settings
        $add = new Settings;
        $add->site_name = "Dorr";
        $add->site_title_ar = "دوُر للتسويق العقارى";
        $add->site_title_en = "Dorr Real Estate";
        $add->full_domain = "http://www.dorr.com";
        $add->meta_keywords_ar = "";
        $add->meta_keywords_en = "";
        $add->meta_description_ar = "";
        $add->meta_description_en = "";
        $add->email_no_reply = "no_reply@dorr.com";
        $add->email_contact = "contact@dorr.com";
        $add->copy_right_ar = "جميع الحقوق محفوظة - تطبيق دوُر 2017";
        $add->copy_right_en = "All rights reserved - Dorr App 2017";
        $add->website_status = "1";
        $add->multilingual = "1";
        $add->basic_language = "1";
        $add->save();



        //Seed RegionsTypes
        $regionsTypes_ar=['مدينة','حى'];
        $regionsTypes_en=['City','District'];
        foreach($regionsTypes_ar as $key=>$value){
            $add = new RegionsTypes;
            $add->name_ar = $value;
            $add->name_en = $regionsTypes_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Regions
        $regions_ar=['الرياض','الدرعية','المونسية','المشاعل','المدينة المنورة','ابيار على','شوران','طيبة'];
        $regions_en=['Riyadh','Diriyah','Munsiyah','Mishal','Medina','Abyar Ali','Shuran','Teba'];
        $parent=[0,1,1,1,0,5,5,5];
        $types=[1,2,2,2,1,2,2,2];
        foreach($regions_ar as $key=>$value){
            $add = new Regions;
            $add->name_ar = $value;
            $add->name_en = $regions_en[$key];
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
