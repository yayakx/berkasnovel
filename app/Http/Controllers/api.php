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

class api extends Controller
{
    public function get_data()
    {
        $post = DB::table('rss')->orderBy('timestamp', 'Desc')->Paginate(8);
        return json_encode($post);
    }

    public function set_dibaca($kw)
    {
        $get_dibaca = DB::table('rss')->where('id_rss', $kw)->value('dibaca');
        $post = DB::table('rss')->where('id_rss', $kw)->update(['dibaca' => $get_dibaca+1]);

        if ($post) {
            return json_encode('success');
        }        
    }
    
     public function get_ver()
    {
        return json_encode(5);
    }

    public function get_listft()
    {
        $ft = DB::table('ft')->orderBy('nama_ft', 'Asc')->get();
        return json_encode($ft);
    }
    
    public function get_ft($kw)    
    {                    
        $data = DB::table('rss')->where('permalink', 'like', "%$kw%")->orderBy('timestamp', 'DESC')->Paginate(8);                        
        
        return json_encode($data);
    }

    public function get_cari($kw)    
    {        
        $data = DB::table('rss')->where('title', 'like', "%$kw%")->orderBy('timestamp', 'DESC')->Paginate(8);                
        // dd($data);
        
        return json_encode($data);
    }
    
   public function get_fav($kw)
    {
        $fav = str_replace(['[',']','"'],'', $kw);
        // dd($fav);
        $arrFav = explode(',', $fav);
        // dd($arrFav);
        // dd($kw, $fav, $arrFav );
        $data = DB::table('rss')->whereIn('id_rss', $arrFav)->orderByRaw("FIELD(id_rss, $fav)")->paginate(8);
        
        return json_encode($data);
    }

    public function get_isi($id)
    {
        $getPermalink = DB::table('rss')->where('id_rss', $id)->value('permalink');
        $isi ='Maaf, FT ini belum terindex mendukung Metode V2. Silahkan gunakan List Update V1';
        $htmldoc = HtmlDomParser::file_get_html($getPermalink, false, null, 0);
        if (!empty($htmldoc)) {        
            $cekisi = $htmldoc->find('article .postInner', 0);
            $cekisi2 = $htmldoc->find('div#main-wrapper .blog-post', 0);
            $cekisi3 = $htmldoc->find('article .post-body', 0);
            $cekisi4 = $htmldoc->find('article', 0);
            $cekisi5 = $htmldoc->find('div#main-wrapper .main .widget .blog-posts article', 0);
            $cekisi6 = $htmldoc->find('div#main-wrapper .main .widget .blog-posts', 0);
            $cekisi7 = $htmldoc->find('div#content-wrapper #main .widget .blog-posts', 0);
            $cekisi8 = $htmldoc->find('div#mainWrapper .mainMenu .widget .blogPosts article', 0);
            $cekisi9 = $htmldoc->find('#page', 0);
            $cekisi10 = $htmldoc->find('div#main .post', 0);
            $cekisi11 = $htmldoc->find('div#content-wrapper .main', 0);

            // if ($cekisi11 != null) { $trueisi = $cekisi11; }
            $trueisi = ($cekisi ?? $cekisi2 ?? $cekisi3 ?? $cekisi4 ?? $cekisi5 ?? $cekisi6 ?? $cekisi7 ?? $cekisi8 ?? $cekisi9 ?? $cekisi10 ?? $cekisi11) ;
            $isi = $trueisi->outertext;
            // dd($isi);
        }
        return ($isi);
    }
}
