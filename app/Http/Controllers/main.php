<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FeedReader;
use View;
use DB;

class main extends Controller
{
    public function main()
    {
        // $feed = FeedReader::read(array(
        //     'https://zerokaito.blogspot.com/rss.xml',
        //     'https://kiminovel.com/rss.xml',
        // ));
        // // $feed = FeedReader::read('https://zerokaito.blogspot.com/rss.xml','https://kiminovel.com/rss.xml');
        // $feed->set_item_class();
        // $feed->enable_cache(true);
        // $feed->set_cache_location($_SERVER['DOCUMENT_ROOT']);
        // $feed->set_cache_duration(3600);
        // $feed->init();
        // $feed->handle_content_type();
        // $items = $feed->get_items();
        
        
        // return View::make('listupdate', ['items' => $items]);

        $db = DB::table('ft')->pluck('url_ft')->toArray();
        $feed = FeedReader::read($db);
        $items = $feed->get_items();

        $listftall = $this->listftall();
        $listft = $this->listft();
        
        return View::make('listupdate', ['items' => $items, 'listft' => $listft, 'listftall' => $listftall]);
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
