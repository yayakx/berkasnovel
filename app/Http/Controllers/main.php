<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use FeedReader;
use View;
use DB;
use Auth;

class main extends Controller
{
    public function main()
    {
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $data = $feed->get_items();
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }

    public function paginate($items, $perPage = 24, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function listft()
    {
        $ft = DB::table('ft')->inRandomOrder()->limit(8)->get();
        return $ft;
    }
    
    public function listftall()
    {
        $ft = DB::table('ft')->inRandomOrder()->get();
        return $ft;
    }

    public function daftarft()
    {
        $listftall = $this->listftall();
        $listft = $this->listft();

        return View::make('listft', ['listft' => $listft, 'listftall' => $listftall]);
    }

    public function carift(Request $request)
    {
        $kw = $request->nama_ft;
        $db = DB::table('ft')->where('url_ft', $kw)->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $data = $feed->get_items();
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }


    public function carinovel(Request $request)
    {
        $kw = $request->cari;
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $data = preg_filter('/$/', '?q='.$kw, $db);
        $feed = FeedReader::read($data);
        $data = $feed->get_items();
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }

    public function private()
    {
        if (Auth::check()) {
            $db = DB::table('private')->where('id_user', Auth::user()->id)->pluck('url_ft')->toArray();
            $feed = FeedReader::read($db);
            $data = $feed->get_items();
            $items = $this->paginate($data);
            $listftall = DB::table('private')->where('id_user', Auth::user()->id)->inRandomOrder()->get();
        
            return View::make('private', ['items' => $items, 'listftall' => $listftall]);
        } else {
            return redirect('/login')->with('error', 'Harap Masuk Terlebih dahulu');
        }
    }

    public function carift_private(Request $request)
    {
        $kw = $request->nama_ft;
        $db = DB::table('private')->where('url_ft', $kw)->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $data = $feed->get_items();
        $items = $this->paginate($data);

        $listftall = DB::table('private')->where('id_user', Auth::user()->id)->inRandomOrder()->get();        
        
        return View::make('private', ['items' => $items, 'listftall' => $listftall]);
    }

    public function tambahft_private(Request $request)
    {
        $this->validate($request, [
            'nama_ft' => 'required',
            'url_ft' => 'required',            
            // 'g-recaptcha-response' => 'required|captcha',
        ]);
        
        $feed = FeedReader::read([
            $request->url_ft.'/rss.xml',            
        ]);
        $data = $feed->get_items();
        if ($data == null)
        {
            $feed = FeedReader::read([
                $request->url_ft.'/feed',            
            ]);

            $data = $feed->get_items();

            if ($data == null)
            {
                session()->flash("error","Gagal Ditambahkan Karena FT sudah terdaftar");
            }

            else {
                DB::table('private')->insert([            
                    'nama_ft' => $request->nama_ft,
                    'url_ft' => $request->url_ft.'feed',     
                    'id_user' => Auth::user()->id,             
                ]);

                session()->flash("success","FT Berhasil Ditambahkan");
            }
        }  
        else {
            DB::table('private')->insert([            
                'nama_ft' => $request->nama_ft,
                'url_ft' => $request->url_ft.'/rss.xml',     
                'id_user' => Auth::user()->id,             
            ]);
            session()->flash("success","FT Berhasil Ditambahkan");
        }      
    
        return redirect('/private');
    }
}
