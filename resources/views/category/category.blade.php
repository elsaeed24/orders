
@extends('layouts.app')


@section('content')


<div class="container" dir="rtl">
     <div class="row justify-content-center">


         <div class="col-md-4">
             <div class="card">
                 <div class="card-header text-center">الصنف</div>
                 <form class="form" action="{{ route('cat_store') }}"  method="post">
                     @csrf
                     <div class="card-body text-right">
                         <div class="form-group">
                             <label for="name">اسم الصنف</label>
                             <input type="text" class="form-control" name="cat_name" placeholder="اسم الصنف">
                         </div>
                         <br>

                         <div class="form-group text-center">
                             <button class="btn btn-danger" type="submit">حفظ</button>
                         </div>
                     </div>
                 </form>
             </div>
         </div>



         <div class="col-md-8">
             <div class="card">
                 <div class="card-header text-center">الأصناف</div>


                 <div class="card-body">
                     @if (session('message'))
                         <div class="alert alert-success" role="alert">
                             {{ session('message') }}
                         </div>
                     @endif
                     <table class="table table-bordered text-center">
                         <thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">اسم الصنف</th>
                                 <th scope="col">تعديل</th>
                                 <th scope="col">حذف</th>

                             </tr>
                         </thead>
                      <tbody>
                        @php
                             $i =0;

                            @endphp

                        @foreach ($cats as $key=> $row)
                        <tr>


                            <td scope="row" style="width: 12%">{{ ++$i }}</th>
                             <td hidden >{{ $row->id }}</td>
                            <td>{{ $row->cat_name }}</td>

                            <td style="width: 15%"><button class="btn btn-primary editbtn">تعديل</button></td>

                            <td style="width: 15%">
                                 <a href="{{ route('cat_delete',$row->id) }}" class="btn btn-danger" id="delete">حذف</a>
                             </td>

                        </tr>

                        @endforeach


                      </tbody>
                   </table>


                 </div>

             </div>

         </div>

     </div>

 </div>




 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" dir="rtl">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">اسم الصنف</h5>

        </div>
        <div class="modal-body">
          <form action="{{ route('cat_update') }}" method="POST">
            @csrf

            <input type="hidden" class="form-control" id="id" name="id">

            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">اسم الصنف</label>
              <input type="text" class="form-control" id="cat_name" name="cat_name">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
          <button type="submit" class="btn btn-primary">تعديل</button>
        </div>
    </form>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function(){
        $('.editbtn').on('click',function(){
            $('#exampleModal').modal('show');

            $tr=$(this).closest('tr');

        var data=$tr.children("td").map(function(){
            return $(this).text();
        }).get();

        console.log(data);
        $('#id').val(data[1]);
        $('#cat_name').val(data[2]);


                });
            });

</script>

<script>
    $(document).on("click", "#delete", function(e) {
        e.preventDefault();
        var link = $(this).attr("href");
        Swal.fire({
                title:  'هل تريد تأكيد الحذف',
                icon: 'question',
                iconHtml: '؟',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم',
                cancelButtonText: 'لا',
                showCancelButton: true,
                showCloseButton: true

                }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = link;
                                    Swal.fire(
                                        'تم الحذف!',
                                        'تم الحذف بنجاح.',
                                        'نجاح'
                                    )
                                }
                            });
                        });
                    </script>



@endsection
