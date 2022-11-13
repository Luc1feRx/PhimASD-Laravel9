<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    public function index()
    {
        $category_movies = Category::with('movie')->get();
        return view('client.pages.index', [
            'title' => 'PhimASD',
            'category_movies' => $category_movies,
        ]);
    }

    public function categoryDetail($slug = '')
    {
        $cate_movie = Category::with([
            'movie' => function ($query) {
                $query->latest()->paginate(8);
            }
        ])->where('slug', $slug)->first();
        return view('client.pages.categories', [
            'title' => $cate_movie->name,
            'cate_movies' => $cate_movie
        ]);
    }

    public function MovieDetail($slug = '')
    {
        $movie = Movie::with('movie_genre', 'movie_category', 'country', 'movie_actor')->where('slug', $slug)->first();
        $episodes = Episode::where('movie_id', $movie->id)->get();
        $firstEp = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'asc')->first();
        $comments = Comment::with('user')->where('movie_id', $movie->id)->where('state', 1)->paginate(10);
        return view('client.pages.detail', [
            'title' => $movie->name,
            'movie' => $movie,
            'episodeCount' => $episodes->count(),
            'firstEp' => $firstEp,
            'comments' => $comments
        ]);
    }

    public function WatchMovie($slug = '', $episode, Request $request)
    {
        $m = Movie::with('related_episodes', 'movie_category', 'country')->where('slug', $slug)->first();
        $episodes = Episode::with('movie')->where('movie_id', $m->id)->where('episodes', $episode)->first();
        $get_ep_link1 = Episode::with('movie')->select('id', 'movie_id', 'slug', 'link1', 'episodes')->where('movie_id', $m->id)->get();
        // dd($episodes);
        return view('client.pages.movies', [
            'title' => $m->name,
            'm' => $m,
            'eachEpisode' => $episodes,
            'get_eps' => $get_ep_link1,
            'current_ep' => $request->episode,
            'getEp' => $request->episode
        ]);
    }

    public function BackUpLink($movie, $episode)
    {
        $get_ep_link2 = Episode::select('id', 'movie_id', 'slug', 'link2', 'episodes')->where('movie_id', $movie)->where('episodes', $episode)->get();
        return response()->json([
            'get_ep_link2' => $get_ep_link2
        ]);
    }

    public function SearchAjax(Request $request)
    {
        $html = "";
        $data = $request->all();
        if ($data['keywords']) {
            $movie = Movie::where(function ($query) use ($data) {
                $query->where('name', 'LIKE', '%' . $data['keywords'] . '%')
                    ->orWhere('name_eng', 'LIKE', '%' . $data['keywords'] . '%');
            })->get();


            if ($movie == true) {
                foreach ($movie as $m) {
                    $CountEp = Episode::where('movie_id', $m->id)->get();
                    $html .= "<li>
                        <a style='    text-decoration: none;
                        display: flex;
                        align-items: center;' href='" . route('movie.detail', ['slug' => $m->slug]) . "'>
                        <img style='width: 110px;
                        height: 140px;' src='" . Storage::disk('s3')->temporaryURL('uploads/movies/' . $m->image, now()->addMinutes(10)) . "' alt=''>
                        <div style='margin-left: 12px;
                        display: grid;'>
                        <span> " . $m->name . "</span>
                        ";

                    if ($CountEp->count() > 1) {
                        $html .= "<span> " . $m->year_release . " (" . $m->episodes . " / " . $CountEp->count() . " tập) </span> ";
                    } else {
                        $html .= "<span> " . $m->year_release . " (" . $m->duration . ") </span> ";
                    }

                    $html .= "</div></a>
                    </li>";
                }
            } else if ($movie == false) {
                $html .= "<li>
                <a style='text-decoration: none;' href=''>Không Tìm Thấy</a>
                </li>";
            }
        }
        return Response($html);
    }

    public function vnpay_payment(Request $request, $slug)
    {
        // session(['cost_id' => $request->id]);
        // session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "93H0097O"; //Mã website tại VNPAY 
        $vnp_HashSecret = "XZZDRCUZWMRYBXLARCFTOZKPDYOXZLIG"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/client/watch/movie/". $slug ."/episode-1";
        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 20000 * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00', 'message' => 'success', 'data' => $vnp_Url
        );
        if (isset($_POST['redirect'])) {
            return redirect($vnp_Url);
        } else {
            echo json_encode($returnData);
        }
    }
}
