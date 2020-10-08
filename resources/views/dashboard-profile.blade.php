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
    .invalid-feedback {
    display: block;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #dc3545;
    text-align: center;
}
    </style>
</head>
<body>
    <div class="dashboardmain">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent" style="justify-content: center;">
               <div class="two">
                   <h1 style="color:#308CBA;">الحساب الشخصي</h1>
                   @if(isset($success))
                    <div class="alert alert-success" role="alert">
  {{$success}}
</div>
@endif
@if(isset($failed))
                    <div class="alert alert-danger" role="alert">
  {{$failed}}
</div>
                    @endif
               </div>
            </div>
            <div class="mainofdashboardmaincontent" >

              <div class="mainofcontentuserinfos">
                <div class="mainofcontentuserprofile" >

                    <div class="one">
                        <div class="usernameandimg">
                            <img src="../Assets/images/userimg.svg" alt="" width="150px">
                            <h2 style="color: #308CBA;">{{Auth::user()->name }}</h2>
                        </div>
                    </div>
  
                    <div class="two">
                      <button type="button"  class="btn" type="submit" style="background-color:transparent;color: white;border: 0px; width: auto;text-align: center; "><i class="far fa-edit" style="color:#308cba;font-size: 35px;"></i></button>
                    </div>
  
                </div>
                <div class="inputsofuserprofile">
                {{ Form::open( array('url' => '/dashboard/profile','method' => 'post')) }}

                        <div class="first">

                        <div class="inputype2container">
                            <input type="text" placeholder="الايمايل" name="email" class="form-control @error('email') @enderror" value="{{Auth::user()->email }}">
                            <i class="far fa-envelope"></i>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل" name="name" class="form-control @error('name') @enderror" value="{{Auth::user()->name }}">
                            <i class="fas fa-user"></i>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="inputype2container">
                            <input type="text" placeholder="رقم الهاتف" name="phone" class="form-control @error('phone') @enderror" value="{{Auth::user()->phone }}">
                            <i class="fas fa-mobile-alt"></i>
                            @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        </div>
                        <h3 style="padding: 50px;
    text-align-last: end;width: 96%;"> <u>تغيير كلمة المرور</u></h3>
   
                        <div class="second">
                       
                        <div class="inputype2containerspecial">
                            <div>
                        <input type="password" placeholder="كلمة المرور الجديدة" name="newpassword" class="@error('newpassword') not-valid @enderror">
                            <i class="fas fa-lock"></i>
                            </div>
                            <div>
                            @error('newpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>
                        

                        <div class="inputype2containerspecial">

                            <div>
                            <input type="password" placeholder="كلمة المرور الحالية" name="oldpassword" class="@error('oldpassword') not-valid @enderror">
                            <i class="fas fa-lock-open"></i>
                            </div>

                            <div>
                            @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>
                        
                        <div class="inputype2containerspecial">
                        <div>
                            <input type="password" placeholder="اعد كتابة كلمة المرور الجديدة" name="password_confirmation" class="@error('password_confirmation') not-valid @enderror">
                            <i class="fas fa-lock"></i>
                            </div>

                            <div>
                            @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                        </div>
                      
                        </div>
                        <div class="submitformofuserinfos">
                            <button type="submit" class="btn btn-secondary" style="border-radius: 20px 0px 0px 20px;" >الغاء</button>
                            <button type="submit" class="btn btn-primary" style="border-radius: 0px 20px 20px 0px;"  >حفظ</button>
                        </div>
                        {{ Form::close() }}

                    
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
            <a href=""><button><img src="../Assets/images/dashboard assets/dashboard (1).svg" width="30px" alt="" srcset=""></button></a>
            <a href=""><button id="activebutton"><img src="../Assets/images/dashboard assets/user.svg" width="30px" alt=""></button></a>
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