<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Imports\TimesharesImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Timeshare;
use App\Commercial;
use App\Transfer;
use App\Seller;
use App\Residential;
use App\Contact;
use App\ContactResort;
use App\Interest;
use App\Post;
use App\Agency;
use App\Support;
use Auth;
use View;
use Mail;
use App\TimeshareLog;
use App\TimeshareBulk;
use App\Resort;

class PagesController extends Controller {

	protected static $rules = [
        'username' => 'required',
        'password' => 'required'

    ];

	public function serveHome()
	{
		return View::make('home');
	}

	public function serveAbout()
	{
		return View::make('about');
	}

	public function serveContact()
	{
		return View::make('contact-us');
	}

	public function serveFAQs()
	{
		return View::make('faqs');
	}

	public function servePrivacyPolicy()
	{
		return View::make('privacy-policy');
	}

	public function serveTimeshare()
	{
		return View::make('timeshare');
	}

	public function serveAdmin()
	{
		$timeshares = DB::table('timeshares')
		->orderBy('published','asc')
        ->paginate(10);
        
        $resorts = DB::table('resorts')
		->orderBy('resort','asc')
		->get();

		if (Auth::check() && Auth::user()->role == "admin") {
            return View::make('admin.admin')
            ->with('resorts',$resorts)
			->with('timeshares',$timeshares);
		  }else{
			return Redirect::to('/');
		}
	}

	public function serveCommercialAdmin()
	{
		$commercials = DB::table('commercials')
		->orderBy('name','asc')
		->paginate(15);

		if (Auth::check() && Auth::user()->role == "admin") {
			return View::make('admin.commercial-admin')
			->with('commercials',$commercials);
		  }else{
			return Redirect::to('/');
		}
	}

	public function serveResidentialAdmin()
	{
		$residentials = DB::table('residentials')
		->orderBy('name','asc')
		->paginate(15);

		if (Auth::check() && Auth::user()->role == "admin") {
			return View::make('admin.residential-admin')
			->with('residentials',$residentials);
		  }else{
			return Redirect::to('/');
		}
	}

	public function serveToSell()
	{
		$resorts = DB::table('resorts')
		->orderBy('resort','asc')
		->get();

		return View::make('to-sell')
		->with('resorts',$resorts);
	}

