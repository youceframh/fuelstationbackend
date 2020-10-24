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
            @if(isset($annex))
        @foreach($annex as $annexinfos)
              <div class="companyinfoscard" style="    display: flex;
    flex-direction: column;
    align-items: center;">
              <div class="persinfosofcomp">
                <span>{{$annexinfos['name']}}<b>الاسم</b></span>
                <span>{{$annexinfos['address']}}<b>العنوان</b></span>
                <span>{{$annexinfos['email']}}<b>الايمايل</b></span>
                <span>{{$annexinfos['country']}}<b>البلد</b></span>
                <span>{{$annexinfos['phone']}}<b>رقم الهاتف</b></span>
                <span>{{$annexinfos['city']}}<b>المدينة</b></span>
                <span>{{$annexinfos['rent type']}}<b>نوع الايجار</b></span>
                <span>{{$annexinfos['rent start date']}}<b>تاريخ بدء الايجار</b></span>
                <span>{{$annexinfos['rent end date']}}<b>تاريخ انتهاء الايجار</b></span>
                </div>

                <div class="buttonsofvalidatio">
                
             <form action="/dashboard/annexes/{{$annexinfos['idannexes']}}" method="post">
             @csrf
                <button type="submit" name="type" value="remove" class="btn btn-danger btn2" type="submit" style="">نزع المحل</button>
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