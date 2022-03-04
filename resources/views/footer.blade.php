 <!-- Modal Req FT -->
 <div class="modal fade" id="req_ft" z-index="99" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="mx-auto">Request Penambahan Fan Translation</h5>
             </div>
             <div class="modal-body ms-3 me-3 mb-0">
                 <form action="{{route('req_ft')}}" method="post">
                     @csrf
                     <div id="status" class="alert alert-info">
                        <strong>Perhatian!</strong> Sementara ini kami hanya menerima FT yang menggunakan Blogger atau Wordpress Saja.
                    </div>
                     <div class="form-group mb-2">
                       <label for="">Nama Fan Translation</label>
                       <input type="text" name="nama_ft" id="nama_ft" class="form-control" placeholder="Masukkan Nama FT" aria-describedby="helpId" required>
                       <small id="helpId" class="text-muted fst-italic">Contoh: Kimi Novel</small>
                     </div>
                     <div class="form-group mb-2">
                        <label for="">URL / Link Fan Translation</label>
                        <input type="url" name="url_ft" id="url_ft" class="form-control" placeholder="Masukkan URL FT Secara Lengkap" aria-describedby="helpId" required>
                        <small id="helpId" class="text-muted fst-italic">Contoh: https://kiminovel.com</small>
                      </div>
                      <div class="form-group mb-2">
                        <label for="">Alasan</label>
                        <textarea name="alasan" id="alasan" cols="2" rows="5" class="form-control" style="resize:none" required></textarea>                        
                        <small id="helpId" class="text-muted fst-italic">Contoh: Terjemahannya HTL bukan hasil mesin jadi mudah dipahami~</small>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary col-md-12">Request</button>
                      </div>
                 </form>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-window-close"></i> Tutup</button>
             </div>
         </div>
     </div>
 </div>

 {{-- chatango --}}
 <div class="">
     <script id="cid0020000271796876883" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
          style="width: 247px;height: 362px;">
         {
             "handle": "neonovel",
             "arch": "js",
             "styles": {
                 "a": "383838",
                 "b": 100,
                 "c": "FFFFFF",
                 "d": "FFFFFF",
                 "k": "383838",
                 "l": "383838",
                 "m": "383838",
                 "n": "FFFFFF",
                 "p": "10",
                 "q": "383838",
                 "r": 100,
                 "pos": "br",
                 "cv": 1,
                 "cvbg": "202020",
                 "cvw": 370,
                 "cvh": 41,
                 "surl": 0,
                 "cnrs": "0.35",
                 "ticker": 1
             }
         }
     </script>
 </div>

 <script>
     // Hover Shadow
     $(document).ready(function() {
         $(".card-hover").hover(
             function() {
                 $(this).addClass('shadow-lg').css('cursor', 'pointer');
             },
             function() {
                 $(this).removeClass('shadow-lg');
             }
         );
     });

     // Random Badge Color
     var warna = ['bg-primary', 'bg-secondary', 'bg-dark', 'bg-info', ];
     $(document).ready(function() {
         $(".namaft").each(function() {
             var randomize = Math.floor(Math.random() * warna.length);
             $(this).addClass(warna[randomize]);
         });
     });

     // Select2
     $(document).ready(function() {
         $("#nama_ft").select2({

         });
     });

     // AOS
     // document.addEventListener("mousemove", e => {
     //     AOS.init();
     //     AOS.refresh();
     // });
     $(document).ready(function() {
         AOS.init();
     });
 </script>
