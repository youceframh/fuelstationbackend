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
    }</style>
</head>
<body>
    <div class="dashboardmain">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent">
               <div class="one">
               @if(Auth::user()->typeofuser == 'delegate')
               <form action="/patrol/confirm" method="GET" style="width:80%;">
               @elseif (Auth::user()->typeofuser == 'annex')
               <form action="/patrols/all" method="GET" style="width:80%;">
               @elseif (Auth::user()->typeofuser == 'superuser')
               <form action="/dashboard/companies/{{$comp_id}}/annexes/{{$an_id}}/patrols/all" method="GET" style="width:80%;">
               @endif
               <div class="one">
                <input type="text" placeholder="ابحث" style="padding: 10px 2rem 10px 5rem;text-align:right;" name="searchquery">
                <i class="fas fa-search" style="align-self: center;position: absolute;right: 10px;"></i>   
                <button type="submit" style="    position: absolute;
    align-self: center;
    left: 1rem;">ابحث</button>
               </div>
               </form>
               </div>
               <div class="two">
                   <h1 style="color:#308CBA;">لوحة القيادة</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent" style="flex-direction: column;">
               

                <div class="mainofdashboardmaincontentsect2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead style="background-color: white;">
                                <tr>
                                    <th scope="col">
                                        <img src="../Assets/images/dashboard assets/arrows.png" alt="">
                                    </th>
                                  <th scope="col">الحالة</th>
                                  <th scope="col">التوقيت</th>
                                  <th scope="col">الرقم الخاص بليومية الخاصة بلدورية</th>
                                </tr>
                              </thead>
                              <tbody>
                              @if(isset($patrols))
                                @foreach($patrols as $patrol)
                                <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                  <td style="color: green;">
                                  @if(Auth::user()->typeofuser == 'delegate')
                                  <a href="/patrol/confirm?patrol={{$patrol->iddaily}}">فعل الدورية</a> |
                                  <a href="/patrol/confirm/{{$patrol->iddaily}}">المزيد من المعلومات</a>
                                  @elseif (Auth::user()->typeofuser == 'annex')
                                  <a href="/patrols/all?patrol={{$patrol->code}}">عدل الدورية</a> |
                                  <a href="/patrols/all?patrol={{$patrol->code}}">المزيد من المعلومات</a>
                                  @elseif (Auth::user()->typeofuser == 'superuser')
                                  <a href="/dashboard/companies/{{$comp_id}}/annexes/{{$an_id}}/patrols/all?patrol={{$patrol->code}}">عدل الدورية</a> |
                                  <a href="/dashboard/companies/{{$comp_id}}/annexes/{{$an_id}}/patrols/all?patrol={{$patrol->code}}">المزيد من المعلومات</a>
                                  @endif
                                  </td>
                                  <td>@php  if($patrol->confirmed == 0){ @endphp <span style="color:red;"> غير مفعل </span> @php }elseif($patrol->confirmed == 1){ @endphp <span style="color:green;"> مفعل @php } @endphp</span></td>
                                  <td>{{$patrol->timing}}</td>
                                  <td>{{$patrol->code}}</td>
                                </tr>
                                @endforeach
                                @endif
                              </tbody>
                        </table>
                      </div>
                </div>

                <div class="mainofdashboardmaincontentsect3">
                    <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;width: 25px;"><a href="" style="color: white;">1</a></button>
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