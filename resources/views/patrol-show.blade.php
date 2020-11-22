<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/Assets/css/bootstrap.min.css')}}">
    <script src="{{asset('/Assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/Assets/js/popper.min.js')}}"></script>
    <script src="{{asset('/Assets/js/bootstrap.min.js')}}"></script>
    <link  rel="stylesheet" href="{{asset('/Assets/css/style.css')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
    ::placeholder{
        color:black;
        opacity: 60%;
    }
    @media print{

        .dashboardmain {
     display: block; 
    }
    .dashboardmaincontent {
    display: block;
    position:unset;
    overflow-y:unset;
}
        .dashboardmainsidebar{
            display:none;
        }
        .headerofdashboardmaincontent{
            display:none;
        }
      
    }
    @page {
            page-break-after: always;
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
              <div class="uppersection" style="    display: flex;
    flex-direction: row-reverse;
    width: 100%;
    justify-content: space-around;">

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
              <div style="display:flex;flex-direction:column;">
              @if(isset($id))
              @if(DB::table('daily')->where('iddaily',$id)->first())
              @php $daily_code = DB::table('daily')->where('iddaily',$id)->first()->code; @endphp
              {!! QrCode::size(250)->generate($daily_code) !!}
              {{$daily_code}}
               @endif
               @else

              @if(DB::table('daily')->where('timing',date('Y-m-d'))->first())
              @php $daily_code = DB::table('daily')->where('timing',date('Y-m-d'))->first()->code; @endphp
              {!! QrCode::size(250)->generate($daily_code) !!}
              {{$daily_code}}
              @elseif(DB::table('daily')->where('timing',date("Y-m-d", time() - 60 * 60 * 24))->first())
              @php $daily_code = DB::table('daily')->where('timing',date("Y-m-d", time() - 60 * 60 * 24))->first()->code; @endphp
               {!! QrCode::size(250)->generate($daily_code) !!}
               
               @endif
               @endif
               </div>
              <div class="left">
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
<td>{{$saver_name}}</td>
<td>اسم المسجل</td>
</tr>
<tr>
<td>{{$daily_code}}</td>
<td>رقم الدورية</td>
</tr>
</tbody>
</table>
              </div>

              </div>

              <div class="middlesection">
              <form action="/patrol" method="POST" style="display: flex;
    flex-direction: column;
    align-items: flex-end;">
              @csrf
@php
$diesel_last_record_count = 0;
$gas_last_record_count =0;
$essence91_last_record_count =0;
$essence95_last_record_count =0;

$diesel_new_record_count = 0;
$gas_new_record_count =0;
$essence91_new_record_count =0;
$essence95_new_record_count =0;

$diesel_liter_record_count = 0;
$gas_liter_record_count =0;
$essence91_liter_record_count =0;
$essence95_liter_record_count =0;

$diesel_price;
$gas_price;
$es91_price;
$es95_price;

@endphp
@if(count($diesel_pomps) > 0)
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
<td>الاجمالي</td>
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($diesel_pomps as $data)
<td>{{($data->new_record - $data->diffrenece_in_l)}}</td>

@php
$diesel_last_record_count += $data->new_record - $data->diffrenece_in_l;
$diesel_new_record_count += $data->new_record;
$diesel_liter_record_count += $data->diffrenece_in_l;
$diesel_price = $data->price_of_fuel;
@endphp
@endforeach
<td><input type="text" value="{{$diesel_last_record_count}}" name="dlasttotal" disabled></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($diesel_pomps as $data)
<td><input type="text" value="{{$data->new_record}}" disabled></td>


@endforeach
<td><input type="text" value="{{$diesel_new_record_count}}" name="dnewtotal" disabled></td>
</tr>
<td>لتر</td>
@foreach($diesel_pomps as $data)
<td><input type="text" value="{{$data->diffrenece_in_l}}" disabled></td>
@endforeach
<td><input type="text" value="{{$diesel_liter_record_count}}" name="ldnewtotal" disabled></td>
</tr>


</tbody>
</table>

@endif
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
<td>الاجمالي</td>
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($gas_pomps as $data)
<td>{{($data->new_record - $data->diffrenece_in_l)}}</td>

@php
$gas_last_record_count += $data->new_record - $data->diffrenece_in_l;
$gas_new_record_count += $data->new_record;
$gas_liter_record_count += $data->diffrenece_in_l;
$gas_price = $data->price_of_fuel;
@endphp
@endforeach
<td><input type="text" value="{{$gas_last_record_count}}" disabled name="lasttotal"></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($gas_pomps as $data)
<td><input type="text" value="{{$data->new_record}}" disabled></td>
@endforeach
<td><input type="text" value="{{$gas_new_record_count}}" disabled name="newtotal"></td>
</tr>
<td>لتر</td>
@foreach($gas_pomps as $data)
<td><input type="text" value="{{$data->diffrenece_in_l}}" disabled></td>
@endforeach
<td><input type="text" value="{{$gas_liter_record_count}}" name="ldnewtotal" disabled></td>
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

@php
$essence91_last_record_count += ($es_pomp->new_record - $es_pomp->diffrenece_in_l);
$essence91_new_record_count += $es_pomp->new_record;
$essence91_liter_record_count += $es_pomp->diffrenece_in_l;
$es91_price = $es_pomp->price_of_fuel;
@endphp

@endforeach
<td>الاجمالي</td>
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($es91_pomps as $es_pomp)
<td>{{($es_pomp->new_record - $es_pomp->diffrenece_in_l)}}</td>
@endforeach
<td><input type="text" value="{{$essence91_last_record_count}}" disabled name="es91lasttotales"></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($es91_pomps as $es_pomp)
<td><input type="text" value="{{$es_pomp->new_record}}" disabled></td>
@endforeach
<td><input type="text" value="{{$essence91_new_record_count}}" disabled name="es91newtotales"></td>
</tr>
<td>لتر</td>
@foreach($es91_pomps as $data)
<td><input type="text" value="{{$data->diffrenece_in_l}}" disabled></td>
@endforeach
<td><input type="text" value="{{$essence91_liter_record_count}}" name="ldnewtotal" disabled></td>
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
<td>الاجمالي</td>
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($es95_pomps as $es_pomp)
<td>{{($es_pomp->new_record - $es_pomp->diffrenece_in_l)}}</td>

@php
$essence95_last_record_count += ($es_pomp->new_record - $es_pomp->diffrenece_in_l);
$essence95_new_record_count += $es_pomp->new_record;
$essence95_liter_record_count += $es_pomp->diffrenece_in_l;
$es95_price = $es_pomp->price_of_fuel;
@endphp
@endforeach
<td><input type="text" value="{{$essence95_last_record_count}}" disabled name="es95lasttotales"></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($es95_pomps as $es_pomp)
<td><input type="text" value="{{$es_pomp->new_record}}" disabled></td>
@endforeach
<td><input type="text"  value="{{$essence95_new_record_count}}" disabled name="es95newtotales"></td>
</tr>
<td>لتر</td>
@foreach($es95_pomps as $data)
<td><input type="text" value="{{$data->diffrenece_in_l}}" disabled></td>
@endforeach
<td><input type="text" value="{{$essence95_liter_record_count}}" name="ldnewtotal" disabled></td>
</tr>

</tbody>
</table>




<br><br>
<div style="    display: flex;
    flex-direction: row-reverse;">
<table border="1px" style="direction:rtl;">
	<tbody>
		<tr>
            <td>الصنف</td>
			<td>الكمية</td>
			<td>المبلغ</td>
		</tr>

        @if(count($es91_pomps) > 0)
		<tr>
			<td>مبيعات essence 91</td>
			<td><input type="text" value="{{$essence91_liter_record_count}}" disabled name="quantityofessence91" id=""></td>
			<td><input type="text" value="{{$essence91_liter_record_count*$es91_price}}" disabled name="totalpriceofessence91" id=""></td>
		</tr>
        @endif

        @if(count($es95_pomps) > 0)
        <tr>
			<td>مبيعات essence 95</td>
			<td><input type="text" value="{{$essence95_liter_record_count}}" disabled name="quantityofessence95" id=""></td>
			<td><input type="text" value="{{$essence95_liter_record_count*$es95_price}}" disabled name="totalpriceofessence95" id=""></td>
		</tr>
        @endif

        @if(count($diesel_pomps) > 0)
        <tr>
			<td>مبيعات diesel</td>
			<td><input type="text" value="{{$diesel_liter_record_count}}" disabled name="quantityofdiesel" id=""></td>
			<td><input type="text" value="{{$diesel_liter_record_count*$diesel_price}}" disabled name="totalpriceofdiesel" id=""></td>
		</tr>
        @endif

        @if(count($gas_pomps) > 0)
		<tr>
			<td>مبيعات gasoline</td>
			<td><input type="text" value="{{$gas_liter_record_count}}" disabled name="quantityofgasoline" id=""></td>
			<td><input type="text" value="{{$gas_liter_record_count*$gas_price}}" disabled name="totalpriceofgasoline" id=""></td>
		</tr>
        @endif
        
		<tr>
			<td>ATM</td>
			<td><input type="text" value="{{$last_table->atm}}" disabled name="atm" id=""></td>
		</tr>
		<tr>
			<td>اجل</td>
			<td><input type="text" value="{{$last_table->retard}}" disabled name="retard" id=""></td>
		</tr>
		<tr>
			<td colspan="2"> اجمالي الكاش</td>
			<td><input type="text" value="{{$last_table->total_cash}}" disabled name="totalofcash" id=""></td>
		</tr>
	</tbody>
</table>

<table border="1px" style="align-self: flex-end;direction:rtl;">
	<tbody>
		<tr>
			<td>العجز</td>
			<td> نوعه</td>
			<td colspan="2">الاجمالي</td>
		</tr>
		<tr>
			<td><input type="text" name="impotance" value="{{$last_table->impotence}}" disabled></td>
			<td><textarea name="notes"  value="" disabled>{{$last_table->notes}}</textarea></td>
			<td><input type="text"  value="{{$last_table->total}}" disabled name="nettotal"></td>
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
                    <img src="../Assets/images/Thinking.png')}}" style="padding: 10px;" alt="" width="85px">
                </figure>
            </div>
        

            <div class="dashboardmainsidebarnavigations">
            <a href=""><button id="activebutton"><img src="{{asset('/Assets/images/dashboard assets/dashboard (1).svg')}}" width="30px" alt="" srcset=""></button></a>
            <a href=""><button><img src="{{asset('/Assets/images/dashboard assets/user.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('/Assets/images/dashboard assets/wallet.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('/Assets/images/dashboard assets/Icons.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('/Assets/images/dashboard assets/supermarket.svg')}}" width="30px" alt=""></button></a>
            <a href=""><button><img src="{{asset('/Assets/images/dashboard assets/add.svg')}}" width="30px" alt="" srcset=""></button></a>
            <a href="/logout"><button>Logout</button></a>
        </div>

        <div class="dashboardmainsidebarquestion">
            <div><i class="far fa-question-circle" style="font-size: 30px;color: white;"></i></div>
        </div>
    </div>
    </div>
</body>
</html>