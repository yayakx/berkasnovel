<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use FeedReader;
use View;
use DB;

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

    public function daftarft(){
        $listftall = $this->listftall();
        $listft = $this->listft();

        return View::make('listft', ['listft' => $listft, 'listftall' => $listftall] );
    }

    public function carift(Request $request) { 
        $kw = $request->nama_ft;   
        $db = DB::table('ft')->where('url_ft',$kw)->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $items = $feed->get_items();   

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall] );
    }    


    public function carinovel(Request $request) {
        $kw = $request->cari;        
        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $data = preg_filter('/$/', '?q='.$kw, $db);                
        $feed = FeedReader::read($data);
        $items = $feed->get_items();        

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall] );
    }
}
