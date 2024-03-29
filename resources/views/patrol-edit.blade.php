<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('Assets/css/bootstrap.min.css')}}">
    <script src="{{asset('Assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('Assets/js/popper.min.js')}}"></script>
    <script src="{{asset('Assets/js/bootstrap.min.js')}}"></script>
    <link  rel="stylesheet" href="{{asset('Assets/css/style.css')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
    .is-invalid{
        border:2px solid red;
    }
    .uppersection{
        display: flex;
        flex-direction: row-reverse;
        width: 100%;
        justify-content: space-around;
    }
    ::placeholder{
        color:black;
        opacity: 60%;
    }
    input:read-only{
        background-color:lightgrey;
    }
    .printing{
        display:none;
    }
    @media print{
        .dashboardmain {
            width: 100%;
            height: 100vh;
            display: grid;
            grid-template-columns: 100%;
            grid-template-areas: "main";
        }

        .dashboardmaincontent{
            grid-area: main;
            width: 100%;
            height: 100vh;
            display: grid;
            grid-template-rows: auto;
            overflow-y: scroll;
            position: relative;
            grid-template-areas:
                "main";
        }
        .headerofdashboardmaincontent{
             display:none;
        }
        .mainofdashboardmaincontent > div{
             display:none;
        }
        .dashboardmainsidebar{
            display:none;
        }
        .printing{
            display:block;
        }
        #uppersection{
            display:none;
        }
    }
    </style>
</head>
<body>
    <div class="dashboardmain">
  
        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent">
               <div class="one">
               </div>
               <div class="two">
                   <h1 style="color:#308CBA;">الورديات</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent" style="flex-wrap:no-wrap;flex-direction: column;">
              <div class="uppersection" id="uppersection" style="">

              <div class="right">

                    <table border="1" width='200px'>
        <tr>
        <td colspan="2">تسعيرة الشهر</td>
        </tr>
        @foreach($fuelprices as $fuelprice)
        <tr>
        <td>{{$fuelprice->fuel_type}}</td>
        <td>{{$fuelprice->price}}</td>
        </tr>
      @endforeach
        </table>

              </div>

              <div class="left"></div>
              <table border="1">
<tbody>
<tr>
<td><?php echo date('Y-m-d');?></td>
<td>التاريخ</td>
</tr>
<tr>
<td><?php echo date('G:i:s'); ?></td>
<td>الوقت</td>
</tr>
<tr>
<td>{{$id ?? ''}}</td>
<td>رقم الدورية</td>
</tr>
</tbody>
</table>
              </div>
              <center>
              <h1 class="printing">THIS PAGE ISN'T MADE FOR PRINTING SUBMIT YOUR FORM THEN PRINT FROM /patrol/show</h1>
              </center>
              <div class="middlesection">
              @if (Auth::user()->typeofuser == 'annex')
              <form action="/patrols" method="POST" style="display: flex;flex-direction: column;align-items: flex-end;">
    @elseif (Auth::user()->typeofuser == 'superuser')
    <form action="/dashboard/companies/{{$comp_id}}/annexes/{{$an_id}}/patrols/all" method="POST" style="display: flex;flex-direction: column;align-items: flex-end;">
    @endif
              @csrf
    <input type="hidden" value="{{$date}}" name="date">
    <input type="hidden" value="{{$id}}" name="patrol">

              <h1>ديزل</h1>

              <table border="1" style="
    direction: rtl;
">
<tbody>
<tr>
<td>رقم الطرمبة</td>

@foreach($diesel_pomps as $data)
<td>{{$data->pomp_serial}}</td>
@endforeach

</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($diesel_pomps as $data)
<td>{{$data->last_record}}</td>
@endforeach
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($diesel_pomps as $data)
@php
$pomp_serial = $data->pomp_serial;
$get_new_record = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','diesel')->where('annex_id',$team_leader_annex)->get();
@endphp
@foreach($get_new_record as $rec)
<td><input type="text" value="{{$rec->new_record}}" name="d{{$rec->pomp_serial}}" /></td>
@endforeach
@if($get_new_record == '[]')
<td><input type="text" value="0" name="d{{$data->pomp_serial}}" /></td>
@endif
@endforeach
</tr>



</tbody>
</table>

<h1>غاز</h1>

              <table border="1" style="
    direction: rtl;
">
<tbody>
<tr>
<td>رقم الطرمبة</td>

@foreach($gas_pomps as $data)
<td>{{$data->pomp_serial}}</td>
@endforeach
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($gas_pomps as $data)
<td>{{$data->last_record}}</td>
@endforeach
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($gas_pomps as $data)
@php
$pomp_serial = $data->pomp_serial;
$get_new_record = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','gasoline')->where('annex_id',$team_leader_annex)->get();
@endphp
@foreach($get_new_record as $rec)
<td><input type="text" value="{{$rec->new_record}}" name="g{{$rec->pomp_serial}}" ></td>
@endforeach
@if($get_new_record == '[]')
<td><input type="text" value="0" name="g{{$data->pomp_serial}}" /></td>
@endif
@endforeach
</tr>



