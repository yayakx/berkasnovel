@extends('main')

@section('main')

<div class="card border-top-0 me-0">    
    <div class="card-body">
        <div class="card-header bg-main text-white row" style="position:sticky; top:0;z-index:50;width:100%">
            <h4 class="text-white col-md-10" >List Fan Translation yang Terdaftar  ({{$listftall->count()}})</h4>
            <button class="btn btn-outline-light col-md-2 refresh" onclick="location.reload()"><i class="fa fa-sync-alt" aria-hidden="true"></i></button> 
        </div>
            <div class="col-md mt-2">                     
                <div class="scrolling-pagination">     
                <table id="listft" class="table">
                    <thead>
                        <tr class="text-center" style="cursor: pointer;" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                            <th onclick="sortTable(0)">Nama FT</th>
                            <th onclick="sortTable(1)">Link</th>
                            <th>###</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($listftall as $dataft)
                        @php
                            $link = str_replace(array('rss.xml', '/feed'), '', $dataft->url_ft);
                        @endphp   
                        <tr>
                            <td><p class="card-text text-center"><a href="{{ $link }}" class="none" target="_blank">{{$dataft->nama_ft}}</a></p></td>
                            <td> <p class="card-text"><a href="{{ $link }}" target="_blank">{{ $link }}</a></p></td>
                            <td> <p class="card-text text-center"><a href="" class="btn btn-danger" href="#" data-bs-toggle="modal" data-bs-target="#staytune">Laporkan</a></p></td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>                              
                </div>                             
            </div>
    </div>
  </div> 

<script>  

    function sortTable(n) { //sorting ft
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("listft");
        switching = true;

        dir = "asc"; 

        while (switching) {

        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {

            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                
                shouldSwitch= true;
                break;
            }
            } else if (dir == "desc") {
            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                
                shouldSwitch = true;
                break;
            }
            }
        }
        if (shouldSwitch) {

            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;

            switchcount ++;      
        } else {
            if (switchcount == 0 && dir == "asc") {
            dir = "desc";
            switching = true;
            }
        }
        }
    }
</script>

@endsection