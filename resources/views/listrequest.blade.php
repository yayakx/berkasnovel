@extends('main')

@section('main')
    <div class="card border-top-0 me-0">
        <div class="card-body">
            <div class="card-header bg-main text-white row" style="position:sticky; top:0;z-index:50;width:100%">
                <h4 class="text-white col-md-10">List Request Fan Translation</h4>
                <button class="btn btn-outline-light col-md-2 refresh" onclick="location.reload()"><i class="fa fa-sync-alt"
                        aria-hidden="true"></i></button>
            </div>
            <div class="col-md mt-2">
                <div class="col-md">
                    <h5 class="text-center"> Keterangan Status</h5>
                    <span class="w-auto badge bg-warning">Request</span> <small>= Masuk ke daftar Request</small><br>
                    <span class="w-auto badge bg-primary">Review</span> <small>= Sedang di Review</small><br>
                    <span class="w-auto badge bg-success">Complete</span> <small>= Sudah Masuk ke BerkasNovel</small><br>
                    <span class="w-auto badge bg-danger">Reject</span> <small>= Ditolak Masuk ke BerkasNovel</small><br>
                </div>
                <hr>
                <div class="scrolling-pagination">
                    <div class="container row mt-3">
                        @foreach ($items as $item)
                            <div class="card card-hover col-lg-6 col-md-3 text-center" data-aos="fade-down">
                                <div class="card-body row g-0 text-center">
                                    <div class="col-md-7">
                                        <img src="" class="w-50 thumb">
                                    </div>
                                    <div class="col-md-4">
                                        <a href="{{ str_replace(['rss.xml', 'feed'], '', $item->url_ft) }}"
                                            class="font-12 space-2 none" target="_blank">{{ $item->nama_ft }}</a>
                                        <h6 class="card-subtitle mb-2 text-muted mt-2">
                                            <small>Total Request: {{ $item->total }}</small>
                                        </h6>
                                        <h5 class="card-subtitle mb-2 text-muted mt-2">
                                            <small>Status: 
                                                @if ($item->status == "Request")
                                                <span class="badge bg-warning">Request</span></small>
                                                @elseif ($item->status == "Review")
                                                <span class="badge bg-primary">Review</span></small>
                                                @elseif ($item->status == "Complete")
                                                <span class="badge bg-success">Complete</span></small>
                                                @elseif ($item->status == "Reject")
                                                <span class="badge bg-danger">Reject</span></small>
                                                @endif
                                        </h5>
                                        @if (Auth::check() == true)
                                            @if (Auth::user()->role == 1)
                                                <form action="/update_reqft" method="post">
                                                    @csrf
                                                    <input type="text" name="url_ft" value="{{$item->url_ft}}" hidden>
                                                    <div class="form-group mt-2 mb-2">
                                                        <select class="form-control" name="status" id="status">
                                                            <option value="Request">Request</option>
                                                            <option value="Review">Review</option>
                                                            <option value="Complete">Complete</option>
                                                            <option value="Reject">Reject</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="form-control btn btn-dark">Change</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                                </a>
                            </div>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var src = [
                'https://cdn.novelupdates.com/images/2017/09/001.jpg',
                'https://cdn.novelupdates.com/images/2021/08/After-Leaving-the-ARank-Party-I-Aim-for-the-Deep-Part-of-the-Labyrinth-With-My-Former-Students.jpg',
                'https://cdn.novelupdates.com/images/2021/06/Banished-Villainess-Under-Observation.jpg',
                'https://cdn.novelupdates.com/images/2020/09/Doing-Something-with-my-%E2%80%98Angel%E2%80%99-Little-Sister-in-Another-World.jpg',
                'https://cdn.novelupdates.com/images/2021/05/Exiled-Prince-Without-Skills-Infinite-Growth-in-a-Mysterious-Dungeon_1620681738.jpg',
                'https://cdn.novelupdates.com/images/2020/10/Suicidal-Undead.jpg'
            ];
            $(document).ready(function() {
                $(".thumb").each(function() {
                    var randomize = Math.floor(Math.random() * src.length);
                    $(this).attr("src", (src[randomize]));
                });
            });
        </script>
    @endsection
