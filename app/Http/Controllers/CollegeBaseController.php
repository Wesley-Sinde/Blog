<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use App\Models\GuardianDetail;
use App\Models\PaymentSetting;
use App\Models\SmsSetting;
use App\Models\Staff;
use App\Models\Student;
use App\Traits\AccountingScope;
use App\Traits\CommonScope;
use App\Traits\CustomerScopes;
use App\Traits\DateTimeScope;
use App\Traits\ExaminationScope;
use App\Traits\FacultySemesterScope;
use App\Traits\HostelScope;
use App\Traits\PurchaseVerification;
use App\Traits\StaffScope;
use App\Traits\StudentScopes;
use App\Traits\TransportScope;
use App\Traits\UploadScope;
use App\Traits\VendorScopes;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use View;
use AppHelper, Image;

class CollegeBaseController extends Controller
{
    public $pagination_limit = 10;
    protected $CustomerRegCode = 'CUS';
    protected $VendorRegCode = 'VEN';
    protected $ProductCodeStart = 'PRO';
    protected $StaffCodeStart = 'STA';
    protected $vendorAccCategory = 85;
    protected $customerAccCategory = 86;
    protected $staffAccCategory = 76;
    protected $message_success = 'message_success';
    protected $message_warning = 'message_warning';
    protected $message_danger = 'message_danger';
    public $internet_status = 'There is no Internet connection. Please Check the network cables, modem, and router.';

    /*Traits*/
    use CommonScope;
    use StudentScopes;
    use StaffScope;
    use DateTimeScope;
    use AccountingScope;
    use UploadScope;
    use ExaminationScope;
    use FacultySemesterScope;
    use TransportScope;
    use HostelScope;
    use VendorScopes;
    use CustomerScopes;
    use PurchaseVerification;

    public function __construct()
    {
    }

    protected function loadDataToView($view_path)
    {
        View::composer($view_path, function ($view) {
            $view->with('base_route', $this->base_route);
            $view->with('view_path', $this->view_path);
            $view->with('panel', $this->panel);
            $view->with('generalSetting', $this->getGeneralSetting());
            $view->with('purchaseDetail', $this->getPurchaseDetail());
            $view->with('paymentGatewayStatus', $this->paymentGatewayStatus());
            $view->with('smsSetting', $this->getSmsSetting());
            $view->with('profileImageSrc', $this->profileImageSrc());
            $view->with('folder_name', property_exists($this, 'folder_name')?$this->folder_name:'');

        });

        return $view_path;
    }

    /*check internet connection*/
    public function checkConnection()
    {
        $connected = @fsockopen("www.google.com", 80); //website, port  (try 80 or 443)
        if ($connected){
            return true;
        }
        return false;
    }

    protected function invalidRequest($message = 'Invalid request!!')
    {
        request()->session()->flash($this->message_warning, $message);
        return redirect()->route($this->base_route);
    }

    protected function getGeneralSetting()
    {
        $data['general_setting'] = GeneralSetting::first();

        if(isset($data['general_setting']) && $data['general_setting'] != null){
            $licenseInfo = $this->getPurchaseDetail();
            if(isset($licenseInfo)) {
                $expireAt = (isset($licenseInfo->sold_at)?Carbon::parse($licenseInfo->sold_at)->addYear():'');
                //$body->expire = Carbon::parse($expire)->format('d-m-Y');
                //$expireAt = $licenseInfo->expire;
                $buyer = isset($licenseInfo->buyer)?$licenseInfo->buyer:'';
                $supportedUntil = isset($licenseInfo->supported_until)?Carbon::parse($licenseInfo->supported_until)->format('d-m-Y'):'';

                $data['general_setting']->buyer = $buyer;
                $data['general_setting']->license = $expireAt;
                $data['general_setting']->support = $supportedUntil;
            }

            //dd($data['general_setting']);

            return $data['general_setting'];
        }else{
            request()->session()->flash($this->message_warning, 'Please, Setup your institution detail or contact your system administrator');
            return redirect()->route('home');
        }
    }

    protected function paymentGatewayStatus()
    {
        $data['payment_setting'] = PaymentSetting::get();
        if(isset($data['payment_setting']) && $data['payment_setting']->count() > 0){
            return $paymentGateway = json_decode($data['payment_setting'],true);
            //$manageSetting = json_encode(array_pluck($data['payment_setting'],'status','identity'));
            //$manageSetting = collect(array_pluck($data['payment_setting'],'status','identity'));
            //$manageSetting = collect(array_pluck($data['payment_setting'],'status','identity'));
            //return $manageSetting;
        }
    }

    protected function getPaymentSetting()
    {
        $data['payment_setting'] = PaymentSetting::where('status',1)->get();
        if(isset($data['payment_setting']) && $data['payment_setting']->count() > 0){
            $d = json_decode($data['payment_setting'],true);
            $manageSetting = array_pluck($d,'config','identity');
            return $manageSetting;
        }
    }

    protected function getSmsSetting()
    {
        $data['sms_setting'] = SmsSetting::where('status',1)->get();
        if(isset($data['sms_setting']) && $data['sms_setting']->count() > 0){
            $d = json_decode($data['sms_setting'],true);
            $manageSetting = array_pluck($d,'config','identity');
            return $manageSetting;
        }
    }

    /*protected function purchaseDetail()
    {
        return $purchaseDetail = $this->getPurchaseDetail();
    }*/

    protected function profileImageSrc()
    {
        if(auth()->user()->hasRole('student')) {
            $id = auth()->user()->hook_id;
            $student = Student::select('student_image')->find($id);
            if($student->student_image){
                $profileImageSrc = 'images/studentProfile/'.$student->student_image;
            }else{
                $profileImageSrc = null;
            }

        }elseif(auth()->user()->hasRole('guardian')){
            $id = auth()->user()->hook_id;
            $guardian = GuardianDetail::select('guardian_image')->find($id);
            if($guardian->guardian_image){
                $profileImageSrc = 'images/parents/'.$guardian->guardian_image;
            }else{
                $profileImageSrc = null;
            }
        }elseif(auth()->user()->hasRole('staff')){
            $id = auth()->user()->hook_id;
            $staff = Staff::select('staff_image')->find($id);
            if($staff->staff_image){
                $profileImageSrc = 'images/staff/'.$staff->staff_image;
            }else{
                $profileImageSrc = null;
            }

        }else{
            $id = auth()->user()->id;
            $image = User::select('profile_image')->find($id);
            if($image->profile_image){
                $profileImageSrc = 'images/user/'.$image->profile_image;
            }else{
                $profileImageSrc = null;
            }

        }


        return $profileImageSrc;

    }

}
