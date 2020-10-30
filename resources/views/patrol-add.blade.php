<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
    <script src="../Assets/js/jquery.min.js"></script>
    <script src="../Assets/js/popper.min.js"></script>
    <script src="../Assets/js/bootstrap.min.js"></script>
    <link  rel="stylesheet" href="../Assets/css/style.css"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
    ::placeholder{
        color:black;
        opacity: 60%;
    }</style>
</head>
<body>
    <div class="dashboardmain">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent">
               <div class="one">
               </div>
               <div class="two">
                   <h1 style="color:#308CBA;">الدوريات</h1>
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
        <tr>
        <td>بنزين 91</td>
        <td>1.47</td>
        </tr>
        <tr>
        <td>ديزل</td>
        <td>0.52</td>
        </tr>
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
</tbody>
</table>
              </div>

              <div class="middlesection">
              <form action="/patrol" method="POST" style="display: flex;
    flex-direction: column;
    align-items: flex-end;">
              @csrf
              <h1>ديزل</h1>
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
<td>{{$data->last_record}}</td>
@endforeach
<td><input type="text" name="lasttotal"></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($gas_pomps as $data)
<td><input type="text" name="g{{$data->pomp_serial}}"></td>
@endforeach
<td><input type="text" name="newtotal"></td>
</tr>



</tbody>
</table>

<h1>بنزين</h1>
              <table border="1" style="
    direction: rtl;
">
<tbody>
<tr>
<td>رقم الطرمبة</td>

@foreach($es_pomps as $es_pomp)
<td>{{$es_pomp->pomp_serial}}</td>
@endforeach
<td>الاجمالي</td>
</tr>
<tr>

<td>اخر تسجيل</td>
@foreach($es_pomps as $es_pomp)
<td>{{$es_pomp->last_record}}</td>
@endforeach
<td><input type="text" name="lasttotal"></td>
</tr>
<tr>
<td>التسجيل الجديد</td>
@foreach($es_pomps as $es_pomp)
<td><input type="text" name="e{{$es_pomp->pomp_serial}}"></td>
@endforeach
<td><input type="text" name="newtotal"></td>
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
		<tr>
			<td>مبيعات essence 91</td>
			<td><input type="text" name="quantityofessence91" id=""></td>
			<td><input type="text" name="totalpriceofessence91" id=""></td>
		</tr>
        <tr>
			<td>مبيعات essence 95</td>
			<td><input type="text" name="quantityofessence95" id=""></td>
			<td><input type="text" name="totalpriceofessence95" id=""></td>
		</tr>
        <tr>
			<td>مبيعات diesel</td>
			<td><input type="text" name="quantityofdiesel" id=""></td>
			<td><input type="text" name="totalpriceofdiesel" id=""></td>
		</tr>
		<tr>
			<td>مبيعات gasoline</td>
			<td><input type="text" name="quantityofgasoline" id=""></td>
			<td><input type="text" name="totalpriceofgasoline" id=""></td>
		</tr>
		<tr>
			<td>ATM</td>
			<td><input type="text" name="ATM" id=""></td>
		</tr>
		<tr>
			<td>اجل</td>
			<td><input type="text" name="retard" id=""></td>
		</tr>
		<tr>
			<td colspan="2"> اجمالي الكاش</td>
			<td><input type="text" name="totalofcash" id=""></td>
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
			<td><input type="text" name="impotance"></td>
			<td><textarea name="notes"></textarea></td>
			<td><input type="text" name="nettotal"></td>
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
            <a href=""><button id="activebutton"><img src="../Assets/images/dashboard assets/dashboard (1).svg" width="30px" alt="" srcset=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/user.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/wallet.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/Icons.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/supermarket.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/add.svg" width="30px" alt="" srcset=""></button></a>
            <a href="/logout"><button>Logout</button></a>
        </div>

        <div class="dashboardmainsidebarquestion">
            <div><i class="far fa-question-circle" style="font-size: 30px;color: white;"></i></div>
        </div>
    </div>
    </div>
</body>
</html>