	public function handleToSell()
	{
		$validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'week' => 'required',
				'module' => 'required',
				'bedrooms' => 'required',
				'season' => 'required',
				'sleeps' => 'required',
				'unit' => 'required',
                'region' => 'required'
            ]);

        if(!Input::has('mandate') && Auth::user()->agency!=NULL)
        {
            return Redirect::back()->with('view-error', 'A copy of a mandate is required to submit your timeshare.')->withInput()->withErrors($validator);
        }


		if(!Auth::check())
        {
            return Redirect::back()->with('view-error', ' You need to be logged in to submit a timeshare, please login or register if you do not have an account')->withInput()->withErrors($validator);
        }

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' Some information is missing, please review and try again.')->withInput()->withErrors($validator);
		}

		//$id = Auth::user()->id;

		$seller = new Seller;
		$seller->paid = Input::get('paid');
		$seller->rental = Input::get('rental');
        $seller->spaceBanked = Input::get('spaceBanked');
		$seller->date = Input::get('date');
		$seller->purchasePrice = Input::get('purchasePrice');
		$seller->sellingPrice = Input::get('sellingPrice');
		$seller->estateAgency = Input::get('estateAgency');
		$seller->commission = Input::get('commission');
		$seller->agentName = Input::get('agentName');
		$seller->agencyName = Input::get('agencyName');
		$seller->referedBy = Input::get('referedBy');
		$seller->occupationDate1 = Input::get('occupationDate1');
        $seller->occupationDate2 = Input::get('occupationDate2');
        $seller->save();


        $timeshare = new Timeshare;
		$timeshare->resort = Input::get('resort');
		$timeshare->names = Auth::user()->name;
		$timeshare->email = Auth::user()->email;
		$timeshare->phone = Auth::user()->phone;
		$timeshare->mobile = Auth::user()->mobile;
		$timeshare->week = Input::get('week');
		$timeshare->season = Input::get('season');
		$timeshare->module = Input::get('module');
		$timeshare->region = Input::get('region');
		$timeshare->price = Input::get('sellingPrice');
		$timeshare->bedrooms = Input::get('bedrooms');
		$timeshare->other = Input::get('other');
		$timeshare->sleeps = Input::get('sleeps');
		$timeshare->unit = Input::get('unit');
		$timeshare->owner = Input::get('owner');
		$timeshare->listingFee = 'Pending';
        $timeshare->paid = Input::get('paid');
        $timeshare->levy = Input::get('levy');
        $timeshare->fromDate = Input::get('occupationDate1');
        $timeshare->toDate = Input::get('occupationDate2');
		$timeshare->spacebankedyear = Input::get('spacebankedyear');
		$timeshare->spacebankOwner = Input::get('spacebankOwner');
		$timeshare->agency = Auth::user()->agency;
        $timeshare->agent = Auth::user()->name;

        $request = request();

        $mandate = $request->file('mandate');
        $profileImageSaveAsName = time() . Auth::id() . "-mandate." .
                                  $mandate->getClientOriginalExtension();

        $upload_path = public_path() .'mandates/';
        $profile_image_url = '/'.$upload_path . $profileImageSaveAsName;
        $success = $mandate->move($upload_path, $profileImageSaveAsName);

        $timeshare->mandate = $profile_image_url;

        $timeshare->save();

		$data = ['timeshare' => $timeshare, 'seller' => $seller];

        Mail::send('emails.timeshare', $data, function($message) use ($timeshare)
        {
            $message->to('rachael@x-scape.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New timeshare submission');
            $message->from('info@univateproperties.co.za');
            $message->attach($timeshare->mandate);
		});

		return Redirect::to('/pay-listing-fee/'.$timeshare->id)->with('view-success',' Your Timeshare has been successfully submitted');
	}

	public function servePayListingFee($id)
	{
		$timeshare = DB::table('timeshares')
			->where('id','=',$id)
			->first();

			return View::make('pay-listing-fee')
				->with('timeshare',$timeshare);
	}

	public function serveToBuy()
	{
        $timeshares = DB::table('timeshares')
            ->get();

        $resorts = DB::table('resorts')
            ->orderBy('resort','asc')
            ->get();

            $gauteng = NULL;
            $limpopo = NULL;
            $mpumalanga = NULL;
            $kwazulunatal = NULL;
            $freestate = NULL;
            $northwest = NULL;
            $northerncape = NULL;
            $westerncape = NULL;
            $easterncape = NULL;

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='gauteng' and $timeshare->published=1)
                {
                    $gauteng = DB::table('resorts')
                        ->where('region','=','gauteng')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='limpopo' && $timeshare->published=1)
                {
                    $limpopo = DB::table('resorts')
                        ->where('region','=','limpopo')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='mpumalanga' && $timeshare->published=1)
                {
                    $mpumalanga = DB::table('resorts')
                        ->where('region','=','mpumalanga')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='Kwazulu Natal' && $timeshare->published=1)
                {
                    $kwazulunatal = DB::table('resorts')
                        ->where('region','=','Kwazulu Natal')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='free state' && $timeshare->published=1)
                {
                    $freestate = DB::table('resorts')
                        ->where('region','=','free state')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='north west' && $timeshare->published=1)
                {
                    $northwest = DB::table('resorts')
                        ->where('region','=','north west')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='northern cape' && $timeshare->published=1)
                {
                    $northerncape = DB::table('resorts')
                        ->where('region','=','northern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='western cape' && $timeshare->published=1)
                {
                    $westerncape = DB::table('resorts')
                        ->where('region','=','western cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='eastern cape' && $timeshare->published=1)
                {
                    $easterncape = DB::table('resorts')
                        ->where('region','=','eastern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

        return View::make('to-buy')
        ->with('resorts',$resorts)
		->with('easterncape',$easterncape)
		->with('limpopo',$limpopo)
		->with('northwest',$northwest)
		->with('northerncape',$northerncape)
		->with('westerncape',$westerncape)
		->with('kwazulunatal',$kwazulunatal)
		->with('mpumalanga',$mpumalanga)
		->with('freestate',$freestate)
		->with('gauteng',$gauteng);
	}

	public function serveResortUpload()
	{
		return View::make('resort-upload');
	}

	public function handleResortUpload()
	{
		$validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'region' => 'required',
				'information' => 'required',
				'image1' => 'required',
				'image2' => 'required',
				'logo' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $resort = new Resort;
        $resort->resort = Input::get('resort');
        $resort->information = Input::get('information');
		$resort->region = Input::get('region');

		if(Input::has('advisor'))
		{
			$resort->advisor = Input::get('advisor');
		}

		if(Input::has('awards'))
		{
			$resort->awards = implode(',',Input::get('awards'));
		}

		$file = Input::file('image1');
		$file->move('images/resorts/', $file->getClientOriginalName());
		$resort->image1 = '/images/resorts/'.$file->getClientOriginalName();

		$file = Input::file('image2');
		$file->move('images/resorts/', $file->getClientOriginalName());
		$resort->image2 = '/images/resorts/'.$file->getClientOriginalName();

		$file = Input::file('logo');
		$file->move('images/logos/', $file->getClientOriginalName());
		$resort->logo = '/images/logos/'.$file->getClientOriginalName();

        $resort->save();

		return Redirect::back()->with('view-success',' Resort has been successfully uploaded');
	}


	public function serveLogin()
	{
		return View::make('login');
	}

	public function handleLogin()
    {
        $validator = Validator::make(Input::all(), static::$rules);

        if (Auth::attempt(['username' => Input::get('username'), 'password' => Input::get('password')]))
        {
            //$role = Auth::user()->role;
            return Redirect::back();
        }

        elseif((Input::get('password'))==NULL and Input::get('username'))
        {
            return Redirect::back()->withInput()->withErrors($validator)->with('view-error', ' A password is required to login.');
        }

        elseif((Input::get('username'))==NULL and Input::get('password'))
        {
            return Redirect::back()->withInput()->withErrors($validator)->with('view-error', 'An username is required to login.');
		}

        elseif($validator->fails())
        {
            return Redirect::back()->withInput()->withErrors($validator)->with('view-error', '<strong>Oops!</strong> No credentials entered.');
        }

        else
        {
            return Redirect::back()->withInput()->with('view-error', 'The username and password you entered do not correspond, please try again.');
        }

	}

	public function handleLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/');
	}

	public function publishTimeshareAgent($id)
	{
		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'timeshare_publish' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'This agent has been successfully verified.');
	}

	public function publishTimeshare($id)
	{
		DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'published' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'Timeshare successfully published.');
	}

	public function publishCommercial($id)
	{
		DB::table('commercials')
                    ->where('id','=', $id)
                    ->update(array(
                            'published' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'Commercial property is successfully published.');
	}

	public function publishResidential($id)
	{
		DB::table('residentials')
                    ->where('id','=', $id)
                    ->update(array(
                            'published' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'Residential property successfully published.');
	}

	public function serveInterested($id)
	{
		$timeshare = DB::table('timeshares')
		->where('id','=',$id)
		->first();

		return View::make('interested')
		->with('timeshare',$timeshare);
	}

	public function handleInterested($id)
	{
		$timeshare = DB::table('timeshares')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'timeshare' => $timeshare];

        Mail::send('emails.interested', $data, function($message)
        {
            $message->to('koketso.maphopha@gmail.com','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this resort');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}


	public function serveCommercialPropertyInterested($id)
	{
		$property = DB::table('commercials')
		->where('id','=',$id)
		->first();

		return View::make('interested-in-commercial-property')
		->with('property',$property);
	}

	public function handleCommercialPropertyInterested($id)
	{
		$property = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'property' => $property];

        Mail::send('emails.interestedCommercialProperty', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this property');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success',' Enquiry submitted.');
	}

	public function serveResidentialPropertyInterested($id)
	{
		$property = DB::table('residentials')
		->where('id','=',$id)
		->first();

		return View::make('interest-in-residential-property')
		->with('property',$property);
	}

	public function handleResidentialPropertyInterested($id)
	{
		$property = DB::table('residentials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'property' => $property];

        Mail::send('emails.interestedResidentialProperty', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this property');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success',' Enquiry submitted.');
	}

	public function serveResorts($province)
	{
		$resorts = DB::table('timeshares')
		->where('region','=',$province)
		->groupBy('resort')
		->get();

		return View::make('resorts')
		->with('province',$province)
		->with('resorts',$resorts);
	}

	public function serveResort($slug)
	{
		$resort = DB::table('resorts')
        ->where('slug','=',$slug)
        ->orWhere('resort','=',$slug)
		->first();
		$timeshares = DB::table('timeshares')
		->where('resort','=',$resort->resort)
		->where('published','=',1)
		->paginate(5);

		$awards = explode(',',$resort->awards);
		$facilities = explode(',',$resort->facilities);

		//$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/LE";

		//$details = json_decode(file_get_contents($wsdl), true);

		return View::make('resort')
		->with('facilities',$facilities)
		->with('awards',$awards)
		->with('timeshares',$timeshares)
		->with('resort',$resort);
	}

	public function serveEditTimeshare($id)
	{
		$timeshare = DB::table('timeshares')
		->where('id','=',$id)
		->first();

		return View::make('edit-timeshare')
			->with('timeshare',$timeshare);
	}

	public function handleEditTimeshare($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'module' => 'required',
				'week' => 'required',
				'bedrooms' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $timeshare = DB::table('timeshares')
            ->where('id','=',$id)
            ->first();

        if(Input::get('resort')!=$timeshare->resort)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Resort name changed from '.$timeshare->resort.' to '.Input::get('resort');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'resort' => Input::get('resort')
                )
            );
        }

        if(Input::get('module')!=$timeshare->module)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Module changed from '.$timeshare->module.' to '.Input::get('module');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'module' => Input::get('module')
                )
            );
        }

        if(Input::get('week')!=$timeshare->week)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Week changed from '.$timeshare->week.' to '.Input::get('week');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'week' => Input::get('week')
                    )
                );

        }

        if(Input::get('levy')!=$timeshare->levy)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Levy changed from '.$timeshare->levy.' to '.Input::get('levy');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'levy' => Input::get('levy')
                    )
                );

        }

        if(Input::get('fromDate')!=$timeshare->fromDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Departure date changed from '.$timeshare->fromDate.' to '.Input::get('fromDate');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'fromDate' => Input::get('fromDate')
                    )
                );
        }

        if(Input::get('toDate')!=$timeshare->toDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Arrival date changed from '.$timeshare->toDate.' to '.Input::get('toDate');
            $log->save();

            DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'toDate' => Input::get('toDate')
			)
        );
        }

        if(Input::get('season')!=$timeshare->season)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The season was changed from '.$timeshare->season.' to '.Input::get('season');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'season' => Input::get('season')
                )
            );
        }

        if(Input::get('region')!=$timeshare->region)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The region was changed from '.$timeshare->region.' to '.Input::get('region');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'region' => Input::get('region')
                )
            );
        }

        if(Input::get('setPrice')!=$timeshare->setPrice)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The set price was changed from '.$timeshare->setPrice.' to '.Input::get('setPrice');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'setPrice' => Input::get('setPrice')
                )
            );
        }

        if(Input::get('price')!=$timeshare->price)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The price was changed from '.$timeshare->price.' to '.Input::get('price');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'price' => Input::get('price')
                )
            );
        }

        if(Input::get('bedrooms')!=$timeshare->bedrooms)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The number of bedrooms was changed from '.$timeshare->bedrooms.' to '.Input::get('bedrooms');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'bedrooms' => Input::get('bedrooms')
                )
            );
        }

        if(Input::get('sleeps')!=$timeshare->sleeps)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The maximum occupation per unit was changed from '.$timeshare->sleeps.' to '.Input::get('sleeps');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'sleeps' => Input::get('sleeps')
                )
            );
        }

        if(Input::get('unit')!=$timeshare->unit)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The unit number was changed from '.$timeshare->unit.' to '.Input::get('unit');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'unit' => Input::get('unit')
                    )
                );
        }

        if(Input::get('owner')!=$timeshare->owner)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The owner was changed from '.$timeshare->owner.' to '.Input::get('owner');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'owner' => Input::get('owner')
                )
            );
        }

        if(Input::get('spacebankedyear')!=$timeshare->spacebankedyear)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The space banked year was changed from '.$timeshare->spacebankedyear.' to '.Input::get('spacebankedyear');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'spacebankedyear' => Input::get('spacebankedyear')
                )
            );
        }

        if(Input::get('spacebankOwner')!=$timeshare->spacebankOwner)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The space bank owner was changed from '.$timeshare->spacebankOwner.' to '.Input::get('spacebankOwner');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'spacebankOwner' => Input::get('spacebankOwner')
                )
            );
        }

        if(Input::get('status')!='NULL')
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The status was changed from '.$timeshare->status.' to '.Input::get('status');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'status' => Input::get('status')
                )
            );
        }

        if(Input::get('publish')!='NULL')
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The publish status was changed from '.$timeshare->published.' to '.Input::get('published');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'published' => Input::get('publish')
                )
            );
        }

        if(Input::get('statusDate')!=$timeshare->statusDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The status date was changed from '.$timeshare->statusDate.' to '.Input::get('statusDate');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'statusDate' => Input::get('statusDate')
                )
            );
        }

		return Redirect::to('admin')->with('view-success',' Timeshare successfully updated');

	}

	public function serveEditAgencyTimeshare($id)
	{
		$timeshare = DB::table('timeshares')
		->where('id','=',$id)
		->first();

		return View::make('edit-agency-timeshare')
			->with('timeshare',$timeshare);
	}

	public function handleEditAgencyTimeshare($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'module' => 'required',
				'week' => 'required',
				'bedrooms' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		$timeshare = DB::table('timeshares')
            ->where('id','=',$id)
            ->first();

        if(Input::get('resort')!=$timeshare->resort)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Resort name changed from '.$timeshare->resort.' to '.Input::get('resort');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'resort' => Input::get('resort')
                )
            );
        }

        if(Input::get('module')!=$timeshare->module)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Module changed from '.$timeshare->module.' to '.Input::get('module');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'module' => Input::get('module')
                )
            );
        }

        if(Input::get('week')!=$timeshare->week)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Week changed from '.$timeshare->week.' to '.Input::get('week');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'week' => Input::get('week')
                    )
                );

        }

        if(Input::get('levy')!=$timeshare->levy)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Levy changed from '.$timeshare->levy.' to '.Input::get('levy');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'levy' => Input::get('levy')
                    )
                );

        }

        if(Input::get('fromDate')!=$timeshare->fromDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Departure date changed from '.$timeshare->fromDate.' to '.Input::get('fromDate');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'fromDate' => Input::get('fromDate')
                    )
                );
        }

        if(Input::get('toDate')!=$timeshare->toDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'Arrival date changed from '.$timeshare->toDate.' to '.Input::get('toDate');
            $log->save();

            DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'toDate' => Input::get('toDate')
			)
        );
        }

        if(Input::get('season')!=$timeshare->season)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The season was changed from '.$timeshare->season.' to '.Input::get('season');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'season' => Input::get('season')
                )
            );
        }

        if(Input::get('region')!=$timeshare->region)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The region was changed from '.$timeshare->region.' to '.Input::get('region');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'region' => Input::get('region')
                )
            );
        }

        if(Input::get('setPrice')!=$timeshare->setPrice)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The set price was changed from '.$timeshare->setPrice.' to '.Input::get('setPrice');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'setPrice' => Input::get('setPrice')
                )
            );
        }

        if(Input::get('price')!=$timeshare->price)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The price was changed from '.$timeshare->price.' to '.Input::get('price');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'price' => Input::get('price')
                )
            );
        }

        if(Input::get('bedrooms')!=$timeshare->bedrooms)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The number of bedrooms was changed from '.$timeshare->bedrooms.' to '.Input::get('bedrooms');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'bedrooms' => Input::get('bedrooms')
                )
            );
        }

        if(Input::get('sleeps')!=$timeshare->sleeps)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The maximum occupation per unit was changed from '.$timeshare->sleeps.' to '.Input::get('sleeps');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'sleeps' => Input::get('sleeps')
                )
            );
        }

        if(Input::get('unit')!=$timeshare->unit)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The unit number was changed from '.$timeshare->unit.' to '.Input::get('unit');
            $log->save();

            DB::table('timeshares')
                ->where('id','=', $id)
                ->update(array(
                        'unit' => Input::get('unit')
                    )
                );
        }

        if(Input::get('owner')!=$timeshare->owner)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The owner was changed from '.$timeshare->owner.' to '.Input::get('owner');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'owner' => Input::get('owner')
                )
            );
        }

        if(Input::get('spacebankedyear')!=$timeshare->spacebankedyear)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The space banked year was changed from '.$timeshare->spacebankedyear.' to '.Input::get('spacebankedyear');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'spacebankedyear' => Input::get('spacebankedyear')
                )
            );
        }

        if(Input::get('spacebankOwner')!=$timeshare->spacebankOwner)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The space bank owner was changed from '.$timeshare->spacebankOwner.' to '.Input::get('spacebankOwner');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'spacebankOwner' => Input::get('spacebankOwner')
                )
            );
        }

        if(Input::get('status')!='NULL')
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The status was changed from '.$timeshare->status.' to '.Input::get('status');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'status' => Input::get('status')
                )
            );
        }

        if(Input::get('publish')!='NULL')
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The publish status was changed from '.$timeshare->published.' to '.Input::get('published');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'published' => Input::get('publish')
                )
            );
        }

        if(Input::get('statusDate')!=$timeshare->statusDate)
        {
            $log = new TimeshareLog;
            $log->user_id = Auth::user()->id;
            $log->timeshare_id = $timeshare->id;
            $log->name = Auth::user()->name;
            $log->resort = $timeshare->resort;
            $log->module = $timeshare->module;
            $log->unit = $timeshare->unit;
            $log->change = 'The status date was changed from '.$timeshare->statusDate.' to '.Input::get('statusDate');
            $log->save();

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'statusDate' => Input::get('statusDate')
                )
            );
        }

		return Redirect::to('manage-agency-timeshares')->with('view-success',' Timeshare successfully updated');

	}

	public function serveEditTimeshareAgent($id)
	{
		$user = DB::table('users')
		->where('id','=',$id)
		->first();

		return View::make('edit-timeshare-agent')
			->with('user',$user);
	}

	public function handleEditTimeshareAgent($id)
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'email' => Input::get('email')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'phone' => Input::get('phone')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'mobile' => Input::get('mobile')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'username' => Input::get('username')
			)
		);


	if(Input::get('timeshare_publish')!='NULL') {
		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'timeshare_publish' => Input::get('timeshare_publish')
			)
		);
	}

		return Redirect::to('timeshare-agents')->with('view-success',' Agent details successfully updated');

	}

	public function serveEditCommercial($id)
	{
		$commercial = DB::table('commercials')
		->where('id','=',$id)
		->first();

		return View::make('admin.edit-commercial')
			->with('commercial',$commercial);
	}

	public function handleEditCommercial($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('commercials')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'address' => Input::get('address')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'region' => Input::get('region')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'town' => Input::get('town')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'status2' => Input::get('status2')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'surburb' => Input::get('surburb')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'unit' => Input::get('unit')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'size' => Input::get('size')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'price' => Input::get('price')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'description' => Input::get('description')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_person' => Input::get('contact_person')
			)
		);
		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_email' => Input::get('contact_email')
			)
		);
		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_mobile' => Input::get('contact_mobile')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'propertType' => Input::get('propertType')
			)
		);

		return Redirect::to('commercial-admin')->with('view-success',' Commercial property successfully updated');

	}

	public function serveEditResidential($id)
	{
		$residential = DB::table('residentials')
		->where('id','=',$id)
		->first();

		return View::make('admin.edit-residential')
			->with('residential',$residential);
	}

	public function handleEditResidential($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('residentials')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'address' => Input::get('address')
			)
		);

		if(Input::get('region')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'region' => Input::get('region')
			)
		);
	}

	if(Input::get('town')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'town' => Input::get('town')
			)
		);
	}

	if(Input::get('status2')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'status2' => Input::get('status2')
			)
		);
	}

	if(Input::get('status')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'status' => Input::get('status')
			)
		);
	}

	if(Input::get('surburb')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'surburb' => Input::get('surburb')
			)
		);
	}

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'unit' => Input::get('unit')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'size' => Input::get('size')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'price' => Input::get('price')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'description' => Input::get('description')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_person' => Input::get('contact_person')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_email' => Input::get('contact_email')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_mobile' => Input::get('contact_mobile')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'bedrooms' => Input::get('bedrooms')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'bathrooms' => Input::get('bathrooms')
			)
		);


		if(Input::get('propertType')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'propertType' => Input::get('propertType')
			)
		);
	}

		return Redirect::to('residential-admin')->with('view-success',' Residential property successfully updated');

	}

	public function serveTermsConditions()
	{
		return View::make('terms-and-conditions');
	}

	public function deleteTimeshare($id)
	{
		DB::table('timeshares')
            ->where('id','=',$id)
            ->delete();

        return Redirect::to('admin')->with('view-success', ' SUCCESS: Timeshare Deleted');
	}

	public function deleteTimeshareAgent($id)
	{
		DB::table('users')
            ->where('id','=',$id)
            ->delete();

        return Redirect::to('timeshare-agents')->with('view-success', ' SUCCESS: Agent Deleted');
	}

	public function deleteResidential($id)
	{
		DB::table('residentials')
            ->where('id','=',$id)
            ->delete();

        return Redirect::to('residential-admin')->with('view-success', ' SUCCESS: Residential listing Deleted');
	}

	public function deleteCommercial($id)
	{
		DB::table('commercials')
            ->where('id','=',$id)
            ->delete();

        return Redirect::to('commercial-admin')->with('view-success', ' SUCCESS: Commercial listing Deleted');
	}

	public function handleContacts()
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
				'message' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $contact = new Contact;
		$contact->name = Input::get('name');
		$contact->surname = Input::get('surname');
		$contact->cell = Input::get('cell');
		$contact->telephone = Input::get('telephone');
        $contact->email = Input::get('email');
        $contact->message = Input::get('message');
		$contact->save();

        $data = ['contact' => $contact];

        Mail::send('emails.contact', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Message from the Uni-vate Properties Contact Page');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success', 'Your message is submitted');
	}

	public function handleContactsResortPage($id)
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'email' => 'required',
				'message' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		$resort = DB::table('resorts')
			->where('id','=',$id)
			->first();

        $contact = new ContactResort;
		$contact->name = Input::get('name');
		$contact->surname = Input::get('surname');
		$contact->cell = Input::get('cell');
        $contact->email = Input::get('email');
        $contact->message = Input::get('message');
		$contact->save();

        $data = ['contact' => $contact, 'resort' => $resort];

        Mail::send('emails.contactResort', $data, function($message) use ($resort)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Message from the '.$resort->resort.' page.');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success', 'Your message is submitted');
	}

	public function handleContactCommercial($id)
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'email' => 'required',
				'message' => 'required',
				'property' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}


        $contact = new Contact;
		$contact->name = Input::get('name');
		$contact->cell = Input::get('cell');
		$contact->email = Input::get('email');
		$contact->property = Input::get('property');
        $contact->message = Input::get('message');
		$contact->save();

        $data = ['contact' => $contact];

        Mail::send('emails.contactCommercial', $data, function($message) use ($contact)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Message from the commercial properties page.');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success', 'Your message is submitted');
	}


	public function serveSearch()
	{
		$validator = Validator::make(Input::all(),
            [
                'search' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'No search entered, please try again')->withInput()->withErrors($validator);
        }

        $query = Input::get('search');

        $timeshares = DB::table('timeshares')
            ->where('resort', 'LIKE', '%' . $query . '%')//resort name
            ->get();

        if($timeshares->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by resort name.');
        }

        else
        {
            // multiple resorts search results
            return View::make('search-results') 
                ->with('timeshares', $timeshares);
		}

	}

	public function serveCommercialSearch()
	{
		$validator = Validator::make(Input::all(),
            [
                'search' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'No search entered, please try again')->withInput()->withErrors($validator);
        }

        $query = Input::get('search');

        $commercials = DB::table('commercials')
			->where('name', 'LIKE', '%' . $query . '%')// property name
			->where('published','=',1)
			->paginate(10);


        if($commercials->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by property name.');
        }

        else
        {
            // multiple resorts search results
            return View::make('commercial-search-results')
                ->with('commercials', $commercials);

		}

	}

	public function serveResidentialSearch()
	{
		$validator = Validator::make(Input::all(),
            [
                'search' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'No search entered, please try again')->withInput()->withErrors($validator);
        }

        $query = Input::get('search');

        $residentials = DB::table('residentials')
			->where('name', 'LIKE', '%' . $query . '%')// property name
			->where('published','=',1)
            ->paginate(10);

        if($residentials->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by property name.');
        }

        else
        {
            // multiple resorts search results
			return View::make('residential-search-result')
                ->with('residentials', $residentials);

		}

	}

	public function serveRegister()
	{
		return View::make('register');
	}

	public function handleRegister()
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'surname' => 'required',
				'username' => 'required',
				'email' => 'required|email',
				'password' => 'required',
				'password1' => 'required'
			]);

			$users = DB::table('users')
			->get();

			foreach($users as $user){
				if($user->username == Input::get('username'))
				return Redirect::back()->with('view-error', ' This username already exists, please try a different username.')->withInput()->withErrors($validator);
			}

			foreach($users as $user){
				if($user->email == Input::get('email'))
				return Redirect::back()->with('view-error', ' This email account already exists, please login.')->withInput()->withErrors($validator);
			}
        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		if((Input::get('password'))!=(Input::get('password1')))
        {
            return Redirect::back()->with('view-error', ' Passwords do not match')->withInput()->withErrors($validator);
        }

        $user = new User;
        $user->name = Input::get('name');
		$user->email = Input::get('email');
		$user->phone = Input::get('phone');
		$user->mobile = Input::get('mobile');
		$user->surname = Input::get('surname');
		$user->username = Input::get('username');
		$user->password = Hash::make(Input::get('password'));
		$user->role = 'user';
        $user->save();

        $data = ['user' => $user];

        Mail::send('emails.register', $data, function($message) use ($user)
        {
            $message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New registration on www.univateproperties.co.za');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success','You have successfully registered, your confirmation email will be in your inbox shortly.');
	}

	public function confirmationButton($email)
	{
		$user = DB::table('users')
		->where('email','=',$email)
		->first();

		DB::table('users')
                    ->where('email','=', $email)
                    ->update(array(
                            'verified' => 'yes'
                        )
					);

		return Redirect::to('login')->withInput()->with('view-success', 'Your email has been successfully verified. Please proceed to log in.');
	}

	public function LittleEden()
	{
		//$options = array('trace' => 1, 'exceptions' => 1);

		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/LE";

		$details = json_decode(file_get_contents($wsdl), true);

		//dd($details['prName']);

		$timeshares = DB::table('timeshares')
		->where('resort','=','little eden')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','little eden')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/LE/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		$awards = explode(',',$resort->awards);

		return View::make('resorts.little-eden')
		->with('awards',$awards)
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function KaggaKamma()
	{
		//$options = array('trace' => 1, 'exceptions' => 1);

		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/KK";

		$details = json_decode(file_get_contents($wsdl), true);

		//dd($details['prName']);

		$timeshares = DB::table('timeshares')
		->where('resort','=','kagga kamma')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','kagga kamma')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/KK/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		$awards = explode(',',$resort->awards);

		return View::make('resorts.kagga-kamma')
		->with('awards',$awards)
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function Mabalingwe()
	{
		return Redirect::to('/resort/mabalingwe');
	}

	public function Kridzil()
	{
		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/KRIDZ";

		$details = json_decode(file_get_contents($wsdl), true);

		$timeshares = DB::table('timeshares')
		->where('resort','=','KRIDZIL')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','KRIDZIL')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/KRIDZ/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		return View::make('resorts.kritzel')
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function SandyPlace()
	{
		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/SANDY";

		$details = json_decode(file_get_contents($wsdl), true);

		$timeshares = DB::table('timeshares')
		->where('resort','=','sandy place')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','sandy place')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/SANDY/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		$awards = explode(',',$resort->awards);

		return View::make('resorts.sandy-place')
		->with('awards',$awards)
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function Uvongo()
	{
		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/URR";

		$details = json_decode(file_get_contents($wsdl), true);

		$timeshares = DB::table('timeshares')
		->where('resort','=','UVONGO RIVER RESORT')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','UVONGO RIVER RESORT')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/URR/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		$awards = explode(',',$resort->awards);

		return View::make('resorts.uvongo')
		->with('awards',$awards)
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function Ngwenya()
	{
		$wsdl = "https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/TRESORT/NL";

		$details = json_decode(file_get_contents($wsdl), true);

		$timeshares = DB::table('timeshares')
		->where('resort','=','NGWENYA LODGE')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','NGWENYA LODGE')
		->first();



		$layout = 'https://www.tradeunipoint.com/unibackend/seam/resource/rest/products/NL/layout';

		$details2 = base64_decode(file_get_contents($layout), true);

		$awards = explode(',',$resort->awards);

		return View::make('resorts.ngwenya')
		->with('awards',$awards)
		->with('resort',$resort)
		->with('timeshares',$timeshares)
		->with('details',$details);
	}

	public function Margate()
	{
		$timeshares = DB::table('timeshares')
		->where('resort','=','MARGATE BEACH CLUB')
		->where('published','=',1)
		->paginate(5);

		return View::make('resorts.margate-beach-club')
		->with('timeshares',$timeshares);
	}

	public function Sudwala()
	{
		return Redirect::to('/resort/sudwala-lodge');
	}

	public function Verlorenkloof()
	{
		$timeshares = DB::table('timeshares')
		->where('resort','=','Verlorenkloof')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','Verlorenkloof')
		->first();

		return View::make('resorts.verlorenkloof')
		->with('resort',$resort)
		->with('timeshares',$timeshares);
	}



	public function jackalberryRidge()
	{
		$timeshares = DB::table('timeshares')
		->where('resort','=','JACKALBERRY RIDGE')
		->where('published','=',1)
		->paginate(5);

		$resort = DB::table('resorts')
		->where('resort','=','JACKALBERRY RIDGE')
		->first();

		return View::make('resorts.jackalberry-ridge')
		->with('resort',$resort)
		->with('timeshares',$timeshares);
	}

	public function serveCommercialSales()
	{
		return View::make('commercial-sales');
	}

	public function serveCommercialRentals()
	{
		$rentals = DB::table('commercial_rentals')
			->where('published','=',1)
			->get();

		return View::make('commercial-rentals')
			->with('rentals',$rentals);
	}

	public function serveResidentialSales()
	{
		$rentals = DB::table('residential_sales')
		->where('published','=',1)
			->get();

		return View::make('residential-sales')
		->with('rentals',$rentals);
	}

	public function serveResidentialRentals()
	{
		$rentals = DB::table('residential_rentals')
		->where('published','=',1)
			->get();

		return View::make('residential-rentals')
		->with('rentals',$rentals);
	}

	public function serveCommercialRental($name)
	{
		$rental = DB::table('commercial_rentals')
			->where('name','=',$name)
			->first();

		return View::make('commercial-rental')
			->with('rental',$rental);
	}

	public function serveResidentialRental($name)
	{
		$rental = DB::table('residential_rentals')
			->where('name','=',$name)
			->first();

		return View::make('residential-rental')
			->with('rental',$rental);
	}

	public function serveCommercial()
	{
		return View::make('commercial');
	}

	public function serveResidential()
	{
		return View::make('residential');
	}

	public function handleCommercial()
	{
		$for = Input::get('for');
		$region = Input::get('region');
		$town = Input::get('town');
		$surburb = Input::get('surburb');
		$propertType = Input::get('propertType');

		$validator = Validator::make(Input::all(),
            [
				'for' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'Please select For Sale or For Rent')->withInput()->withErrors($validator);
		}
		/*
		$commercials = DB::table('commercials')
                ->where(function($query) use ($for, $region, $town, $surburb, $propertType) {

                if ($for)
                    $query->where('for','=', $for);
                if ($region)
                    $query->where('region','=', $region);
                if ($town)
					$query->where('town','=', $town);
                if ($surburb)
					$query->where('surburb','=', $surburb);
                if ($propertType)
					$query->where('propertType','=', $propertType); })

				->where('published','=',1)

				->get(); */

				$commercials = DB::table('properties')
                ->where(function($query) use ($for, $region, $town, $surburb, $propertType) {

                if ($for)
                    $query->where('for','=', $for);
                if ($region)
                    $query->where('region','=', $region);
                if ($town)
					$query->where('town','=', $town);
                if ($surburb)
					$query->where('surburb','=', $surburb);
                if ($propertType)
					$query->where('propertType','=', $propertType); })

				->where('published','=',1)

				->get();


        if($commercials->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found.');
		}

        else
        {
			return View::make('commercial-results')
				->with('for',$for)
				->with('commercials',$commercials);
		}

	}

	public function serveTimeshareResults()
	{
		return View::make('timeshare-results');
	}

	public function handleResidential()
	{
		$validator = Validator::make(Input::all(),
            [
				'for' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'Please select For Sale or For Rent')->withInput()->withErrors($validator);
		}

		$for = Input::get('for');
		$region = Input::get('region');
		$town = Input::get('town');
		$surburb = Input::get('surburb');
		$propertType = Input::get('propertType');

		$residentials = DB::table('residentials')
                ->where(function($query) use ($for, $region, $town, $surburb, $propertType) {

                if ($for)
                    $query->where('for','=', $for);
                if ($region)
                    $query->where('region','=', $region);
                if ($town)
					$query->where('town','=', $town);
                if ($surburb)
					$query->where('surburb','=', $surburb);
                if ($propertType)
					$query->where('propertType','=', $propertType); })

					->where('published','=',1)

				->get();

        if($residentials->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found.');
		}

        else
        {
			return View::make('residential-results')
				->with('for',$for)
				->with('residentials',$residentials);
		}

	}

	public function serveCommercialResults()
	{
		return View::make('commercial-results');
	}

	public function serveCommercialProperty($id)
	{
		$property = DB::table('commercials')
		->where('id','=',$id)
		->first();

		return View::make('commercial-property')
			->with('property',$property);
	}

	public function serveResidentialProperty($id)
	{
		$property = DB::table('residentials')
		->where('id','=',$id)
		->first();

		$facilities = explode(',',$property->facilities);

		return View::make('residential-property')
			->with('facilities',$facilities)
			->with('property',$property);
	}

	public function serveListCommercialRental()
	{
		return View::make('list-commercial-rental');
	}

	public function handleListCommercialRental()
	{
		$validator = Validator::make(Input::all(),
            [
				'region' => 'required',
				'address' => 'required',
				'image1' => 'required',
				'image2' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' Some information is incomplete in your submission please review below')->withInput()->withErrors($validator);
		}

        $commercial = new Commercial;
        $commercial->name = Input::get('name');
		$commercial->unit = Input::get('unit');
		$commercial->address = Input::get('address');
		$commercial->size = Input::get('size');
		$commercial->region = Input::get('region');
		$commercial->town = Input::get('town');
		$commercial->opCost = Input::get('opCost');
		$commercial->for = 'rental';
		$commercial->description = Input::get('description');
		$commercial->contact_person = Input::get('contact_person');
		$commercial->contact_email = Input::get('contact_email');
		$commercial->contact_mobile = Input::get('contact_mobile');
		$commercial->surburb = Input::get('surburb');
		$commercial->propertType = Input::get('propertType');
		if (Input::hasFile('image1')) {
			$file = Input::file('image1');
			$file->move('img/', $file->getClientOriginalName());
			$commercial->image2 = 'img/' . $file->getClientOriginalName();
		}
		if (Input::hasFile('image2')) {
			$file = Input::file('image2');
			$file->move('img/', $file->getClientOriginalName());
			$commercial->image2 = 'img/' . $file->getClientOriginalName();
		}
        $commercial->save();

        $data = ['commercial' => $commercial];

        Mail::send('emails.commercial-rental-listing', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New Commercial Property Listing');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success',' You have successfully submitted your property listing, an agent will contact you soon.');
	}

	public function serveListResidentialRental()
	{
		return View::make('list-residential-rental');
	}

	public function handleListResidentialRental()
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'region' => 'required',
				'price' => 'required',
				'image1' => 'required',
				'image2' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' Some information is incomplete in your submission please review below')->withInput()->withErrors($validator);
		}

        $residential = new Residential;
        $residential->name = Input::get('name');
		$residential->ref = Input::get('ref');
		$residential->size = Input::get('size');
		$residential->region = Input::get('region');
		$residential->town = Input::get('town');
		$residential->bedrooms = Input::get('bedrooms');
		$residential->bathrooms = Input::get('bathrooms');
		$residential->contact_person = Input::get('contact_person');
		$residential->contact_email = Input::get('contact_email');
		$residential->contact_mobile = Input::get('contact_mobile');
		$residential->for = 'rental';
		$residential->description = Input::get('description');
		$residential->surburb = Input::get('surburb');
		$residential->propertType = Input::get('propertType');
		if (Input::hasFile('image1')) {
			$file = Input::file('image1');
			$file->move('img/', $file->getClientOriginalName());
			$residential->image1 = 'img/' . $file->getClientOriginalName();
		}
		if (Input::hasFile('image2')) {
			$file = Input::file('image2');
			$file->move('img/', $file->getClientOriginalName());
			$residential->image2 = 'img/' . $file->getClientOriginalName();
		}
        $residential->save();

        $data = ['residential' => $residential];

        Mail::send('emails.residential-rental-listing', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New Residential Property Listing');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success',' You have successfully submitted your property listing.');
	}

	public function serveListResidentialSale()
	{
		return View::make('list-residential-sale');
	}

	public function handleListResidentialSale()
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'region' => 'required',
				'price' => 'required',
				'image1' => 'required',
				'image2' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

        $residential = new Residential;
        $residential->name = Input::get('name');
		$residential->ref = Input::get('ref');
		$residential->size = Input::get('size');
		$residential->region = Input::get('region');
		$residential->town = Input::get('town');
		$residential->bedrooms = Input::get('bedrooms');
		$residential->bathrooms = Input::get('bathrooms');
		$residential->contact_person = Input::get('contact_person');
		$residential->contact_email = Input::get('contact_email');
		$residential->contact_mobile = Input::get('contact_mobile');
		$residential->for = 'Sale';
		$residential->description = Input::get('description');
		$residential->surburb = Input::get('surburb');
		$residential->propertType = Input::get('propertType');
		if (Input::hasFile('image1')) {
			$file = Input::file('image1');
			$file->move('img/', $file->getClientOriginalName());
			$residential->image1 = 'img/' . $file->getClientOriginalName();
		}
		if (Input::hasFile('image2')) {
			$file = Input::file('image2');
			$file->move('img/', $file->getClientOriginalName());
			$residential->image2 = 'img/' . $file->getClientOriginalName();
		}
        $residential->save();

        $data = ['residential' => $residential];

        Mail::send('emails.residential-sale-listing', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New Residential Property for sale Listing');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success',' You have successfully submitted your property listing.');
	}

	public function serveListCommercialSale()
	{
		return View::make('list-commercial-sale');
	}

	public function handleListCommercialSale()
	{
		$validator = Validator::make(Input::all(),
            [
				'name' => 'required',
				'region' => 'required',
				'price' => 'required',
				'image1' => 'required',
				'image2' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

        $commercial = new Commercial;
        $commercial->name = Input::get('name');
		$commercial->ref = Input::get('ref');
		$commercial->size = Input::get('size');
		$commercial->region = Input::get('region');
		$commercial->town = Input::get('town');
		$commercial->contact_person = Input::get('contact_person');
		$commercial->contact_email = Input::get('contact_email');
		$commercial->contact_mobile = Input::get('contact_mobile');
		$commercial->opCost = Input::get('opCost');
		$commercial->for = 'Sale';
		$commercial->description = Input::get('description');
		$commercial->surburb = Input::get('surburb');
		$commercial->propertType = Input::get('propertType');
		if (Input::hasFile('image1')) {
			$file = Input::file('image1');
			$file->move('img/', $file->getClientOriginalName());
			$commercial->image1 = 'img/' . $file->getClientOriginalName();
		}
		if (Input::hasFile('image2')) {
			$file = Input::file('image2');
			$file->move('img/', $file->getClientOriginalName());
			$commercial->image2 = 'img/' . $file->getClientOriginalName();
		}
        $commercial->save();

        $data = ['commercial' => $commercial];

        Mail::send('emails.commercial-sale-listing', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Info')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New Commercial Property for sale Listing');
            $message->from('info@univateproperties.co.za');
		});

		return Redirect::back()->with('view-success',' You have successfully submitted your property listing.');
	}

	public function backButtonCommercial($for)
	{
		$commercials = DB::table('commercials')
		->where('for','=',$for)
		->get();

		return View::make('commercial-results')
			->with('commercials',$commercials)
			->with('for',$for);

	}

	public function backButtonResidential($for)
	{
		$residentials = DB::table('residentials')
		->where('for','=',$for)
		->get();

		return View::make('residential-results')
			->with('residentials',$residentials)
			->with('for',$for);

	}

	public function serveCSI()
	{
		return View::make('csi');
	}

	public function back()
	{
		return redirect()->back();
	}

	public function officeParks()
	{
		$mooikloof = DB::table('commercials')
			->where('surburb','=','Mooikloof')
			->get();

			$query = 'Lombardy Business Park';

		$lombardy = DB::table('commercials')
			->where('name', 'LIKE', '%' . $query . '%')
			->get();

		return View::make('office-parks')
			->with('mooikloof',$mooikloof)
			->with('lombardy',$lombardy);
	}

	public function Lombardy()
	{
		$lombardy = DB::table('commercials')
			->where('name','=','Lombardy Business Park')
			->paginate(6);

		$property = DB::table('commercials')
			->where('name','=','Lombardy Business Park')
			->first();

		$facilities = explode(',',$property->facilities);

		return View::make('lombardy')
			->with('property',$property)
			->with('facilities',$facilities)
			->with('lombardy',$lombardy);
	}

	public function handleInterestedLombardy($id)
	{
		$unit = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedLombardy', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this unit at Lombardy Business Park');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function Mooikloof()
	{
		$mooikloof = DB::table('commercials')
			->where('name','=','Mooikloof Office Park')
			->paginate(6);

		$property = DB::table('commercials')
			->where('name','=','Mooikloof Office Park')
			->first();

		$facilities = explode(',',$property->facilities);

		return View::make('mooikloof')
			->with('property',$property)
			->with('facilities',$facilities)
			->with('mooikloof',$mooikloof);
	}

	public function handleInterestedMooikloof($id)
	{
		$unit = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedMooikloof', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this unit at Lombardy Business Park');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function handleInterestProperty($id)
	{
		$unit = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedProperty', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this unit at Lombardy Business Park');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function handleInterestProperty2($id)
	{
		$unit = DB::table('residentials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->phone = Input::get('phone');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedProperty', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this unit at Lombardy Business Park');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function serveTimeshareEnquiry($id)
	{
		$timeshare = DB::table('timeshares')
			->where('id','=',$id)
			->first();

		$resort = DB::table('resorts')
			->where('resort','=',$timeshare->resort)
			->first();

			return View::make('timeshare-enquiry')
				->with('resort',$resort)
				->with('timeshare',$timeshare);
	}

	public function handleTimeshareEnquiry($id)
	{
		$timeshare = DB::table('timeshares')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->mobile = Input::get('mobile');
        $interested->save();

        $data = ['interested' => $interested, 'timeshare' => $timeshare];

        Mail::send('emails.interestedTimeshare', $data, function($message)
        {
            $message->to('koketso.maphopha@gmail.com','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in this timeshare');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function serveShareTransferInitiation()
	{
		return View::make('share-transfer-initiation-for-seller');
	}

	public function handleShareTransferIntiation()
	{
		$validator = Validator::make(Input::all(),
            [
                'paid' => 'required',
				'spaceBanked' => 'required',
				'date' => 'required',
				'purchasePrice' => 'required',
				'sellingPrice' => 'required',
				'estateAgency' => 'required',
				'commission' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $seller = new Seller;
		$seller->paid = Input::get('paid');
		$seller->rental = Input::get('rental');
        $seller->spaceBanked = Input::get('spaceBanked');
		$seller->date = Input::get('date');
		$seller->purchasePrice = Input::get('purchasePrice');
		$seller->sellingPrice = Input::get('sellingPrice');
		$seller->estateAgency = Input::get('estateAgency');
		$seller->commission = Input::get('commission');
        $seller->save();

        $data = ['seller' => $seller];

        Mail::send('emails.seller', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Share Transfer Intiation for Seller');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Your information has been successfully been submitted.');
	}

	public function serveShareTransferInitiationForPurchaser($id)
	{
		$timeshare = DB::table('timeshares')
			->where('id','=',$id)
			->first();

            $name = Auth::user()->name;
            $surname = Auth::user()->surname;
			$phone = Auth::user()->phone;
			$cell = Auth::user()->mobile;
			$email = Auth::user()->email;

        return View::make('share-transfer-initiation-for-purchaser')
            ->with('surname',$surname)
			->with('email',$email)
			->with('phone',$phone)
			->with('cell',$cell)
			->with('name',$name)
			->with('timeshare',$timeshare);
	}

	public function handleShareTransferInitiationForPurchaser($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
				'maritalStatus' => 'required',
				'physicalAddress' => 'required',
				'postalAddress' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		$timeshare = DB::table('timeshares')
			->where('id','=',$id)
			->first();

        $transfer = new Transfer;
        $transfer->name = Auth::user()->name;
        $transfer->IDNumber = Input::get('IDNumber');
		$transfer->PassportNumber = Input::get('PassportNumber');
		$transfer->maritalStatus = Input::get('maritalStatus');
		$transfer->marriedIn = Input::get('marriedIn');
		$transfer->otherMeans = Input::get('otherMeans');
		$transfer->tax = Input::get('tax');
		$transfer->annualIncome = Input::get('annualIncome');
		$transfer->physicalAddress = Input::get('physicalAddress');
		$transfer->postalAddress = Input::get('postalAddress');
		$transfer->telephone1 = Auth::user()->phone;
		$transfer->telephone2 = Input::get('telephone2');
		$transfer->phone1 = Auth::user()->mobile;
		$transfer->phone2 = Input::get('phone2');
		$transfer->fax1 = Input::get('fax1');
		$transfer->fax2 = Input::get('fax2');
		$transfer->email1 = Auth::user()->email;
		$transfer->email2 = Input::get('email2');
		$transfer->resort = Input::get('resort');
		$transfer->unit = Input::get('unit');
		$transfer->module = Input::get('module');
		$transfer->price = Input::get('price');
		$transfer->year = Input::get('year');
		$transfer->confirmInfo = Input::get('confirmInfo');
		$transfer->sign = Input::get('sign');

		$transfer->save();

		DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'status' => 'Offer Pending'
                        )
					);

        $data = ['transfer' => $transfer];

        Mail::send('emails.transfer', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Share Transfer Intiation for Purchaser');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Your information has been successfully been submitted.');
	}

	public function import()
    {
        config(['excel.import.startRow' => 1 ]);
        Excel::import(new TimesharesImport, Input::file('ex_file'));

        return Redirect::back()->with('view-success', 'Your import is successful!');
	}

	public function serveLombardyEnquiry($id)
	{
		$unit = DB::table('commercials')
			->where('id','=',$id)
			->first();

			return View::make('lombardy-enquiry')
				->with('unit',$unit);
	}


	public function handleLombardyEnquiry($id)
	{
		$unit = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->mobile = Input::get('mobile');
        $interested->save();

		$data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedLombardy', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in Lombardy Unit');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function serveMooikloofEnquiry($id)
	{
		$unit = DB::table('commercials')
			->where('id','=',$id)
			->first();

			return View::make('mooikloof-enquiry')
				->with('unit',$unit);
	}


	public function handleMooikloofEnquiry($id)
	{
		$unit = DB::table('commercials')
		->where('id','=',$id)
		->first();

		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $interested = new Interest;
        $interested->name = Input::get('name');
        $interested->email = Input::get('email');
        $interested->mobile = Input::get('mobile');
        $interested->save();

		$data = ['interested' => $interested, 'unit' => $unit];

        Mail::send('emails.interestedMooikloof', $data, function($message)
        {
            $message->to('info@univateproperties.co.za','Uni-vate')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('I am interested in Mooikloof Unit');
            $message->from('info@univateproperties.co.za');
        });

        return Redirect::back()->with('view-success','Enquiry submitted.');
	}

	public function makeOffer()
	{
		return View::make('share-transfer-initiation-for-purchaser');
	}

	public function serveSuccessfulPayment()
	{ 
        $bulk = DB::table('timeshare_bulk_uploads')
                    ->where('email','=',Auth::user()->email)
                    ->whereDate('created_at', \Carbon\Carbon::today())
                    ->orderBy('created_at', 'desc')
                    ->first(); 
        
        $user = DB::table('users')
        ->where('id','=',Auth::user()->id)
        ->first();

        if($bulk==NULL)
        {
            $timeshare = DB::table('timeshares')
                ->where('email','=',$user->email)
                ->whereDate('created_at', \Carbon\Carbon::today())
                ->orderBy('created_at', 'desc')
                ->first();

            $data = ['user' => $user, 'timeshare' => $timeshare];

            Mail::send('emails.paymentReference', $data, function($message)
            {
            $message->to('info@univateproperties.co.za','Uni-vate')->to('brucel@uni-vision.co.za','Bruce Lynwood')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Successful Payment');
            $message->from('info@univateproperties.co.za');
            });
        }
        else{
            $data = ['bulk' => $bulk, 'user' => $user];

            DB::table('timeshare_bulk_uploads')
                    ->where('id','=', $bulk->id)
                    ->update(array(
                            'listingFee' => 'Paid'
                        )
					);

            Mail::send('emails.paymentBulkReference', $data, function($message)
            {
            $message->to('info@univateproperties.co.za','Uni-vate')->to('brucel@uni-vision.co.za','Bruce Lynwood')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Successful Payment');
            $message->from('info@univateproperties.co.za');
            });
        }

        

		return View::make('successful-payment');
	}

	public function serveRegisterAgent()
	{
		return View::make('register-agent');
	}

	public function handleAgentRegister()
	{

	}

	public function serveMyTimeshares()
	{
		$timeshares = DB::table('timeshares')
			->where('names','=',Auth::user()->name)
			->paginate(10);

			return View::make('my-timeshares')
				->with('timeshares',$timeshares);
	}

	public function serveMyResidentialProperties()
	{
		$residentials = DB::table('residentials')
			->where('contact_person','=',Auth::user()->name)
			->paginate(10);

			return View::make('my-residential-properties')
				->with('residentials',$residentials);
	}

	public function serveMyCommercialProperties()
	{
		$commercials = DB::table('commercials')
			->where('contact_person','=',Auth::user()->name)
			->paginate(10);

			return View::make('my-commercial-properties')
				->with('commercials',$commercials);
	}

	public function serveRegisterTimeshareAgent()
	{
		$agencies = DB::table('agencies')
			->get();

		return View::make('register-timeshare-agent')
			->with('agencies',$agencies);
	}

	public function handleRegisterTimeshareAgent()
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
                'surname' => 'required',
				'email' => 'required',
				'username' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		if((Input::get('password'))!=(Input::get('password1')))
        {
            return Redirect::back()->with('view-error', ' Passwords do not match')->withInput()->withErrors($validator);
        }

			$user = new User;
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->mobile = Input::get('mobile');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->agency = Auth::user()->agency;
			$user->role = 'user';
			$user->timeshare = '1';

			$user->role = 'user';
			$user->save();

			$data = ['user' => $user];

			Mail::send('emails.register', $data, function($message) use ($user)
			{
				$message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New registration on www.univateproperties.co.za');
				$message->from('info@univateproperties.co.za');
			});

		return Redirect::to('timeshare-agents')->with('view-success','You have successfully registered an agent.');
	}

	public function serveTimeshareAgents()
	{
		$myAgency = Auth::user()->agency;
		$agents = DB::table('users')
		->where('agency','=',$myAgency)
		->paginate(10);

			return View::make('timeshare-agents')
			->with('agents',$agents);
	}

	public function serveRegisterCommercialAgent()
	{
		return View::make('register-commercial-agent');
	}

	public function handleRegisterCommercialAgent()
	{
		$validator = Validator::make(Input::all(),
            [
				'EAAB-FFC-Number' => 'required',
				'agency' => 'required',
				'registrationNum' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		if((Input::get('password'))!=(Input::get('password1')))
        {
            return Redirect::back()->with('view-error', ' Passwords do not match')->withInput()->withErrors($validator);
        }

		if(!Auth::check())
		{
			$user = new User;
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->mobile = Input::get('mobile');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->EAAB_FFC_Number = Input::get('EAAB-FFC-Number');
			$user->agency = Input::get('agency');
			$user->registrationNum = Input::get('registrationNum');
			$user->commercial = '1';

			$user->role = 'user';
			$user->save();

			$data = ['user' => $user];

			Mail::send('emails.register', $data, function($message) use ($user)
			{
				$message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New registration on www.univateproperties.co.za');
				$message->from('info@univateproperties.co.za');
			});
			}
		else{
			$users = DB::table('users')
			->get();
			/*
			foreach($users as $user){
				if($user->username == Input::get('username'))
				return Redirect::back()->with('view-error', ' This username already exists, please try a different username.')->withInput()->withErrors($validator);
			}

			foreach($users as $user){
				if($user->email == Input::get('email'))
				return Redirect::back()->with('view-error', ' This email account already exists, please login.')->withInput()->withErrors($validator);
			} */

			$user = DB::table('users')
				->where('id','=',Auth::user()->id)
				->first();

				DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'EAAB_FFC_Number' => Input::get('EAAB-FFC-Number')
                        )
					);

					DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'agency' => Input::get('agency')
                        )
					);

					DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'registrationNum' => Input::get('registrationNum')
                        )
					);

		}

		return Redirect::back()->with('view-success','You have successfully registered.');
	}

	public function serveCommercialAgents()
	{
		$agents = DB::table('users')
		->where('commercial','=','1')
		->paginate(10);

		if (Auth::check() && Auth::user()->role == "admin") {
			return View::make('commercial-agents')
			->with('agents',$agents);
		  }else{
			return Redirect::to('/');
		}
	}

	public function serveRegisterResidentialAgent()
	{/*
		$user = new User;
        $user->name = 'Arlene';
		$user->email = 'admin1@univateproperties.co.za';
		$user->phone ='+27 (0) 12 492 1238';
		$user->mobile = '+27 (0) 12 492 1238';
		$user->surname = '';
		$user->username = 'Admin1';
		$user->password = Hash::make('Admin1');
		$user->role = 'admin';
		$user->save();

		$user1 = new User;
        $user1->name = 'Caitlinf';
		$user1->email = 'admin2@univateproperties.co.za';
		$user1->phone = '+27 (0) 12 492 1238';
		$user1->mobile = '+27 (0) 12 492 1238';
		$user1->surname = '';
		$user1->username = 'Admin2';
		$user1->password = Hash::make('Admin2');
		$user1->role = 'admin';
		$user1->save(); */

		return View::make('register-residential-agent');
	}

	public function handleRegisterResidentialAgent()
	{
		$validator = Validator::make(Input::all(),
            [
				'EAAB-FFC-Number' => 'required',
				'agency' => 'required',
				'registrationNum' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		if((Input::get('password'))!=(Input::get('password1')))
        {
            return Redirect::back()->with('view-error', ' Passwords do not match')->withInput()->withErrors($validator);
        }

		if(!Auth::check())
		{
			$user = new User;
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->mobile = Input::get('mobile');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->EAAB_FFC_Number = Input::get('EAAB-FFC-Number');
			$user->agency = Input::get('agency');
			$user->registrationNum = Input::get('registrationNum');
			$user->residential = '1';

			$user->role = 'user';
			$user->save();

			$data = ['user' => $user];

			Mail::send('emails.register', $data, function($message) use ($user)
			{
				$message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New registration on www.univateproperties.co.za');
				$message->from('info@univateproperties.co.za');
			});
			}
		else{
			$users = DB::table('users')
			->get();
			/*
			foreach($users as $user){
				if($user->username == Input::get('username'))
				return Redirect::back()->with('view-error', ' This username already exists, please try a different username.')->withInput()->withErrors($validator);
			}

			foreach($users as $user){
				if($user->email == Input::get('email'))
				return Redirect::back()->with('view-error', ' This email account already exists, please login.')->withInput()->withErrors($validator);
			} */

			$user = DB::table('users')
				->where('id','=',Auth::user()->id)
				->first();

				DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'EAAB_FFC_Number' => Input::get('EAAB-FFC-Number')
                        )
					);

					DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'agency' => Input::get('agency')
                        )
					);

					DB::table('users')
                    ->where('id','=', Auth::user()->id)
                    ->update(array(
                            'registrationNum' => Input::get('registrationNum')
                        )
					);

		}

		return Redirect::back()->with('view-success','You have successfully registered.');
	}

	public function serveResidentialAgents()
	{
		$agents = DB::table('users')
		->where('residential','=','1')
		->paginate(10);

		if (Auth::check() && Auth::user()->role == "admin") {
			return View::make('residential-agents')
			->with('agents',$agents);
		  }else{
			return Redirect::to('/');
		}
	}

	public function serveRegisterAgency()
	{
		return View::make('register-agency');
	}

	public function handleRegisterAgency()
	{
		$validator = Validator::make(Input::all(),
            [
				'EAAB-FFC-Number' => 'required',
				'agency' => 'required',
				'registrationNum' => 'required',
				'name' => 'required',
				'surname' => 'required',
				'email' => 'required',
				'phone' => 'required',
				'mobile' => 'required',
				'username' => 'required'
			]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		if((Input::get('password'))!=(Input::get('password1')))
        {
            return Redirect::back()->with('view-error', ' Passwords do not match')->withInput()->withErrors($validator);
        }

			$user = new User;
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			$user->phone = Input::get('phone');
			$user->mobile = Input::get('mobile');
			$user->surname = Input::get('surname');
			$user->username = Input::get('username');
			$user->password = Hash::make(Input::get('password'));
			$user->agencyAdmin = 'YES';
			$user->agency = Input::get('agency');
			$user->role = 'agency admin';
			$user->save();

			$agency = new Agency;
			$agency->EAAB_FFC_Number = Input::get('EAAB-FFC-Number');
			$agency->agency = Input::get('agency');
			$agency->registrationNum = Input::get('registrationNum');
			$agency->save();

			$data = ['agency' => $agency, 'user' => $user];

			Mail::send('emails.register-agency', $data, function($message) use ($user)
			{
				$message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('New agency registration');
				$message->from('info@univateproperties.co.za');
			});

		return Redirect::to('/')->with('view-success','You have successfully registered your agency. Proceed to login and add agents under your agency');
	}

	public function serveAllAgents()
	{
		$agents = DB::table('users')
			->where('agency','!=',NULL)
			->paginate(10);

			if (Auth::check() && Auth::user()->role == "admin") {
				return View::make('admin.all-agents')
				->with('agents',$agents);
			  }else{
				return Redirect::to('/');
			}
	}

	public function serveAllAgencies()
	{
		$agencies = DB::table('agencies')
			->paginate(10);

			if (Auth::check() && Auth::user()->role == "admin") {
				return View::make('admin.all-agencies')
				->with('agencies',$agencies);
			  }else{
				return Redirect::to('/');
			}
	}

	public function serveAllCommercialProperties()
	{
		$commercials = DB::table('commercials')
			->paginate(10);

			if (Auth::check() && Auth::user()->role == "admin") {
				return View::make('admin.all-commercial-properties')
				->with('commercials',$commercials);
			  }else{
				return Redirect::to('/');
			}
	}

	public function serveAllResidentialProperties()
	{
		$residentials = DB::table('residentials')
			->paginate(10);

			if (Auth::check() && Auth::user()->role == "admin") {
				return View::make('admin.all-residential-properties')
				->with('residentials',$residentials);
			  }else{
				return Redirect::to('/');
			}
	}

	public function editAgent($id)
	{
		$user = DB::table('users')
			->where('id','=',$id)
			->first();

			return View::make('admin.edit-agent')
				->with('user',$user);
	}

	public function publishAgent($id)
	{
		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'agent_publish' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'Agent is successfully verified.');
	}

	public function deleteAgent($id)
	{
		DB::table('users')
            ->where('id','=',$id)
            ->delete();

        return Redirect::back()->with('view-success', ' SUCCESS: Agent Deleted');
	}

	public function deleteAgency($id)
	{
		DB::table('agencies')
            ->where('id','=',$id)
            ->delete();

        return Redirect::back()->with('view-success', ' SUCCESS: Agency Deleted');
	}

	public function handleEditAgent($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
				'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'surname' => Input::get('surname')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'email' => Input::get('email')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'phone' => Input::get('tel')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'mobile' => Input::get('cell')
			)
		);


		return Redirect::to('all-agents')->with('view-success',"You have successfully updated agent's details");

	}

	public function serveEditAgency($id)
	{
		$agency = DB::table('agencies')
			->where('id','=',$id)
			->first();

			$user = DB::table('users')
			->where('agency','=',$agency->agency)
			->first();

			return View::make('admin.edit-agency')
				->with('user',$user)
				->with('agency',$agency);
	}

	public function handleEditAgency($id)
	{
		$agency = DB::table('agencies')
			->where('id','=',$id)
			->first();

			$user = DB::table('users')
			->where('agency','=',$agency->agency)
			->first();

			$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
				'agency' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'surname' => Input::get('surname')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'email' => Input::get('email')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'phone' => Input::get('phone')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'mobile' => Input::get('mobile')
			)
		);

		DB::table('agencies')
		->where('id','=', $agency->id)
		->update(array(
				'EAAB_FFC_Number' => Input::get('EAAB-FFC-Number')
			)
		);

		DB::table('agencies')
		->where('id','=', $agency->id)
		->update(array(
				'registrationNum' => Input::get('registrationNum')
			)
		);

		DB::table('agencies')
		->where('id','=', $agency->id)
		->update(array(
				'agency' => Input::get('agency')
			)
		);

		return Redirect::to('all-agencies')->with('view-success',"You have successfully updated your agency details");
	}

	public function contract()
	{
		return View::make('contract');
	}

	public function serveEditMyTimeshare($id)
	{
		$timeshare = DB::table('timeshares')
			->where('id','=',$id)
			->first();

			return View::make('edit-my-timeshare')
				->with('timeshare',$timeshare);
	}

	public function handleEditMyTimeshare($id)
	{
        $timeshare = DB::table('timeshares')
			->where('id','=',$id)
            ->first();

		$validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'module' => 'required',
				'week' => 'required',
				'bedrooms' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}
