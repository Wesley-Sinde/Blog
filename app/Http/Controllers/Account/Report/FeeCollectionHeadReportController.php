<?php
/*
 * Mr. Umesh Kumar Yadav
 * Business With Technology Pvt. Ltd.
 * Kathmandu-32 (Subidhanagar, Tinkune), Nepal
 * +977-9868156047
 * freelancerumeshnepal@gmail.com
 * https://codecanyon.net/item/unlimited-edu-firm-school-college-information-management-system/21850988
 */

namespace App\Http\Controllers\Account\Report;

use App\Http\Controllers\CollegeBaseController;
use App\Models\BankTransaction;
use App\Models\FeeCollection;
use App\Models\SalaryPay;
use App\Models\Transaction;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use URL;
class FeeCollectionHeadReportController extends CollegeBaseController
{
    protected $base_route = 'account.report.fee-collection-head';
    protected $view_path = 'account.report.fee-collection-head';
    protected $panel = 'Fee Head Collection Report';
    protected $filter_query = [];

    public function __construct()
    {


    }

    public function feeCollectionHead(Request $request)
    {
        $data = [];
        $date = Carbon::now()->toDateString();
        if($request->all()){
            if($request->fee_heads && $request->report_type && $request->start_date && $request->end_date) {
                if($request->report_type == 'daily') {
                    $period = CarbonPeriod::create($request->start_date, $request->end_date);
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->getFeeHeadById($request->fee_heads).' - DAILY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m-d-Y');
                        $feeCollection = $this->dateWithHeadFeeCollection($request->fee_heads, $date);

                        $data[$key]['fee_collection'] = $feeCollection->groupBy('date');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['fee_head_tag'] = 'fee_head';
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                    $data['date_total_fee'] = $data['row']->sum('fee_collection_total');
                }
                elseif($request->report_type == 'weekly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->week();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->getFeeHeadById($request->fee_heads).' - WEEKLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addWeek()->subDay(1))->format('m/d/Y');
                        $feeCollection = $this->dateRangeWithHeadFeeCollection($request->fee_heads,$date,$date->clone()->addWeek()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('date');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['fee_head_tag'] = 'fee_head';
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                    $data['date_total_fee'] = $data['row']->sum('fee_collection_total');
                }
                elseif($request->report_type == 'monthly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->month();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->getFeeHeadById($request->fee_heads).' - MONTHLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addMonth()->subDay(1))->format('m/d/Y') ;
                        $feeCollection = $this->dateRangeWithHeadFeeCollection($request->fee_heads, $date,$date->clone()->addMonth()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('date');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['fee_head_tag'] = 'fee_head';
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                    //dd($data['row']);
                    $data['date_total_fee'] = $data['row']->sum('fee_collection_total');
                }
                elseif($request->report_type == 'yearly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->year();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->getFeeHeadById($request->fee_heads).' - YEARLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addYear()->subDay(1))->format('m/d/Y');
                        $feeCollection = $this->dateRangeWithHeadFeeCollection($request->fee_heads, $date,$date->clone()->addYear()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('date');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['fee_head_tag'] = 'fee_head';
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                    $data['date_total_fee'] = $data['row']->sum('fee_collection_total');
                }
                else{

                }

            }
            elseif($request->report_type && $request->start_date && $request->end_date) {
                if($request->report_type == 'daily') {
                    $period = CarbonPeriod::create($request->start_date, $request->end_date);
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->panel.' - DAILY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y');
                        $feeCollection = $this->dateFeeCollection($date);
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('fee_head');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                }
                elseif($request->report_type == 'weekly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->week();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->panel.' - WEEKLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addWeek()->subDay(1))->format('m/d/Y');
                        $feeCollection = $this->dateRangeFeeCollection($date,$date->clone()->addWeek()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('fee_head');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                }
                elseif($request->report_type == 'monthly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->month();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->panel.' - MONTHLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addMonth()->subDay(1))->format('m/d/Y') ;
                        $feeCollection = $this->dateRangeFeeCollection($date,$date->clone()->addMonth()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('fee_head');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                }
                elseif($request->report_type == 'yearly'){
                    $period = CarbonPeriod::create($request->start_date, $request->end_date)->year();
                    foreach ($period as $key => $date) {
                        $data['print_head'] = $this->panel.' - YEARLY';
                        $data[$key]['table_head'] = Carbon::parse($date)->format('m/d/Y') . ' - ' . Carbon::parse($date->clone()->addYear()->subDay(1))->format('m/d/Y');
                        $feeCollection = $this->dateRangeFeeCollection($date,$date->clone()->addYear()->subDay(1));
                        $data[$key]['fee_collection'] = $feeCollection->groupBy('fee_head');
                        $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                        $key = $key;
                    }
                    $data['keys'] = $key;
                    $data['tag'] = $request->report_type;
                    $data['url'] = URL::current();
                    $data['row'] = collect($data);
                }
                else{

                }

            }
            elseif ($request->fee_heads && $request->start_date && $request->end_date) {
                $period = CarbonPeriod::create($request->start_date, $request->end_date);
                foreach ($period as $key => $date) {
                    $data['print_head'] = $this->getFeeHeadById($request->fee_heads).' - DAILY';
                    $data[$key]['table_head'] = Carbon::parse($date)->format('m-d-Y');
                    $feeCollection = $this->dateWithHeadFeeCollection($request->fee_heads, $date);
                    $data[$key]['fee_collection'] = $feeCollection->groupBy('date');
                    $data[$key]['fee_collection_total'] = $feeCollection->sum('paid_amount');
                    $key = $key;
                }
                $data['keys'] = $key;
                $data['tag'] = 'daily';
                $data['fee_head_tag'] = 'fee_head';
                $data['url'] = URL::current();
                $data['row'] = collect($data);
                $data['date_total_fee'] = $data['row']->sum('fee_collection_total');
            }
            elseif ($request->start_date && $request->end_date) {
                $data['print_head'] = $this->panel.' - ['. Carbon::parse($request->start_date)->format('m/d/Y') . ' - ' . Carbon::parse($request->end_date)->format('m/d/Y') . ']';
                $feeCollection = $this->dateRangeFeeCollection($request->start_date,$request->end_date);
                $data['fee_collection'] = $feeCollection->groupBy('fee_head');
                $data['fee_collection_total'] = $feeCollection->sum('paid_amount');
                $data['tag'] = 'range';
                $data['keys'] = $data['fee_collection']->count();
                $data['row'] = collect($data);
            }
            elseif($request->fee_heads){
                $request->session()->flash($this->message_warning,'Filter With Date Range.');
                $data['tag'] = 'today';
                redirect()->back();

            }
            else{
                $request->session()->flash($this->message_warning,'Filter With Date Range.');
                redirect()->back();
            }

        }else{
            $data['print_head'] = $this->panel.' - '.Carbon::parse($date)->format('m/d/Y');
            $feeCollection = $this->dateFeeCollection($date);
            $data['fee_collection'] = $feeCollection->groupBy('fee_head');
            $data['fee_collection_total'] = $feeCollection->sum('paid_amount');
            $data['tag'] = 'today';
        }


        $data['fee_heads'] = $this->activeFeeHead();
        $data['filter_query'] = $this->filter_query;
        $data['url'] = URL::current();

        return view(parent::loadDataToView($this->view_path.'.index'), compact('data'));
    }

    //with fee head & range
    public function dateRangeWithHeadFeeCollection($head, $start_date, $end_date)
    {
        $feeCollection = FeeCollection::select('fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fee_collections.payment_mode','fee_collections.note',
            'fm.status as fm_status','fm.fee_head')
            ->where('fee_collections.paid_amount', '>',0)
            ->where('fm.fee_head',$head)
            ->whereBetween('fee_collections.date', [$start_date, $end_date])
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->orderBy('fee_collections.created_at','desc')
            ->get();

        return $feeCollection;

    }

    //with head & single date
    public function dateWithHeadFeeCollection($head,$date)
    {
        $feeCollection = FeeCollection::select('fee_collections.fee_masters_id', 'fee_collections.date',
            'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fm.status as fm_status','fm.fee_head')
            ->where('fee_collections.paid_amount', '>',0)
            ->where('fm.fee_head',$head)
            ->whereDate('fee_collections.date', '=', $date)
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->orderBy('fee_collections.date','desc')
            ->get();

        return $feeCollection;
    }

    //date range
    public function dateRangeFeeCollection($start_date, $end_date)
    {
        $feeCollection = FeeCollection::select('fee_collections.students_id',
            'fee_collections.date', 'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fee_collections.payment_mode','fee_collections.note',
            'fm.status as fm_status','fm.fee_head')
            ->whereBetween('fee_collections.date', [$start_date, $end_date])
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->orderBy('fee_collections.date','desc')
            ->get();

        return $feeCollection;
    }

    //single date
    public function dateFeeCollection($date)
    {
        $feeCollection = FeeCollection::select('fee_collections.students_id', 'fee_collections.fee_masters_id', 'fee_collections.date',
            'fee_collections.discount', 'fee_collections.fine', 'fee_collections.paid_amount',
            'fm.status as fm_status','fm.fee_head')
            ->whereDate('fee_collections.date', '=', $date)
            ->join('fee_masters as fm','fm.id','=','fee_collections.fee_masters_id')
            ->orderBy('fee_collections.date','desc')
            ->get();

        return $feeCollection;


    }

}
