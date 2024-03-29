@extends('admin.template')
@section('title','النقاط')

@section('route-list')
    <li class="breadcrumb-item"><a href="{{route('admin.point.index')}}"> النقاط</a></li>
@endsection

@section('content-template')
    <div class="card">
        <table class="table table-striped table-hover " id="points-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">اسم الطالب</th>
                <th scope="col">الصف</th>
                <th scope="col">النقاط</th>
            @if(\Illuminate\Support\Facades\Auth::user()->permission=='1')
                <th scope="col">المشرف</th>
            @endif
                <th scope="col">معلومات إضافية</th>
                <th scope="col">التاريخ</th>
                <th scope="col">النشاط</th>
            </tr>
            </thead>
            <tbody>
            @isset($points)
                @foreach($points as $point)
                    <tr id="{{'point_rec'.$point->id}}">
                        <th scope="row">{{$point->id}}</th>
                        <td>@isset($point->user->name){{$point->user->name}} @endisset</td>
                        <td>@isset($point->register->name){{$point->register->name}} @endisset</td>
                        <td>{{$point->points}}</td>
                    @if(\Illuminate\Support\Facades\Auth::user()->permission=='1')
                        <td>@if(isset($point->admin->name)){{$point->admin->name}}@endif</td>
                    @endif
                        <td>{{$point->info}}</td>
                        <td>{{$point->date}}</td>

                        <td>
                            <a class="btn" onclick="click_btn_delete({{$point->id}})" title="حذف"  > <i class="feather icon-x-circle"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>

    <script>
        function click_btn_delete(id){
            WRN_PROFILE_DELETE = "هل تريد تأكيد الحذف؟ ";
             var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {

            $.ajax({
                type: "POST",
                url: "{{route('admin.point.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id':id
                },
                success: function(response) {
                    // remove deleted times rows
                    $("#point_rec"+id).remove();

                    //show  sweat alert message after delete
                    const Toast_Point = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast_Point.fire({
                        icon: 'success',
                        title: 'تم الحذف بنجاح'
                    })

                }
            });
             }
        }


    </script>

@endsection

