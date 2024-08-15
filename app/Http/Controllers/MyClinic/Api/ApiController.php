<?php

namespace App\Http\Controllers\MyClinic\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PatientReview;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function reviews_analysis_chart()
    {
        $viewsDone=PatientReview::where('review_type','معاينة')->where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereDone(1)
        // ->whereCh_d(1)
        ->whereDoctor_id(1)
        ->pluck('count', 'month');
        $reviewsDone=PatientReview::where('review_type','مراجعة')->where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereDone(1)
        // ->whereCh_d(1)
        ->whereDoctor_id(1)
        ->pluck('count', 'month');
            // $fullReviews = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullReviews[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($reviewsDone as $month => $value) {
            //     $fullReviews[$month] = $value;
            // }
        $emengDone=PatientReview::where('review_type','اسعافية')->where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereDone(1)
        // ->whereCh_d(1)
        ->whereDoctor_id(1)
        ->pluck('count', 'month');
            // $fullEmergs = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullEmergs[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($emengDone as $month => $value) {
            //     $fullEmergs[$month] = $value;
            // }
        $visitDone=PatientReview::where('review_type','زيارة')->where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereDone(1)
        // ->whereCh_d(1)
        ->whereDoctor_id(1)
        ->pluck('count', 'month');

            // $fullVistes = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullVistes[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($visitDone as $month => $value) {
            //     $fullVistes[$month] = $value;
            // }
        // dd($reviewsDone);
        foreach ($viewsDone->keys() as $month_number) {
            $labels[]='الشهر ( '.$month_number.' )';
            // $labels[]=date('F', mktime(0 , 0 , 0 , $month_number, 1 ));
        }
        $chart['labels']= $labels;
        $chart['datasets'][0]['name']='معاينات';
        $chart['datasets'][0]['values']=$viewsDone->values()->toArray();

        $chart['datasets'][1]['name']='مراجعات';
        // $chart['datasets'][1]['values']=array_values($fullReviews);
        $chart['datasets'][1]['values']=$reviewsDone->values()->toArray();

        $chart['datasets'][2]['name']='إسعافيات';
        $chart['datasets'][2]['values']=$emengDone->values()->toArray();

        $chart['datasets'][3]['name']='زيارات';
        $chart['datasets'][3]['values']=$visitDone->values()->toArray();

        return response()->json($chart);
    }

    public function reviews_leaved_analysis_chart()// الخط البياني
    {
        $allReviews=PatientReview::where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereCh_d(1)
        ->whereDoctor_id(1)
        ->pluck('count', 'month');

        $reviewsDoneViews=PatientReview::where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereCh_d(1)
        ->where('review_type','معاينة')
        ->whereDoctor_id(1)
        ->pluck('count', 'month');


        $reviewsDoneReviews=PatientReview::where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereCh_d(1)
        ->where('review_type','مراجعة')
        ->whereDoctor_id(1)
        ->pluck('count', 'month');

            // $fullReviews = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullReviews[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($reviewsDoneReviews as $month => $value) {
            //     $fullReviews[$month] = $value;
            // }


        $reviewsDoneEmergs=PatientReview::where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereCh_d(1)
        ->where('review_type','اسعافية')
        ->whereDoctor_id(1)
        ->pluck('count', 'month');

            // $fullEmergs = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullEmergs[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($reviewsDoneEmergs as $month => $value) {
            //     $fullEmergs[$month] = $value;
            // }


        $reviewsDoneVistes=PatientReview::where('done',1)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        ->whereYear('created_at',date('Y'))
        ->groupBy(DB::raw('Month(created_at)'))
        // ->whereCh_d(1)
        ->where('review_type','زيارة')
        ->whereDoctor_id(1)
        ->pluck('count', 'month');

            // $fullVistes = [];
            // for ($i = 1; $i <= 12; $i++) {
            //     $fullVistes[$i] = 0; // تعيين قيمة صفر لكل شهر افتراضيًا
            // }

            // // دمج القيم من المصفوفة الأصلية في المصفوفة الجديدة
            // foreach ($reviewsDoneVistes as $month => $value) {
            //     $fullVistes[$month] = $value;
            // }


        // $reviewsleaved=PatientReview::where('leave_off',0)->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
        // ->whereYear('created_at', date('Y'))
        // ->groupBy(DB::raw('Month(created_at)'))
        // ->whereDone(1)
        // ->pluck('count', 'month');



        // dd($reviewsDone);
        foreach ($allReviews->keys() as $month_number) {
             $labels[]='الشهر ( '.$month_number.' )';
            // $labels[]=date('F', mktime(0 , 0 , 0 , $month_number, 1 ));
        }
        $chart['labels']= $labels;
        $chart['datasets'][0]['name']='تم الفحص';
        $chart['datasets'][0]['values']=$allReviews->values()->toArray();

        $chart['datasets'][1]['name']='المعاينات';
        $chart['datasets'][1]['values']=$reviewsDoneViews->values()->toArray();
        $chart['datasets'][2]['name']='المراجعات';
        // $chart['datasets'][2]['values']=array_values($reviewsDoneReviews);
        $chart['datasets'][2]['values']=$reviewsDoneReviews->values()->toArray();
        $chart['datasets'][3]['name']='الإسعافيات';
        $chart['datasets'][3]['values']=$reviewsDoneEmergs->values()->toArray();
        $chart['datasets'][4]['name']='الزيارات';
        $chart['datasets'][4]['values']=$reviewsDoneVistes->values()->toArray();

        // $chart['datasets'][1]['name']='غادر';
        // $chart['datasets'][1]['values']=$reviewsleaved->values()->toArray();



        return response()->json($chart);
    }


