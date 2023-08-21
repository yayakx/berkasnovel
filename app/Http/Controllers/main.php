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
use App\Models\RSS;

set_time_limit(0);

class main extends Controller
{
    public function main()
    {
        $items = RSS::orderBy('timestamp', 'Desc')->paginate(24);
        // $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        // $url = 'https://fantasykun.blogspot.com/';
        
        // $htmldoc = HtmlDomParser::file_get_html($url, false, null, 0);
        
        // $cek = $htmldoc->find('main a img', 0);
        // if ($cek != null) {
        //     $cek->src;
        // } elseif ($cek == null) {
        //     $cek2 = $htmldoc->find('main a span', 0);
        //     if ($cek2 != null) {
        //         $cek = 'm2'.$cek2->{'data-image'};
        //     }
        //     else if ($cek == null) {
        //         $cek3 = $htmldoc->find('div a span img', 0);
        //         if ($cek3 != null) {
        //             $cek = 'm3'.$cek3->src;
        //         }
        //     }
        //     else if ($cek == null) {
        //         $cek4 = $htmldoc->find('img.img-responsive', 0);
        //         if ($cek4 != null) {
        //             $cek = 'm4'.$cek4->src;
        //         }
        //     }
        // }

        // if ($cek = null) {
        //     $cek = 'Kosong';
        // }

                            
                        

        // $cek = $htmldoc->find('div.entry-content-wrap', 0)->outertext;

        // echo $cek;
        // echo $cek;
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
                if (!empty($htmldoc) || $htmldoc !== false) {
                    $cek = $htmldoc->find('img[border=0]', 0);
                    $cek2 = $htmldoc->find('main a span', 0);
                    $cek3 = $htmldoc->find('div a span img', 0);
                    $cek4 = $htmldoc->find('img.img-responsive', 0);

                    $cekimg = $cek ?? $cek2 ?? $cek3 ?? $cek4;
                    if ($cekimg != null) {
                        $img = $cekimg->src ?? $cekimg->{'data-image'};                    
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
                ]);

                    // $new_item = (object) array(
                // 'hash'      => $item->get_id(true),
                // 'timestamp' => $item->get_date('j F Y'),
                // 'title'     => $item->get_title(),
                // 'thumb'     => $img,
                // 'permalink' => $item->get_permalink(),
                // 'feed'      => $item->get_feed()->get_link()
                } else {
                    continue;
                }
            } else {
                continue;
            }
        }        
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
        $items = DB::table('rss')->where('ft', 'like', "%$kw%")->orderBy('timestamp', 'DESC')->paginate(24);
        // $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
    }


    public function carinovel(Request $request)
    {
        $kw = $request->kw;
        $items = DB::table('rss')->where('title', 'like', '%'.$kw.'%')->paginate(24);
        // $data = preg_filter('/$/', '?q='.$kw, $db);        
        // $items = $this->paginate($data);

        $listftall = $this->listftall();
        $listft = $this->listft();
        // dd($data);
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall, 'kw' => $kw]);
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

    public function req_ft(Request $request)
    {
        $this->validate($request, [
            'nama_ft' => 'required',
            'url_ft' => 'required',
            'alasan' => 'required',
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
                session()->flash("error", "Gagal Ditambahkan Karena FT Tidak Menggunakan Blogger / Wordpress");
            } else {
                DB::table('request_ft')->insert([
                    'nama_ft' => $request->nama_ft,
                    'url_ft' => $request->url_ft.'feed',
                    'alasan' => $request->alasan,
                ]);

                session()->flash("success", "Request FT Berhasil Ditambahkan");
            }
        } else {
            DB::table('request_ft')->insert([
                'nama_ft' => $request->nama_ft,
                'url_ft' => $request->url_ft.'/rss.xml',
                'alasan' => $request->alasan,
            ]);
            session()->flash("success", "Request FT Berhasil Ditambahkan");
        }
    
        return redirect('/');
    }

    public function list_reqft()
    {
        $db = DB::table('request_ft')->select('status', 'nama_ft', 'url_ft', DB::raw('count(*) as total'))->groupBy('url_ft')->orderBy('total')->get();

        $listftall = $this->listftall();
        $listft = $this->listft();
        
               
        // dd($db);
        return View::make('listrequest', ['items' => $db, 'listft' => $listft, 'listftall' => $listftall]);
    }

    public function update_reqft(Request $request) 
    {
        $cek = DB::table('request_ft')->where('url_ft', $request->url_ft)->update(['status' => $request->status]);

        if ($cek == true) {
            return back()->with('success', ' Data telah diperbaharui!');
        }
        else {
            return back()->with('error', ' Ada yang Salah');
        }
    }

    public function singleFT(Request $request)
    {
        $id = $request->id;
        $ft = DB::table('ft')->where('id_ft', $id)->first();
        $url = $ft->url_ft;        
        $parsedUrl = parse_url($url);        
        $mainUrl = $parsedUrl['scheme'] . '://' . $parsedUrl['host'];
        $items = RSS::where('feed', 'like', '%'.$mainUrl.'%');
        $total_rilis = $items->count();                
        
        return View::make('singe-ft', ['items' => $items->paginate(12), 'ft' => $ft, 'id' => $id, 'total_rilis' => $total_rilis]);
    }
}
