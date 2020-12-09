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
    }
    #specialmaindashboard .card{
        margin:10px;
    }
    </style>
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
            <div class="mainofdashboardmaincontent" id="specialmaindashboard" style="direction:rtl">

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
              @endphp <br>

              <!---->

              <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تفحص كل الشركات </h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها الويب ماستر لرؤية الشركات و تفعيلها</p>
                     <a href="/dashboard/companies" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب الويب ماستر 
            </div>
        </div>


        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل شركة </h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها الويب ماستر لتسجيل الشركات </p>
                     <a href="/register/companies" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
             خاص ب الويب ماستر 
            </div>
        </div>


        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تفحص كل الفروع </h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لرؤية الفروع و المحلات التابعة لها</p>
                     <a href="/dashboard/annexes" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>


        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تغيير ثمن البنزين</h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لتغيير ثمن البنزين</p>
                     <a href="/fuelprices" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل مندوب</h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لتسجيل مندوب</p>
                     <a href="/register/delegate" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>


        <!---->

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل موظف</h5>
                     <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لتسجيل موظف</p>
                     <a href="/register/employee" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>


        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل فرع</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لتسجيل فرع</p>
                     <a href="/register/annex" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>


        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل مورد</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الشركة المفعلة لتسجيل مورد</p>
                     <a href="/register/suppliers" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الشركة المفعلة 
            </div>
        </div>

        <!---->

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل ايجار محل</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لتسجيل ايجار محل</p>
                     <a href="/register/rent/shops" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل محل</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لتسجيل محل</p>
                     <a href="/register/shop" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">ارسال تقرير</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لارسال تقرير</p>
                     <a href="/sendreport" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل خزان</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لتسجيل خزان</p>
                     <a href="/register/tank" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تسجيل مضخة (طرمبة)</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لتسجيل مضخة</p>
                     <a href="/register/pomp" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">الصيانة</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها مدير الفرع المفعلة لتسجيل كل شيء خاص بلصيانة  </p>
                     <a href="/maintenance" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  الفرع 
            </div>
        </div>

        <!---->

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">اضف دورية</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها قائد فريق الفرع لتسجيل دورية</p>
                     <a href="/register/patrol" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  قائد فريق الفرع 
            </div>
        </div>

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">تفحص الدورية المسجلة</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها قائد فريق الفرع لرؤية دورية</p>
                     <a href="/patrol/show" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب  قائد فريق الفرع 
            </div>
        </div>

        <!---->

        <div class="card text-center" style="max-width:330px;">
                <div class="card-header">
                     
                </div>
             <div class="card-body">
                <h5 class="card-title">اكد دورية</h5>
                <p class="card-text">هذه الصفحة يلجئ اليها المندوب الخاص بلشركة لتاكيد دورية</p>
                     <a href="/patrol/confirm" class="btn btn-primary">ادخل</a>
             </div>
             <div class="card-footer text-muted">
        خاص ب المندوب   
            </div>
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