<?php

namespace App\Http\Controllers;

use Auth;
use App;
use App\Type;
use App\Purpose;
use App\FinishType;
use App\Region;
use App\Overlook;
use App\PaymentMethod;
use App\Advertiser;
use App\User;
use App\PropertyOffer;
use App\FilterMenu;
use App\Period;
use App\MapView;
use App\ReportingReason;
use App\Nationality;
use App\IdType;
use App\Bank;
use App\ContractType;
use App\UsageType;
use App\ServiceType;

use App\Http\Resources\TypesResource;
use App\Http\Resources\PurposesResource;
use App\Http\Resources\RegionResource;
use App\Http\Resources\PropertyResource;
use App\Http\Resources\PropertyImageResource;
use App\Http\Resources\AdvertiserResource;
use App\Http\Resources\FinishTypeResource;
use App\Http\Resources\OverlookResource;
use App\Http\Resources\PaymentMethodResource;
use App\Http\Resources\PeriodResource;
use App\Http\Resources\MapViewResource;
use App\Http\Resources\ReportingReasonResource;
use App\Http\Resources\NationalityResource;
use App\Http\Resources\IdTypeResource;
use App\Http\Resources\BankResource;
use App\Http\Resources\ContractTypeResource;
use App\Http\Resources\UsageTypeResource;
use App\Http\Resources\ServiceTypeResource;

use Illuminate\Http\Request;

class FormController extends Controller
{
    //

    public function getFormData ()
    {
        $types = Type::where('active',1)->where('deleted',0)->orderby('order')->get();
        $purposes = Purpose::where('active',1)->where('deleted',0)->orderby('order')->get();
        $regions = Region::where('type',1)->where('active',1)->where('deleted',0)->orderby('order')->get();
        $advertisers = Advertiser::where('active',1)->where('deleted',0)->orderby('order')->get();
        //$finish_types = FinishType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $overlooks = Overlook::where('active',1)->where('deleted',0)->orderby('order')->get();
        //$payment_methods = PaymentMethod::where('active',1)->where('deleted',0)->orderby('order')->get();
        $periods = Period::where('active',1)->where('deleted',0)->orderby('order')->get();
        $map_views = MapView::where('active',1)->where('deleted',0)->orderby('order')->get();
        $reporting_reasons = ReportingReason::where('active',1)->where('deleted',0)->orderby('order')->get();
        $nationalities = Nationality::where('active',1)->where('deleted',0)->orderby('order')->get();
        $id_types = IdType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $banks = Bank::where('active',1)->where('deleted',0)->orderby('order')->get();
        $contract_types = ContractType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $usage_types = UsageType::where('active',1)->where('deleted',0)->orderby('order')->get();
        $service_types = ServiceType::where('active',1)->where('deleted',0)->orderby('order')->get();
        
        

        
        
        
        return [
            "types" => TypesResource::collection($types),
            "purposes" => PurposesResource::collection($purposes),
            "regions" => RegionResource::collection($regions),
            "advertisers" => AdvertiserResource::collection($advertisers),
            //"finish_types" => FinishTypeResource::collection($finish_types),
            "overlooks" => OverlookResource::collection($overlooks),
            //"payment_methods" => PaymentMethodResource::collection($payment_methods),
            "periods" => PeriodResource::collection($periods),
            "map_views" => MapViewResource::collection($map_views),
            "reporting_reasons" => ReportingReasonResource::collection($reporting_reasons),
            "nationalities" => NationalityResource::collection($nationalities),

            "id_types" => IdTypeResource::collection($id_types),

            "banks" => BankResource::collection($banks),
            "contract_types" => ContractTypeResource::collection($contract_types),
            "usage_types" => UsageTypeResource::collection($usage_types),
            "service_types" => ServiceTypeResource::collection($service_types),
            "contract_conditions"=>[
                [
                    "id"=>1,
                    "name"=>"جديد",
                ],
                [
                    "id"=>2,
                    "name"=>"مجدد",
                ]
            ],
            "furnished"=>[
                [
                    "id"=>1,
                    "name"=>"مؤثثة",
                ],
                [
                    "id"=>2,
                    "name"=>"غير مؤثثة",
                ]
            ],
            "furnished_status"=>[
                [
                    "id"=>1,
                    "name"=>"جديد",
                ],
                [
                    "id"=>2,
                    "name"=>"قديم",
                ]
            ],
            "kitchen_cabinet"=>[
                [
                    "id"=>1,
                    "name"=>"يوجد",
                ],
                [
                    "id"=>2,
                    "name"=>"لا يوجد",
                ]
            ],
            "calender_type"=>[
                [
                    "id"=>1,
                    "name"=>"ميلادى",
                ],
                [
                    "id"=>2,
                    "name"=>"هجرى",
                ]
            ],
            "owner_response"=>[
                [
                    "id"=>1,
                    "name"=>"إصلاح من قبل المالك",
                ],
                [
                    "id"=>2,
                    "name"=>"إصلاح من قبل المستأجر",
                ],
                [
                    "id"=>3,
                    "name"=>"إصلاح من قبل دور",
                ],
                [
                    "id"=>4,
                    "name"=>"رفض الطلب",
                ]
            ],
            "transaction_methods"=>[
                [
                    "id"=>1,
                    "name"=>"كاش",
                ],
                [
                    "id"=>2,
                    "name"=>"شيك",
                ],
                [
                    "id"=>3,
                    "name"=>"تحويل بنكى",
                ]
            ],
        ];
    }
}
