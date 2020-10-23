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
    .companiescard{
        border: 1px solid rgba(0,0,0,0.2);
        border-radius: 13px;
        display: flex;
        flex-direction: column;
        align-items: center;
        width:275px;
        margin:20px;
    }
    .companiescard > div{
        font-size:20px;
        width:100%;
        align-self:center;
        text-align:center;
        padding:6px;
    }

    .companiescard div a{
        font-size:20px;
        width:100%;
    }

    .companiescard .sectone{
        font-size:24px;
        font-weight:600;
    }

    .companiescard .secttwo{

    }

    .companiescard .sectthree{
        background-color:rgba(0,0,0,0.1);
        padding:15px;
    }

    </style>
</head>
<body>
    <div class="dashboardmain">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent">
            <form action="/dashboard/companies" method="GET" style="width:80%;">
               <div class="one">
                <input type="text" placeholder="ابحث" style="padding: 10px 2rem 10px 5rem;text-align:right;" name="searchquery">
                <i class="fas fa-search" style="align-self: center;position: absolute;right: 10px;"></i>   
                <button type="submit" style="    position: absolute;
    align-self: center;
    left: 1rem;">ابحث</button>
               </div>
               </form>
               <div class="two">
                   <h1 style="color:#308CBA;">لوحة القيادة</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent">
@if(isset($companies))
        @foreach($companies as $company)
              <div class="companiescard">

              <div class="sectone">{{$company['commercial name']}}</div>
              @php
              $comp_email = $company['email'];
              $get_company_id_in_users = DB::table('users')->where('email',$comp_email)->first()->id;
              $get_annexes_rownbr = count(DB::table('annexes')->where('companies_id',$get_company_id_in_users)->get());
              @endphp
              <div class="secttwo">{{$get_annexes_rownbr}} عدد الفروع</div>
              <div class="undersecttwo">
              @if($company['verified'] == 1)
              <div class="alert alert-success" role="alert">
            الحساب فعال
                        </div>
            @elseif($company['verified'] == 2)
            <div class="alert alert-info" role="alert">
في انتظار التفعيل                    
    </div>

            @elseif($company['verified'] == 3)
            <div class="alert alert-danger" role="alert">
في انظار الشركة لاعادة ارسال الملفات                 
    </div>
            @elseif($company['verified'] == 0)
            <div class="alert alert-danger" role="alert">
لم يتم ارسال اي ملف من طرف الشركة
    </div>
            @endif
              </div>
             
              <div class="sectthree">
              <a type="button" href="/dashboard/companies/{{$company['idcompanies']}}" class="btn btn-info">المزيد من المعلومات</a>
              </div>

              </div>
    @endforeach
    @endif
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