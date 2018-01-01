<?php

use Illuminate\Database\Seeder;

use App\Types;
use App\Purposes;
use App\FinishTypes;
use App\RegionsTypes;
use App\Regions;
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
        $phones=['1111111111','2222222222','3333333333','4444444444'];
        foreach($users as $key=>$value){
            $add = new User;
            $add->name = $value;
            $add->email = $emails[$key];
            $add->phone = $phones[$key];
            $add->password = bcrypt('123456');
            $add->save();
        }
        
        


    }
}
