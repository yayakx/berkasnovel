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
use Sunra\PhpSimple\HtmlDomParser;
set_time_limit(0);

class main extends Controller
{
    public function main()
    {
        $data = DB::table('rss')->orderBy('timestamp', 'Desc')->get();       
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
       
        // $dd = json_decode($data);        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }

    public function update_rss()
    {
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $feed->init();
        $feed->handle_content_type();
        $data = $feed->get_items();
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();

        // $url = 'https://www.kiminovel.com/2022/02/aobuta-jilid-1-bab-5-2.html';            
        // $htmldoc = HtmlDomParser::file_get_html($url, false, null, 0 );
        // $a = $htmldoc->find('img', 0)->src;                                       

        foreach ($data as $item) {
            $cekhash = DB::table('rss')->where('hash', $item->get_id(true))->first();
            if ($cekhash == null) {
                $htmldoc = HtmlDomParser::file_get_html($item->get_permalink(), false, null, 0);
                $cekimg = $htmldoc->find('img', 0);
                if ($cekimg != null) {
                    $img = $cekimg->src;
                } else {
                    $img = 'https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg';
                }

                DB::table('rss')->insert([
                    'hash'      => $item->get_id(true),
                    'timestamp' => $item->get_date('U'),
                    'title'     => $item->get_title(),
                    'thumb'     => $img,
                    'permalink' => $item->get_permalink(),
                    'feed'      => $item->get_feed()->get_link(),
                    'ft'        => $item->get_feed()->get_title(),
                    'created_at'=> \Carbon\Carbon::now()->toDateTimeString()
                ]);

                // $new_item = (object) array(
                // 'hash'      => $item->get_id(true),
                // 'timestamp' => $item->get_date('j F Y'),
                // 'title'     => $item->get_title(),
                // 'thumb'     => $img,
                // 'permalink' => $item->get_permalink(),
                // 'feed'      => $item->get_feed()->get_link()            
            }
            else {
                continue;
            }
        }
        // $dd = json_decode($data);        
        // return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
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
        $data = DB::table('rss')->where('feed','like',"%$kw%")->get();       
        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }


    public function carinovel(Request $request)
    {
        $kw = $request->cari;
        $data = DB::table('rss')->where('permalink','like',"%$kw%")->get();
        // $data = preg_filter('/$/', '?q='.$kw, $db);

        $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        // dd($data);
        
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
        if ($data == null) {
            $feed = FeedReader::read([
                $request->url_ft.'/feed',
            ]);

            $data = $feed->get_items();

            if ($data == null) {
                session()->flash("error", "Gagal Ditambahkan Karena FT sudah terdaftar");
            } else {
                DB::table('private')->insert([
                    'nama_ft' => $request->nama_ft,
                    'url_ft' => $request->url_ft.'feed',
                    'id_user' => Auth::user()->id,
                ]);

                session()->flash("success", "FT Berhasil Ditambahkan");
            }
        } else {
            DB::table('private')->insert([
                'nama_ft' => $request->nama_ft,
                'url_ft' => $request->url_ft.'/rss.xml',
                'id_user' => Auth::user()->id,
            ]);
            session()->flash("success", "FT Berhasil Ditambahkan");
        }
    
        return redirect('/private');
    }
}