</tbody>
</table>


<h1>91 بنزين</h1>
              <table border="1" style="
    direction: rtl;
">
<tbody>
<tr>
<td>رقم الطرمبة</td>

@foreach($es91_pomps as $es_pomp)
<td>{{$es_pomp->pomp_serial}}</td>
@endforeach
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($es91_pomps as $es_pomp)
<td>{{$es_pomp->last_record}}</td>
@endforeach
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($es91_pomps as $es_pomp)
@php
$pomp_serial = $es_pomp->pomp_serial;
$get_new_record = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence91')->where('annex_id',$team_leader_annex)->get();
@endphp
@foreach($get_new_record as $rec)
<td><input type="text" value="{{$rec->new_record}}" name="es91{{$rec->pomp_serial}}" ></td>
@endforeach
@if($get_new_record == '[]')
<td><input type="text" value="0" name="es91{{$es_pomp->pomp_serial}}" /></td>
@endif
@endforeach
</tr>


</tbody>
</table>


<h1>95 بنزين</h1>
              <table border="1" style="
    direction: rtl;
">
<tbody>
<tr>
<td>رقم الطرمبة</td>

@foreach($es95_pomps as $es_pomp)
<td>{{$es_pomp->pomp_serial}}</td>
@endforeach
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($es95_pomps as $es_pomp)
<td>{{$es_pomp->last_record}}</td>
@endforeach
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($es95_pomps as $es_pomp)
@php
$pomp_serial = $es_pomp->pomp_serial;
$get_new_record = DB::table('patrol_transitional')->where('pomp_serial',$pomp_serial)->where('tank_fuel_type','essence95')->where('annex_id',$team_leader_annex)->get();
@endphp
@foreach($get_new_record as $rec)
<td><input type="text" value="{{$rec->new_record}}" name="es95{{$rec->pomp_serial}}" ></td>
@endforeach
@if($get_new_record == '[]')
<td><input type="text" value="0" name="es95{{$es_pomp->pomp_serial}}" /></td>
@endif
@endforeach
</tr>


</tbody>
</table>


<br><br>
<div style="    display: flex;
    flex-direction: row-reverse;">
<table border="1px" style="direction:rtl;">
	<tbody>
    <tr>
    <tr>
        <td>ATM</td>
			<td><input type="text" class="@error('atm') is-invalid @enderror" name="atm" id="" value="{{$last_table->atm ?? ''}}" required autocomplete="atm" autofocus></td>
		</tr>
		<tr>
			<td>اجل</td>
			<td><input type="text" class="@error('retard') is-invalid @enderror" name="retard" id="" value="{{$last_table->retard ?? ''}}" required autocomplete="retard" autofocus></td>
		</tr>
        <tr>
			<td>التسديد</td>
			<td><input type="text" class="@error('repayment') is-invalid @enderror" name="repayment" id="" value="{{$last_table->repayment ?? ''}}" required autocomplete="repayment" autofocus></td>
		</tr>
        <tr>
			<td>ملاحظات التسديد</td>
			<td><textarea type="text" class="@error('repayment_desc') is-invalid @enderror" name="repayment_desc" id="" value="" required autocomplete="repayment_desc" autofocus>{{$last_table->repayment_desc ?? ''}}</textarea></td>
		</tr>
		<tr>
			<td colspan="2"> اجمالي الكاش</td>
			<td><input type="text" value="{{$last_table->total_cash ?? ''}}"  name="totalofcash" id=""></td>
		</tr>
	</tbody>
</table>

</div>

<input type="submit">
</form>
              </div>

              <div class="lastsection">
              
              </div>

            </div>
        </div>

        <div class="dashboardmainsidebar">
            <div class="dashboardmainsidebarlogo">
                <figure>
                    <img src="../Assets/images/Thinking.png" style="padding: 10px;" alt="" width="85px">
                </figure>
            </div>
        

            <div class="dashboardmainsidebarnavigations">
            <a href=""><button id="activebutton"><img src="{{asset('Assets/images/dashboard assets/dashboard (1).svg')}}" width="30px" alt="" srcset=""></button></a>
            <a href=""><button><img src="{{asset('Assets/images/dashboard assets/user.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('Assets/images/dashboard assets/wallet.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('Assets/images/dashboard assets/Icons.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('Assets/images/dashboard assets/supermarket.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('Assets/images/dashboard assets/add.svg')}}" width="30px" alt="" srcset=""></button></a>
            <a href="/logout"><button>Logout</button></a>
        </div>

        <div class="dashboardmainsidebarquestion">
            <div><i class="far fa-question-circle" style="font-size: 30px;color: white;"></i></div>
        </div>
       
    </div>
    </div>
</body>
</html>