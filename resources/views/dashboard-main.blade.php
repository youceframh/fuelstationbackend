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
                <input type="text" placeholder="ابحث" >
                <i class="fas fa-search" style="align-self: center;position: absolute;right: 2%;"></i>   
               </div>
               <div class="two">
                   <h1 style="color:#308CBA;">لوحة القيادة</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent">
              @php
              if(Auth::user()->typeofuser == 'delegate'){
                  if(count(DB::table('daily')->where('confirmed',0)->get()) != 0){
                    $get_unconfirmed_patrols = count(DB::table('daily')->where('confirmed',0)->get());
                    @endphp
                    <div class="alert alert-info" role="alert">
         لديك {{$get_unconfirmed_patrols}} دوريات لم تقم بتاكيدها 
         <a href="/patrol/confirm">اكدها من هنا</a>
                        </div>
                    @php
                  }else{
                   @endphp <div class="alert alert-success" role="alert">
       كل شيء مؤكد
                        </div>
                        @php
                  }
              }
              @endphp
              <ul>
              <li><a href="/dashboard/companies"> تفحص كل الشركات {الويب ماستر}</a></li>
               <li><a href="/dashboard/annexes"> تفحص كل الفروع { الشركة المفعلة}</a></li>
                  <li><a href="/register/companies">تسجيل شركة {الويب ماستر}</a></li>
                  <li><a href="/register/employee">تسجيل موظف { الشركة المفعلة}</a></li>
                  <li><a href="/register/annex">تسجيل فرع { الشركة المفعلة}</a></li>
                  <li><a href="/register/suppliers">تسجيل مورد {الشركة المفعلة}</a></li>
                  <li><a href="/register/shop">تسجيل محل { الفرع}</a></li>
                  <li><a href="/register/rent/shops">تسجيل  كراء محل { الشركة المفعلة}</a></li>
                  <li><a href="/sendreport">{الفرع}ارسال تقرير</a></li>
                  <li><a href="/register/tank">{الفرع}تسجيل خزان </a></li>
                  <li><a href="/register/pomp">{الفرع}تسجيل مضخة </a></li>
                  <li><a href="/register/delegate">{الشركة}تسجيل مندوب </a></li>
                  <li><a href="/maintenance">{الفرع}الصيانة</a></li>
                  <li><a href="/patrol/add">اضافة دورية{قائد فريق الفرع}</a></li>
                  <li><a href="/patrol/show">روية دورية{قائد فريق الفرع}</a></li>
                  <li><a href="/patrol/confirm">تاكيد دورية {المندوب}</a></li>
                  <li><a href="/fuelprices">تغيير ثمن البنزين {الشركة}</a></li>
              </ul>
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