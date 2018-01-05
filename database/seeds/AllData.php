<?php

use Illuminate\Database\Seeder;

use App\Property;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\RegionType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App\Language;
use App\SocialMedia;
use App\Setting;
use App\User;
use App\FilterMenu;
use App\Menu;
use App\MenuLink;
use App\Page;

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
            $add = new Type;
            $add->name_ar = $value;
            $add->name_en = $types_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Purposes
        $purposes_ar=['شراء','بيع','مطلوب للايجار','عرض للايجار'];
        $purposes_en=['Sell','Buy','For Rent','To Rent'];
        foreach($purposes_ar as $key=>$value){
            $add = new Purpose;
            $add->name_ar = $value;
            $add->name_en = $purposes_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed FinishTypes
        $finishTypes_ar=['بدون تشطيب','نص تشطيب','تشطيب كامل','سوبر لوكس'];
        $finishTypes_en=['Not Finished','Semi Finish','Full Finish','Super Lux'];
        foreach($finishTypes_ar as $key=>$value){
            $add = new FinishType;
            $add->name_ar = $value;
            $add->name_en = $finishTypes_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed Overlooks
        $overlooks_ar=['شاطئ','شارع رئيسى','ميدان','حديقة'];
        $overlooks_en=['Beach','Main Street','Square','Garden'];
        foreach($overlooks_ar as $key=>$value){
            $add = new Overlook;
            $add->name_ar = $value;
            $add->name_en = $overlooks_en[$key];
            $add->order = $key+1;
            $add->save();
        }
        
        //Seed PaymentMethods
        $paymentMethods_ar=['كاش','تقسيط','استثمار عقارى'];
        $paymentMethods_en=['Cash','Installment','Real Estate Investment'];
        foreach($paymentMethods_ar as $key=>$value){
            $add = new PaymentMethod;
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

        //Seed FilterMenus
        $filter_menu_ar=['شقق للبيع','فيلل للبيع','شاليهات للبيع','محلات للبيع'];
        $filter_menu_en=['Appartment for Sale','Villa for Sale','Chalete for Sale','Shop for Sale'];
        $types=['1','2','3','4'];
        foreach($filter_menu_ar as $key=>$value){
            $add = new FilterMenu;
            $add->name_ar = $value;
            $add->name_en = $filter_menu_en[$key];
            $add->type = $types[$key];;
            $add->purpose = 1;
            $add->order = $key+1;
            $add->save();
        }

        //Seed Menus
        $menu_ar=['خدماتنا','وصول سريع'];
        $menu_en=['Services','Quick Links'];
        foreach($menu_ar as $key=>$value){
            $add = new Menu;
            $add->name_ar = $value;
            $add->name_en = $menu_en[$key];
            $add->save();
        }

        //Seed MenusLinks
        $menu_ar=['الأشتراكات','وظائف','أعلن معنا','تواصل معنا','الأحكام والشروط', 'بحث عن عقارات','إعلن عن عقارات','إدارة العقارات','تقارير الإسعار','وساطة عقارية','تقييم'];
        $menu_en=['Subcription','Jobs','Advertise With Us','Contact Us','Terms','Properties Search','Advertise for Property','Properties Managment','Report','Brokking','Rate'];
        $menu_ids=['1','1','1','1','1','2','2','2','2','2','2'];
        foreach($menu_ar as $key=>$value){
            $add = new MenuLink;
            $add->menu_id = $menu_ids[$key];
            $add->name_ar = $value;
            $add->name_en = $menu_en[$key];
            $add->link = "#";
            $add->target = "_blank";
            $add->order = $key+1;
            $add->save();
        }


        //Seed Pages
        $pages_ar=['أبحث عن عقارات','أعلن عن عقارك','إدارة عقاراتك','التقارير العقارية','وساطة عقارية', 'تقييم'];
        $pages_en=['Properties Search','Advertise for Property','Properties Managment','Report','Brokking','Rate'];
        $pages_short=[
            'ابحث عن الشقة المناسبة ليك, حدد المنطقة وسعر وشاهد الاف العقارات للبيع والإيجار',
            'أعلن عن عقارك بسهولة , صور عقارك وأعرضه للبيع او للأيجار بسرعة وسهولة',
            'يمكنك إدارة عقاراتك وأملاكك عن طريق التطبيق ومتابعة المستأجرين ومديري العقارات وإدارة طلبات الصيانة والتحصيل',
            'تعرف على اسعار الأحياء والمناطق فى كل المملكة',
            'تابع اعمال الوساطة العقارية من خلال تطبيق دور',
            'اعرف قيمة عقارك عن طريق معرفة اسعار العقارات المحيطة بك'
        ];
        foreach($pages_ar as $key=>$value){
            $add = new Page;
            $add->title_ar = $value;
            $add->title_en = $pages_en[$key];
            $add->full_content_ar = $pages_short[$key];
            $add->full_content_en = $pages_short[$key];
            $add->short_content_ar = $pages_short[$key];
            $add->short_content_en = $pages_short[$key];
            $add->order = $key+1;
            $add->save();
        }

        //Seed Settings
        $add = new Setting;
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
            $add = new RegionType;
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
            $add = new Region;
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
        $property = new Property;
        $property->user_id = 1;
        $property->type = 1;
        $property->purpose = 1;
        $property->title = "شقة فى احسن ضواحى الرياض";
        $property->ownerName = "محمد محمود";
        $property->address = "شارع 5";
        $property->region = "2";
        $property->lat = "2.2222";
        $property->long = "3.222";
        $property->description = "وصف للوحدة";
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
        $property = new Property;
        $property->user_id = 2;
        $property->type = 2;
        $property->purpose = 2;
        $property->title = "فيلا سوبر لوكس";
        $property->ownerName = "سليمان بن عدنان الثقفي";
        $property->address = "شارع 4";
        $property->region = "6";
        $property->lat = "5.2222";
        $property->long = "6.222";
        $property->description = "وصف للوحدة";
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