/*
		DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'resort' => Input::get('resort')
                        )
					);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'module' => Input::get('module')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'week' => Input::get('week')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'season' => Input::get('season')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'region' => Input::get('region')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'setPrice' => Input::get('setPrice')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'bedrooms' => Input::get('bedrooms')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'sleeps' => Input::get('sleeps')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'unit' => Input::get('unit')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'owner' => Input::get('owner')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'spacebankedyear' => Input::get('spacebankedyear')
			)
		);

		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'spacebankOwner' => Input::get('spacebankOwner')
			)
		);

	if(Input::get('publish')!='NULL') {
		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'published' => Input::get('publish')
			)
		);
	}


	if(Input::has('statusDate')) {
		DB::table('timeshares')
		->where('id','=', $id)
		->update(array(
				'statusDate' => Input::get('statusDate')
			)
		);
    } */

    if(Input::get('price')!=$timeshare->price)
    {
        DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'price' => Input::get('price')
                )
            );

        $log = new TimeshareLog;
                $log->user_id = Auth::user()->id;
                $log->timeshare_id = $timeshare->id;
                $log->change = 'The asking price was changed from '.$timeshare->price.' to '.Input::get('price');
                $log->save();
        }

		return Redirect::to('my-timeshares')->with('view-success',' Timeshare successfully updated');
	}

	public function serveEditMyCommercialProperty($id)
	{
		$commercial = DB::table('commercials')
			->where('id','=',$id)
			->first();

			return View::make('edit-my-commercial-property')
				->with('commercial',$commercial);
	}

	public function handleEditMyCommercialProperty($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('commercials')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'address' => Input::get('address')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'region' => Input::get('region')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'town' => Input::get('town')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'status2' => Input::get('status2')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'surburb' => Input::get('surburb')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'unit' => Input::get('unit')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'size' => Input::get('size')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'price' => Input::get('price')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'description' => Input::get('description')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_person' => Input::get('contact_person')
			)
		);
		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_email' => Input::get('contact_email')
			)
		);
		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'contact_mobile' => Input::get('contact_mobile')
			)
		);

		DB::table('commercials')
		->where('id','=', $id)
		->update(array(
				'propertType' => Input::get('propertType')
			)
		);

		return Redirect::to('my-commercial-properties')->with('view-success',' Commercial property successfully updated');
	}

	public function serveEditMyResidentialProperty($id)
	{
		$residential = DB::table('residentials')
			->where('id','=',$id)
			->first();

			return View::make('edit-my-residential-property')
				->with('residential',$residential);
	}

	public function handleEditMyResidentialProperty($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('residentials')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'address' => Input::get('address')
			)
		);

		if(Input::get('region')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'region' => Input::get('region')
			)
		);
	}

	if(Input::get('town')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'town' => Input::get('town')
			)
		);
	}

	if(Input::get('status2')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'status2' => Input::get('status2')
			)
		);
	}

	if(Input::get('status')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'status' => Input::get('status')
			)
		);
	}

	if(Input::get('surburb')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'surburb' => Input::get('surburb')
			)
		);
	}

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'unit' => Input::get('unit')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'size' => Input::get('size')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'price' => Input::get('price')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'description' => Input::get('description')
			)
		);

		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_person' => Input::get('contact_person')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_email' => Input::get('contact_email')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'contact_mobile' => Input::get('contact_mobile')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'bedrooms' => Input::get('bedrooms')
			)
		);
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'bathrooms' => Input::get('bathrooms')
			)
		);


		if(Input::get('propertType')!='') {
		DB::table('residentials')
		->where('id','=', $id)
		->update(array(
				'propertType' => Input::get('propertType')
			)
		);
	}

		return Redirect::to('my-residential-properties')->with('view-success',' Residential property successfully updated');

	}

	public function serveManageAgencyTimeshares()
	{
		$timeshares = DB::table('timeshares')
		->where('agency','=',Auth::user()->agency)
		->orderBy('resort','asc')
		->paginate(10);

		if (Auth::check() && Auth::user()->role == "agency admin") {
			return View::make('manage-agency-timeshares')
			->with('timeshares',$timeshares);
		}else{
			return Redirect::to('/');
		}
	}

	public function serveAllAgencyListings()
	{
		$timeshares = DB::table('timeshares')
		->where('agency','=',Auth::user()->agency)
		->orderBy('resort','asc')
		->paginate(10);

		if (Auth::check()) {
			return View::make('view-all-timeshares')
			->with('timeshares',$timeshares);
		  }else{
			return Redirect::to('/');
		}
    }

    public function servePreListedWeeks()
    {
        $timeshares = DB::table('timeshares')
            ->where('owner','=','UB')
            ->where('pre_selected','=',0)
            ->where('chosen','=',NULL)
            ->paginate(10);

            return View::make('pre-listed-weeks')
                ->with('timeshares',$timeshares);
    }

    public function handlePreListedWeeks()
    {
        $selected = Input::get('selected');

        foreach($selected as $id)
        {
            DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'chosen' => Auth::user()->agency
                        )
                    );

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'pre_selected' => 1
                )
            );
        }

        $selectedWeeks = NULL;

        foreach($selected as $id)
        {
           $selectedWeeks = DB::table('timeshares')
            ->where('id','=',$id)
            ->get();
        }

        $agency = Auth::user()->agency;

        $data = ['selectedWeeks' => $selectedWeeks, 'agency' => $agency];

        Mail::send('emails.pre-select', $data, function($message)
        {
            $message->to('brucel@uni-vision.co.za','Bruce Lynwood')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Tender weeks selected');
            $message->from('info@univateproperties.co.za');
		});

        return Redirect::to('pre-listed-weeks')->with('view-success','Your selection of timeshares has now been sent for authorisation.');
    }

    public function prelistAcessList()
    {
        $agencies = DB::table('users')
            ->where('agencyAdmin','=','YES')
            ->where('agency','!=',NULL)
            ->paginate(10);

            return View::make('admin.pre-list-access')
                ->with('agencies',$agencies);
    }

    public function givePrelistAccess($id)
    {
        DB::table('users')
        ->where('id','=', $id)
        ->update(array(
                'access_prelist' => 1
            )
        );
        //testers

        return Redirect::back()->with('view-success','Access Granted.');
    }

    public function revokePrelistAccess($id)
    {
        DB::table('users')
        ->where('id','=', $id)
        ->update(array(
                'access_prelist' => 0
            )
        );

        return Redirect::back()->with('view-success','Access Revoked.');
    }

    public function verifyTimeshare($id)
	{
		DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'verified' => 1
                        )
					);

		return Redirect::back()->withInput()->with('view-success', 'Timeshare has been successfully verified.');
    }

    public function serveSelctedPreListedWeeks()
    {
        $timeshares = DB::table('timeshares')
            ->where('owner','=','Lengen')
            ->where('pre_selected','=',0)
            ->paginate(10);

            return View::make('authorise-pre-listed-weeks')
                ->with('timeshares',$timeshares);
    }

    public function handleAuthorisePreselectedWeeks()
    {

    }

    public function serveNewResort()
    {
        return View::make('new-resort');
    }

    public function filterWeeks($slug)
    {
        $resort = DB::table('resorts')
		->where('slug','=',$slug)
		->first();

		$awards = explode(',',$resort->awards);
        $facilities = explode(',',$resort->facilities);

        //$start = \DateTime::createFromFormat('m-d-Y', Input::get('from'))->format('Y-m-d');
       // $end = \DateTime::createFromFormat('m-d-Y', Input::get('to'))->format('Y-m-d');


       // Timeshare::whereDate('exam_date', '>=', Carbon::now()->toDateString());

        $timeshares = Timeshare::whereBetween(DB::raw('DATE(fromDate)'), array(Input::get('from'), Input::get('to')))->paginate(10);

            return View::make('filtered-weeks')
                ->with('resort',$resort)
                ->with('awards',$awards)
                ->with('facilities',$facilities)
                ->with('timeshares',$timeshares);
    }

    public function serveEditProfile($id)
    {
        $user = DB::table('users')
            ->where('id','=',$id)
            ->first();

            return View::make('update-profile')
                ->with('user',$user);
    }

    public function handleEditProfile($id)
	{
		$validator = Validator::make(Input::all(),
            [
                'name' => 'required',
				'email' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
		}

		DB::table('users')
                    ->where('id','=', $id)
                    ->update(array(
                            'name' => Input::get('name')
                        )
					);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'surname' => Input::get('surname')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'email' => Input::get('email')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'phone' => Input::get('tel')
			)
		);

		DB::table('users')
		->where('id','=', $id)
		->update(array(
				'mobile' => Input::get('cell')
			)
        );

		return Redirect::back()->with('view-success',"You have successfully updated your details");

    }

    public function serveUploadTenderWeeks()
    {
        return View::make('admin.upload-tender-weeks');
    }

    public function handleExcelUpload()
    {
        config(['excel.import.startRow' => 1 ]);
        Excel::import(new TimesharesImport, Input::file('ex_file'));

        return Redirect::back()->with('view-success', 'Your import is successful!');
    }

    public function reviewPrelistedWeeks()
    {
        $agencies = DB::table('agencies')
            ->paginate(10);

        return View::make('admin.review-prelisted-weeks')
            ->with('agencies',$agencies);
    }



    public function selectedWeeks($id)
    {
        $agency = DB::table('agencies')
            ->where('id','=',$id)
            ->first();

        $timeshares = DB::table('timeshares')
            ->where('chosen','=',$agency->agency)
            ->paginate(10);

            return View::make('admin.selected-weeks')
                ->with('agency',$agency)
                ->with('timeshares',$timeshares);



    }

    public function handleReviewPrelistedWeeks($id)
    {
        $agency = DB::table('agencies')
            ->where('id','=',$id)
            ->first();

        $selected = Input::get('selected');

        foreach($selected as $id)
        {
            DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'agency' => $agency->agency
                        )
                    );

            DB::table('timeshares')
            ->where('id','=', $id)
            ->update(array(
                    'pre_selected' => 1
                )
            );
        }

        $data = ['agency' => $agency];

        Mail::send('emails.pre-list-authorised', $data, function($message)
        {
            $message->to('brucel@uni-vision.co.za','Bruce Lynwood')->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Tender weeks preselection approved.');
            $message->from('info@univateproperties.co.za');
		});

        return Redirect::to('review-prelisted-weeks')->with('view-success','Tender weeks have been successfully assigned to agency.');
    }

    public function publishTheRest()
    {
        $timeshares = DB::table('timeshares')
            ->where('owner','=','UB')
            ->get();

            foreach($timeshares as $timeshare)
            {
                DB::table('timeshares')
                    ->where('id','=', $id)
                    ->update(array(
                            'id' => $timeshare->id
                        )
            );
            }

            return Redirect::to('review-prelisted-weeks')->with('view-success','The remaining timeshares have been successfully published.');
    }

    public function serveLogs()
    {
        $logs = DB::table('timeshare_change_logs')
                ->paginate(10);

        return View::make('admin.timeshare-change-logs')
            ->with('logs',$logs);
    }

    public function serveUser($id)
    {
        $user = DB::table('users')
            ->where('id','=',$id)
            ->first();

            return View::make('admin.view-user')
                ->with('user',$user);
    }

    public function serveTimeshareDetails($id)
    {
        $timeshare = DB::table('timeshares')
            ->where('id','=',$id)
            ->first();

            return View::make('admin.view-timeshare')
                ->with('timeshare',$timeshare);
    }

    public function serveSearchTimeshareFilter($id)
	{
        if(!(Input::has('bedrooms')=="") and !(Input::has('season')=="") and !(Input::has('maxPrice')) and !(Input::has('minPrice')))
        {
            return Redirect::back()->with('view-error', 'No filter entered, please try again')->withInput()->withErrors($validator);
        }

        $resort = DB::table('resorts')
            ->where('id','=',$id)
            ->first();

        $awards = explode(',',$resort->awards);
        $facilities = explode(',',$resort->facilities);
        
        $bedrooms = Input::get('bedrooms');
        $minPrice = (float) (Input::get('minPrice'));
        $maxPrice = (float) (Input::get('maxPrice'));
        $season = Input::get('season');
        $module = Input::get('module');
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');

		$timeshares = DB::table('timeshares')
                ->where(function($query) use ($bedrooms, $season, $minPrice, $maxPrice, $module, $fromDate, $toDate) {

                if ($bedrooms)
                    $query->where('bedrooms','=', $bedrooms);
                if ($module)
                    $query->where('module','=', $module);
                if ($fromDate)
                    $query->where('fromDate','>=',$fromDate);
                if ($toDate)
                    $query->where('fromDate','<=',$toDate);
                if ($season)
                    $query->where('season','=', $season);
                if ($maxPrice)
                    $query->where('setPrice','<=', $maxPrice);
                if ($minPrice)
                    $query->where('setPrice','>=', $minPrice); })
                ->where('resort','=',$resort->resort)
                ->where('published','=',1)
                ->get();


        if($timeshares->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by week, unit, number of bedrooms or price.');
        }

        else
        {
            // multiple resorts search results
            return View::make('timeshare-filter-results')
                ->with('awards',$awards)
                ->with('facilities',$facilities)
                ->with('resort',$resort)
                ->with('timeshares', $timeshares);
		}

    }

    public function serveAddNewResort()
    {
        return View::make('admin.new-resort');
    }

    public function handleAddNewResort()
    {
        $validator = Validator::make(Input::all(),
            [
                'resort' => 'required',
				'region' => 'required',
				'information' => 'required',
				'image1' => 'required',
                'image2' => 'required',
                'image3' => 'required'
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', ' There were errors in your submission please review below')->withInput()->withErrors($validator);
        }

        $resort = new Resort;
        $resort->resort = Input::get('resort');
        $resort->information = Input::get('information');
        $resort->region = Input::get('region');
        $resort->meta_Description = Input::get('information');
        $resort->meta_Keywords = Input::get('information');

		if(Input::has('advisor'))
		{
			$resort->advisor = Input::get('advisor');
        }

        if(Input::has('url'))
		{
			$resort->url = Input::get('url');
		}

		if(Input::has('awards'))
		{
			$resort->awards = implode(',',Input::get('awards'));
		}

		$file = Input::file('image1');
		$file->move('images/resorts/', $file->getClientOriginalName());
		$resort->image1 = '/images/resorts/'.$file->getClientOriginalName();

		$file2 = Input::file('image2');
		$file2->move('images/resorts/', $file2->getClientOriginalName());
        $resort->image2 = '/images/resorts/'.$file2->getClientOriginalName();

        $file3 = Input::file('image3');
		$file3->move('images/resorts/', $file3->getClientOriginalName());
		$resort->image3 = '/images/resorts/'.$file3->getClientOriginalName();

        if(Input::has('layout'))
        {
            $file4 = Input::file('layout');
            $file4->move('images/resort_layouts/', $file4->getClientOriginalName());
            $resort->layout = '/images/resort_layouts/'.$file4->getClientOriginalName();
        }

        $resort->save();

		return Redirect::back()->with('view-success',' Resort has been successfully uploaded');
    }

    public function serveBulkExcelUpload()
    {
        return View::make('bulk-weeks-upload');
    }

    public function handleBulkExcelUpload()
    {
        config(['excel.import.startRow' => 1 ]);
        Excel::import(new TimesharesImport, Input::file('ex_file'));

        $bulk = new TimeshareBulk;
        $bulk->username = Auth::user()->username;
        $bulk->user_id = Auth::user()->id;
        $bulk->email = Auth::user()->email;
        $bulk->save();

        return Redirect::to('/pay-listing-fee/'.$bulk->id)->with('view-success','Your import is successful!');
    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
                $query = $request->get('query');
                $data = DB::table('agencies')
                    ->where('agency', 'LIKE', "%{$query}%")
                    ->get();
                $output = '<ul class="navbar-nav w-100 justify-content-center" style="display:block; position: absolute; z-index: 9; background-color: #33689b;">';

                foreach($data as $row)
                {
                $output .= '
                <li class="nav-item choose"><a style="color:white; text-decoration:none;" class="nav-link choose" href="#">' .$row->agency.'</a></li>
                ';
                }
                $output .= '</ul>';
                echo $output;
        }
    }

    function fetchAgent(Request $request)
    {
        if($request->get('query') && $request->get('estateAgency'))
        {
            $agency = $request->get('estateAgency');
            $query = $request->get('query');
            $data = DB::table('users')
                ->where('agency','=',$agency)
                ->orWhere('name', 'LIKE', "%{$query}%")
                ->orWhere('surname', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="navbar-nav w-100 justify-content-center" style="display:block; position: absolute; z-index: 9; background-color: #33689b;">';

            foreach($data as $row)
            {
            $output .= '
            <span class="nav-item choose"><a style="color:white; text-decoration:none;" class="nav-link choose" href="#">' .$row->name.' '.$row->surname.'</a></span>
            ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    public function serveLogSearch()
	{
		$validator = Validator::make(Input::all(),
            [
                'search' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'No search entered, please try again')->withInput()->withErrors($validator);
        }

        $query = Input::get('search');

        $logs = DB::table('timeshare_change_logs')
            ->where('resort', 'LIKE', '%' . $query . '%')//resort name
            ->orWhere('module', 'LIKE', '%' . $query . '%')
            ->orWhere('unit', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->get();

        if($logs->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by resort name.');
        }

        else
        {
            // multiple resorts search results
            return View::make('admin.log-search-results')
                ->with('logs', $logs);

		}
    }

    public function serveSearchResorts()
	{
		$validator = Validator::make(Input::all(),
            [
                'search' => 'required',
            ]);

        if($validator->fails())
        {
            return Redirect::back()->with('view-error', 'No search entered, please try again')->withInput()->withErrors($validator);
        }

        $query = Input::get('search');

        $logs = DB::table('timeshare_change_logs')
            ->where('resort', 'LIKE', '%' . $query . '%')//resort name
            ->orWhere('module', 'LIKE', '%' . $query . '%')
            ->orWhere('unit', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->get();

            $timeshares = DB::table('timeshares')
            ->get();

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='gauteng' and $timeshare->published=1)
                {
                    $gauteng = DB::table('resorts')
                        ->where('region','=','gauteng')
                        ->groupBy('resort')
                        ->get();
                }
            }

        if($logs->isEmpty())
        {
            return Redirect::back()->with('view-search-error', 'There were no results found, please try searching by resort name.');
        }

        else
        {
            // multiple resorts search results
            return View::make('admin.log-search-results')
                ->with('logs', $logs);
		}
    }

    public function serveSearchResortFilter()
	{
        $resort = Input::get('resort');
        $bedrooms = Input::get('bedrooms');
        $season = Input::get('season');
        $region = Input::get('region');
        $minPrice = (float) (Input::get('minPrice'));
        $maxPrice = (float) (Input::get('maxPrice'));
        $fromDate = Input::get('fromDate');
        $toDate = Input::get('toDate');

        $resorts = DB::table('resorts')
            ->orderBy('resort','asc')
            ->get();

		$timeshares = DB::table('timeshares')
                ->where(function($query) use ($region, $season, $bedrooms, $resort, $minPrice, $maxPrice, $fromDate, $toDate) {
                if ($resort!=null)
                $query->where('resort', '=',$resort)->where('published','=',1);
                if ($season!=null)
                    $query->where('season','=',$season)->where('published','=',1);
                if ($region!=null)
                    $query->where('region','=',$region)->where('published','=',1);
                if ($bedrooms!=null)
                $query->where('bedrooms','=',$bedrooms)->where('published','=',1);
                if ($fromDate!=null)
                    $query->where('fromDate','>=',$fromDate)->where('published','=',1);
                if ($toDate!=null)
                    $query->where('fromDate','<=',$toDate)->where('published','=',1);
                if ($maxPrice!=0.0)
                    $query->where('setPrice','<=', $maxPrice)->where('published','=',1);
                if ($minPrice!=0.0)
                    $query->where('setPrice','>=', $minPrice)->where('published','=',1); })
                ->get();


        if($timeshares->isEmpty())
        {
            $timeshares = DB::table('timeshares')
            ->get();

        $resorts = DB::table('resorts')
            ->orderBy('resort','asc')
            ->get();

            $gauteng = NULL;
            $limpopo = NULL;
            $mpumalanga = NULL;
            $kwazulunatal = NULL;
            $freestate = NULL;
            $northwest = NULL;
            $northerncape = NULL;
            $westerncape = NULL;
            $easterncape = NULL;

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='gauteng' and $timeshare->published=1)
                {
                    $gauteng = DB::table('resorts')
                        ->where('region','=','gauteng')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='limpopo' && $timeshare->published=1)
                {
                    $limpopo = DB::table('resorts')
                        ->where('region','=','limpopo')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='mpumalanga' && $timeshare->published=1)
                {
                    $mpumalanga = DB::table('resorts')
                        ->where('region','=','mpumalanga')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='Kwazulu Natal' && $timeshare->published=1)
                {
                    $kwazulunatal = DB::table('resorts')
                        ->where('region','=','Kwazulu Natal')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='free state' && $timeshare->published=1)
                {
                    $freestate = DB::table('resorts')
                        ->where('region','=','free state')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='north west' && $timeshare->published=1)
                {
                    $northwest = DB::table('resorts')
                        ->where('region','=','north west')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='northern cape' && $timeshare->published=1)
                {
                    $northerncape = DB::table('resorts')
                        ->where('region','=','northern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='western cape' && $timeshare->published=1)
                {
                    $westerncape = DB::table('resorts')
                        ->where('region','=','western cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='eastern cape' && $timeshare->published=1)
                {
                    $easterncape = DB::table('resorts')
                        ->where('region','=','eastern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }
                return View::make('no-results-found2')
                ->with('gauteng',$gauteng)
                ->with('westerncape',$westerncape)
                ->with('northwest',$northwest)
                ->with('mpumalanga',$mpumalanga)
                ->with('limpopo',$limpopo)
                ->with('freestate',$freestate)
                ->with('easterncape',$easterncape)
                ->with('westerncape',$westerncape)
                ->with('northerncape',$northerncape)
                ->with('kwazulunatal',$kwazulunatal)
                ->with('resorts',$resorts)
                ->with('view-search-error', 'There were no results found.');
        }

        else if(($resort==null) && $region==null && $bedrooms==null && $season==null && $minPrice==0.0 && $maxPrice==0.0){
            $timeshares = DB::table('timeshares')
            ->get();

        $resorts = DB::table('resorts')
            ->orderBy('resort','asc')
            ->get();

            $gauteng = NULL;
            $limpopo = NULL;
            $mpumalanga = NULL;
            $kwazulunatal = NULL;
            $freestate = NULL;
            $northwest = NULL;
            $northerncape = NULL;
            $westerncape = NULL;
            $easterncape = NULL;

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='gauteng' and $timeshare->published=1)
                {
                    $gauteng = DB::table('resorts')
                        ->where('region','=','gauteng')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='limpopo' && $timeshare->published=1)
                {
                    $limpopo = DB::table('resorts')
                        ->where('region','=','limpopo')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='mpumalanga' && $timeshare->published=1)
                {
                    $mpumalanga = DB::table('resorts')
                        ->where('region','=','mpumalanga')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='Kwazulu Natal' && $timeshare->published=1)
                {
                    $kwazulunatal = DB::table('resorts')
                        ->where('region','=','Kwazulu Natal')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='free state' && $timeshare->published=1)
                {
                    $freestate = DB::table('resorts')
                        ->where('region','=','free state')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='north west' && $timeshare->published=1)
                {
                    $northwest = DB::table('resorts')
                        ->where('region','=','north west')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='northern cape' && $timeshare->published=1)
                {
                    $northerncape = DB::table('resorts')
                        ->where('region','=','northern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='western cape' && $timeshare->published=1)
                {
                    $westerncape = DB::table('resorts')
                        ->where('region','=','western cape')
                        ->groupBy('resort')
                        ->get();
                }
            }

            foreach($timeshares as $timeshare)
            {
                if($timeshare->region=='eastern cape' && $timeshare->published=1)
                {
                    $easterncape = DB::table('resorts')
                        ->where('region','=','eastern cape')
                        ->groupBy('resort')
                        ->get();
                }
            }
                return View::make('to-buy')
                ->with('gauteng',$gauteng)
                ->with('westerncape',$westerncape)
                ->with('northwest',$northwest)
                ->with('mpumalanga',$mpumalanga)
                ->with('limpopo',$limpopo)
                ->with('freestate',$freestate)
                ->with('easterncape',$easterncape)
                ->with('westerncape',$westerncape)
                ->with('northerncape',$northerncape)
                ->with('kwazulunatal',$kwazulunatal)
                ->with('resorts',$resorts)
                ->with('view-search-error', 'There were no results found.');  
        }

        else
        {
            // multiple resorts search results
            return View::make('to-buy-results')
                ->with('resorts',$resorts)
                ->with('timeshares',$timeshares);
		}
    }

    public function serveGetUsername()
    {
        return View::make('get-username');
    }

    public function sendUsername()
    {
        $users = DB::table('users')
            ->get();

        $email = Input::get('email');
        $sendTo = NULL;

        foreach($users as $user)
        {
            if($email==$user->email)
            {
                $sendTo = $user->email;
            }
        }

        $user = NULL;

        if($sendTo!=NULL)
        {
            $user = DB::table('users')
                ->where('email','=',$sendTo)
                ->first();

                $data = ['user' => $user];
                Mail::send('emails.get-username', $data, function($message) use ($user)
                {
                    $message->to($user->email,$user->name)->bcc('koketso.maphopha@gmail.com','Koketso Maphopha')->subject('Username request');
                    $message->from('info@univateproperties.co.za');
                });
                return Redirect::to('get-username')->with('view-success', 'Your username has been sent to your email address.')->withInput();
        }
        else{
            return Redirect::to('get-username')->with('view-error', 'Email does not exist.')->withInput();
        }
    }

    public function serveAdminFilter()
	{
        if(Input::get('status')=="select" && Input::get('season')=="select" && Input::get('resort')=="select")
        {
            $timeshares = DB::table('timeshares')
                ->orderBy('published','asc')
                ->paginate(10);
                
                $resorts = DB::table('resorts')
                ->orderBy('resort','asc')
                ->get();

                return View::make('admin.admin')
                    ->with('resorts',$resorts)
                    ->with('timeshares',$timeshares)
                    ->with('view-search-error', 'No filter entered, please try again.');
        }

        $resort = Input::get('resort');
        $season = Input::get('season');
        $status = Input::get('status');

		$timeshares = DB::table('timeshares')
                ->where(function($query) use ($season, $status, $resort) {
                if ($resort!="select")
                $query->where('resort', '=', $resort);
                if ($season!="select")
                    $query->where('season','=',$season);
                if ($status!="select")
                    $query->where('published','=',$status);
                 })
                ->get();
        
        $resorts = DB::table('resorts')
        ->orderBy('resort','asc')
        ->get();

        if($timeshares->isNotEmpty())
        {
            return View::make('search-results')
                ->with('resorts',$resorts)
                ->with('timeshares',$timeshares);
            
        }
        else if(Input::get('status')=="select" and Input::get('season')=="select" and Input::get('resort')=="select")
        {
            $timeshares = DB::table('timeshares')
                ->orderBy('published','asc')
                ->paginate(10);
                
                $resorts = DB::table('resorts')
                ->orderBy('resort','asc')
                ->get();

                return View::make('admin.admin')
                    ->with('resorts',$resorts)
                    ->with('timeshares',$timeshares)
                    ->with('view-search-error', 'No filter entered, please try again.');
        }

        else
        {
            $timeshares = DB::table('timeshares')
                ->orderBy('published','asc')
                ->paginate(10);
                
                $resorts = DB::table('resorts')
                ->orderBy('resort','asc')
                ->get();

                if (Auth::check() && Auth::user()->role == "admin") {
                    return View::make('no-results-found')
                    ->with('resorts',$resorts)
                    ->with('timeshares',$timeshares)
                    ->with('view-search-error', 'There were no results found.');
                }
		}
    }
}