// public function reviews_leaved_analysis_chart()
// {
//     $variables = ['allReviews', 'reviewsDoneViews', 'reviewsDoneReviews', 'reviewsDoneEmergs', 'reviewsDoneVistes'];
//     $fullData = [];

//     // المصفوفة التي تحتوي على جميع الشهور
//     for ($i = 1; $i <= 12; $i++) {
//         $fullData[$i] = [];
//     }

//     // ملأ القيم الفارغة بصفر لكل متغير
//     foreach ($variables as $key => $variable) {
//         $data = PatientReview::where('done', 1)
//             ->select(DB::raw('COUNT(*) as count'), DB::raw('Month(created_at) as month'))
//             ->whereYear('created_at', 2023)
//             ->groupBy(DB::raw('Month(created_at)'))
//             ->whereCh_d(1)
//             ->whereDoctor_id(1);

//         // تحديد نوع المراجعة
//         switch ($key) {
//             case 0:
//                 $data->where('review_type', 'معاينة');
//                 break;
//             case 1:
//                 $data->where('review_type', 'مراجعة');
//                 break;
//             case 2:
//                 $data->where('review_type', 'اسعافية');
//                 break;
//             case 3:
//                 $data->where('review_type', 'زيارة');
//                 break;
//             default:
//                 break;
//         }

//         $values = $data->pluck('count', 'month');

//         // ملأ القيم في المصفوفة النهائية
//         foreach ($values as $month => $value) {
//             $fullData[$month][$key] = $value;
//         }
//     }

//     // تحويل المصفوفة النهائية إلى شكل يمكن عرضه في الرسم البياني
//     $finalData = [];
//     foreach ($fullData as $month => $values) {
//         $monthName = date('F', mktime(0, 0, 0, $month, 1));
//         $finalData[$monthName] = array_values($values);
//     }

//     // إعداد البيانات للعرض
//     $chart['labels'] = array_keys($finalData);
//     $chart['datasets'] = [];

//     foreach ($variables as $key => $variable) {
//         $chart['datasets'][$key]['name'] = $variable;
//         $chart['datasets'][$key]['values'] = array_column($finalData, $key);
//     }

//     return response()->json($chart);
// }

    public function last_reviews_analysis_chart() // دونات
    {
        $countViewsDone=PatientReview::whereDone(1)
        ->whereDoctor_id(1)
        ->where('review_type','معاينة')->count();

        $countReviewsDone=PatientReview::whereDone(1)
        ->whereDoctor_id(1)
        ->where('review_type','مراجعة')->count();

        $countEmengDone=PatientReview::whereDone(1)
        ->whereDoctor_id(1)
        ->where('review_type','اسعافية')->count();

        $countVisitDone=PatientReview::whereDone(1)
        ->whereDoctor_id(1)
        ->where('review_type','زيارة')->count();

        $all = $countViewsDone + $countReviewsDone + $countEmengDone + $countVisitDone ;
        $finalViewsDone = ($countViewsDone / $all ) * 100 ;
        $finalcountViewsDone = round($finalViewsDone , 2) ;//أرقام بعد الفاصلة

        $finalReviewsDone = ($countReviewsDone / $all ) * 100 ;
        $finalcountReviewsDone = round($finalReviewsDone , 2) ;

        $finalEmengDone = ($countEmengDone / $all ) * 100 ;
        $finalcountEmengDone = round($finalEmengDone , 2) ;

        $finalVisitDone = ($countVisitDone / $all ) * 100 ;
        $finalcountVisitDone = round($finalVisitDone , 2) ;

        $reviews=['معاينة','مراجعة','اسعافية','زيارة'];
        $reviewsvalues=[$finalcountViewsDone , $finalcountReviewsDone , $finalcountEmengDone ,$finalcountVisitDone ];

        $chart['labels']= $reviews;
        $chart['datasets']['name']='النسبة المئوية للزيارات المكتملة';
        $chart['datasets']['values']=$reviewsvalues;

        return response()->json($chart);

    }

}
