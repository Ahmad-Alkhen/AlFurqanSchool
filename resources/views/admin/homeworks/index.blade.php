@extends('admin.template')
@section('title','الواجبات المنزلية')

@section('route-list')
    <li class="breadcrumb-item"><a href="{{route('admin.homework.index')}}"> الواجبات المنزلية</a></li>
@endsection

@section('content-template')
    <div class="card">
        <table class="table table-striped table-hover table-responsive" id="homework-table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">الصف</th>
                <th scope="col">تفاصيل الواجب</th>
            @if(\Illuminate\Support\Facades\Auth::user()->permission=='1')
                <th scope="col">المشرف</th>
            @endif
                <th scope="col">التاريخ</th>
                <th scope="col">النشاط</th>
            </tr>
            </thead>
            <tbody>
            @isset($homeworks)
                @foreach($homeworks as $homework)
                    <tr id="{{'homework_rec'.$homework->id}}">
                        <th scope="row">{{$homework->id}}</th>
                        <td>@isset($homework->register->name){{$homework->register->name}}@endisset</td>
                        <td class="info">{{$homework->info}}</td>
                    @if(\Illuminate\Support\Facades\Auth::user()->permission=='1')
                         <td>@isset($homework->admin->name){{$homework->admin->name}}@endisset</td>
                    @endif
                        <td>{{$homework->date}}</td>
                        <td>
                            <a class="btn" onclick="click_btn_delete({{$homework->id}})" title="حذف"  > <i class="feather icon-x-circle"></i></a>
                        </td>
                    </tr>
                @endforeach
            @endisset
            </tbody>
        </table>
    </div>



    <script>
        function click_btn_delete(id){
            WRN_PROFILE_DELETE = "هل تريد تأكيد حذف العنصر";
             var checked = confirm(WRN_PROFILE_DELETE);
            if(checked == true) {

            $.ajax({
                type: "POST",
                url: "{{route('admin.homework.delete')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id':id
                },
                success: function(response) {
                    // remove deleted times rows
                    $("#homework_rec"+id).remove();
                }
            });
             }
        }
    </script>

@endsection

