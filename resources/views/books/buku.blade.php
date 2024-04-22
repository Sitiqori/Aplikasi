@extends('layouts.master')
@section('title', ' Buku')

@section('content')

<style>
.main{
     overflow: hidden;
     font-family: marmelad;
}
.kiri{
    padding: 1rem;
    padding-left: 2rem;
    font-family: marmelad;
}
.ki-ats{
    width: 100%;
    background-color: lightgray;
    border-radius: 5px;
    height: 12rem;
}
.ki-input{
    width: 100%;
}
.ki-tg-j{
    margin-top: 2rem;
    font-size: 22px;
    text-align: center;
    margin-bottom: 1rem;
}
.ki-tg-book{
    width: 100px;
    margin-right: 20px;
}
.ki-tg-bcover{
    background-color: lightgray;
    width: 96px;
    height: 128px;
    align-items: center;
    border-radius: 5px;
}
.ki-tg-bjudul{
    color: #1C1A1B;
    font-size: 20pxpx;
    text-align: center;
}
.ki-tg-bbutton{
    background-color: #1C1A1B;
    text-align: center;
    margin: 7px;
    font-size: 11px;
    color: #fdfcfb;
    padding: 3px;
    margin-left: 1rem;
}


.kanan{
    padding: 1rem;
}
.kanan1{
    font-family: marmelad;
    padding-top: 1rem;
}
.kanan2{
    background-color: lightgray;
    width: 100%;
    position: relative;
    right: 15px;
    height:13rem;
    border-radius: 5px;
}
.jud-ka{
    font-size: 20px;
}
.desk-ka{
    font-size: 15px;
    width: 90%;
}

.ke1{
    background-color: gray;
    width: 96px;
    height: 128px;
    border-radius: 5%;
    margin-right: 1rem;
}


.ka-tg-isi{
    margin-top: 2rem;
}
.ka-i-d-desk{
    background-color: #fdfcfb;
    width: 100%;
    height: 115px;
    padding-left: 1rem;
}
.ka-d-ds{
    font-size: 14px;
    padding: 7px;
}
.ka-i-d-gmb{
    background-color: lightgray;
    width: 96px;
    height: 128px;
    position: relative;
    bottom: 20px;
}


.title{
     font-size: 17px;
}

</style>
<div class="main">
     <div class="body-content">
         <div class="row g-0">
             <div class="content col-lg-11 d-flex">
                 <div class="kiri col-lg-6">
                     <!-- Tambahkan input pencarian di sini -->
                     <form class=" col-lg-12 d-flex" role="search">
                         <input type="search" class="ki-input form-control me-2"  name="judul" placeholder="Search Book's Title" aria-label="Search" >
                         <button class="btn btn-outline-dark" type="submit">Search</button>
                     </form>
                     <div class="">
                         <img src="{{asset('images/book.jpg')}}" class="ki-ats mt-3" alt="">
                     </div>                    
                 </div>
                 <div class="kanan col-lg-6">
                     <div class="ka-ats d-flex">
                         <div class="kanan1 col-lg-6 mt-4">
                             <p class="jud-ka">
                                 Do You Love Reading Books? <br>We Have <span style="font-size: 28px; color: #E26266;">{{$book_count}}++ </span>Books For You!
                             </p>
                             <p class="desk-ka">
                                 Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium sequi non dolores consequatur assumenda sint tempora cumque provident, obcaecati ipsa sapiente ab, reprehenderit ddolorem?
                             </p>
                         </div>
                         <div >
                             <img src="{{asset('images/seen.png')}}" class="kanan2 col-lg-6 mt-4" alt="">
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="data mt-4 " style="margin-left: 2rem">
          @foreach ($books as $item)
    <div class="card mb-3 col-lg-3 col-md-4 col-sm-6 mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $item->cover != null ? asset('storage/cover/' . $item->cover) : asset('images/cover_not_available.png') }}"  class="img-fluid rounded-start" alt="..." draggable="false">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="title">{{ $item->title }}</p>
                    <p>bintang bintang</p>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <div class="">
                            @if ($item->status == 'in stock')
                            <button class="btn btn-primary" disabled>In stock</button>
                            @else
                            <button class="btn btn-secondary" disabled>Out of Stock</button>
                            @endif
                        </div>
                        
                        <!--<button class="btn  fw-bold { $item->status == 'instock' ? 'text-success' : 'text-danger' }} me-md" disabled data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}"></button>
                         Button trigger modal -->
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $item->id }}">Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="detailModalLabel">{{ $item->title }}</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 <div class="row">
                     <div class="col-md-4">
                         <img src="{{ $item->cover != null ? asset('storage/cover/' . $item->cover) : asset('images/cover_not_available.png') }}"  class="img-fluid" alt="Book Cover">
                     </div>
                     <div class="col-md-8">
                         <p>{{ $item->book_code }}</p>
                         <p>{{ $item->author }}</p>
                         <p>{{ $item->publisher }}</p>
                         <p>{{ $item->publication_year }}</p>
                         <p>{{ $item->sinopsis }}</p>
                         @if ($item->status == 'in stock')
                             <button class="btn btn-primary" onclick="pinjamBuku('{{ $item->id }}')">Pinjam</button>
                         @else
                             <button class="btn btn-secondary" disabled>Out of Stock</button>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 
@endforeach
      </div>
      
      </div>
      
         {{-- <h4 class="text-center mt-4">lorem20</h4> <!-- Pindahkan tulisan ini ke dalam div body-content --> --}}
     </div>
 </div>
 
        
        <script>
          function pinjamBuku(bookId) {
               // Kirim request AJAX untuk melakukan peminjaman buku
               $.ajax({
                    url: '{{ route("books.pinjam") }}',
                    type: 'POST',
                    data: {
                         book_id: bookId,
                         _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                         // Tambahkan kode di sini untuk menangani respons dari server
                         alert('Buku berhasil dipinjam');
                    },
                    error: function(xhr, status, error) {
                         // Tambahkan kode di sini untuk menangani kesalahan
                         console.error(error);
                    }
               });
          }




            function toggleDropdown(event, bookId) {
                event.preventDefault();
        
                // Semua dropdown disembunyikan terlebih dahulu
                var allDropdowns = document.querySelectorAll('[id^="book-details-dropdown-"]');
                allDropdowns.forEach(function(dropdown) {
                    dropdown.style.display = 'none';
                });
        
                // Dropdown yang sesuai dengan ID buku yang diklik ditampilkan
                var dropdown = document.getElementById("book-details-dropdown-" + bookId);
                dropdown.style.display = "block";
            }
        </script>

@endsection