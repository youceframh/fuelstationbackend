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
    ::placeholder{
        color:black;
        opacity: 60%;
    }
    .persinfosofcomp{
        display:flex;
        flex-direction:column;
        text-align:right;
        border:1px solid black;
        padding:10px;
        font-size:25px;
        border-radius:20px;
        margin:10px;
    }
    .btn2{
        border-radius:20px;
    }
    .persinfosofcomp span b:before{
        content:':';
    }
    .persinfosofcomp span b{
        margin-left: 12px;
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
            <div class="mainofdashboardmaincontent">
            @if(isset($company))
        @foreach($company as $companyinfos)
              <div class="companyinfoscard">
              <div class="persinfosofcomp">
                <span>{{$companyinfos['commercial name']}}<b>الاسم التجاري</b></span>
                <span>{{$companyinfos['email']}}<b>الايمايل</b></span>
                <span>{{$companyinfos['first name']}}<b>الاسم</b></span>
                <span>{{$companyinfos['last name']}}<b>اللقب</b></span>
                <span>{{$companyinfos['phone']}}<b>رقم الهاتف</b></span>
                <span>{{$companyinfos['country']}}<b>البلد</b></span>
                <span>{{$companyinfos['city']}}<b>المدينة</b></span>
                <span>{{$companyinfos['commercial number']}}<b>الرقم التجاري</b></span>
                <span>{{$companyinfos['tax number']}}<b>الرقم الضريبي</b></span>
                </div>

                <div class="buttonsofvalidatio">
                
             <form action="/dashboard/companies/{{$companyinfos['idcompanies']}}" method="post">
             @csrf
                <button type="submit" name="type" value="accept" class="btn btn-success btn2" type="submit" style="">قبول ملفات التعريف</button>
                <button type="submit" name="type" value="decline" class="btn btn-danger btn2" type="submit" style="">رفض ملفات التعريف</button>
                   <button type="submit" name="type" value="download" class="btn btn-info btn2" type="submit" style="">نحميل ملفات تعريف الشركة</button>
                   </form>
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