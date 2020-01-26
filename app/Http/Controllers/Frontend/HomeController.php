<?php

namespace App\Http\Controllers\Frontend;

use App\About;
use App\Article;
use App\Contact;
use App\Content;
use App\Faq;
use App\Http\Controllers\Controller;
use App\Language;
use App\Mail\SendContactMail;
use App\MinistraClient;
use App\Package;
use App\PaymentMethod;
use App\Product;
use App\Rules\ContactPhoneRule;
use App\Tariff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $articles = Article::orderBy('id', 'desc')->limit(3)->get();
        

        return view('index', compact( 'articles'));
    }

    public function setLocale(Request $request)
    {
        Session::put(['locale' => $request->get('locale')]);
        App::setLocale(Session::get('locale'));
        return redirect()->back();
    }

    public function shop()
    {

        $products=Product::all();
        
        return view('shop', compact('products'));
    }

    public function product($product)
    {
        $product=Product::find($product);
        return view('product', compact('product'));
    }

    public function cart()
    {
        $all_selected_products=\session()->get('user');
        $all_products=[];
        $total=0;
        foreach ($all_selected_products as $k=>$s){
            $product=Product::find($k);
            $product['say']=$s;
            $all_products[]=$product;
            dump($product->price*$s);
        }
        return view('cart', compact('all_products', 'total'));
    }

    public function save_session_value(Request $request)
    {
             session()->put('user.'.$request->id, (int)$request->quantity);

    }

    public function fag()
    {
        $faqs = Faq::all();

        return view('fag')->with([
            'faqs' => $faqs,
        ]);
    }

    public function contact()
    {
        return view('contact');
    }

    public function sendMessage(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => ['required', new ContactPhoneRule],
            'email' => 'required',
            'message' => 'required',
        ]);
        if (Contact::create($request->all())) {

//            $data=array(
//                'name'=>$request->name,
//                'phone'=>$request->phone,
//                'email'=>$request->email,
//                'message'=>$request->message,
//            );
//            Mail::to('efqanesc@gmail.com')->send(new SendContactMail($data));

            return redirect()->back()->with('success', 'Message successfully sent');
        }


        return redirect()->back()->with('error', 'Something went wrong');


    }

    public function about()
    {
        $about = About::find(1);
        if (!isset($about)) {
            return view('about');
        } else {
            return view('about')->with([
                'about' => $about,
            ]);
        }

    }

    public function pricing()
    {
        $tariffs = Tariff::all();
        $faqs = Faq::inRandomOrder()->limit(4)->get();
        $icons = [
            ['icon_color' => 'info', 'icon_name' => 'card_membership'],
            ['icon_color' => 'success', 'icon_name' => 'card_giftcard'],
            ['icon_color' => 'success', 'icon_name' => 'attach_money'],
            ['icon_color' => 'rose', 'icon_name' => 'question_answer'],
        ];

        return view('pricing', compact('tariffs', 'faqs', 'icons'));
    }

    public function channels()
    {
        $client = new MinistraClient();
        $package_ministras = Package::pluck('ministra_id', 'id')->toArray();
        $client_packages = $client->getData('services_package')->results;
        $client_channels = $client->getData('itv')->results;
        $all_channels = [];
        foreach ($client_channels as $client_channel) {
            $all_channels[$client_channel->id] = $client_channel;
        }
        $packages = [];
        foreach ($client_packages as $client_package) {
            if (in_array($client_package->id, $package_ministras)) {
                foreach ($client_package->services as $channels) {
                    $channels->logo = $all_channels[$channels->id]->logo;
                }
                $client_package->name = Package::where('ministra_id', $client_package->id)->value('name');
                $client_package->id = array_search($client_package->id, $package_ministras);
                $packages[] = $client_package;
            }
        }
        sort($packages);
        return view('channels', compact('packages'));
    }


    public function check()
    {
        $conditions = About::where('key', 'conditions')->first();
        return view('check', compact('conditions'));
    }

    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }


    public function article_show($slug)
    {
        $article = Article::where('slug', 'like', '%' . $slug . '%')->firstOrFail();
        return view('article', compact('article'));
    }

    public function payment(Request $request)
    {
        $payment_methods = PaymentMethod::all();
        return view('payment', ['payment_methods' => $payment_methods]);
    }


}
