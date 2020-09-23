<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/Assets/css/bootstrap.min.css')}}">
    <script src="{{asset('Assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('/Assets/js/popper.min.js')}}"></script>
    <script src="{{asset('/Assets/js/bootstrap.min.js')}}"></script>
    <link  rel="stylesheet" href="{{asset('../Assets/css/style.css')}}"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <style>
        *{
            margin:0;
            padding:0;
        }
    </style>
</head>

<body>
    
    <div id="Signup">

        <div class="SignupSidebar">

            <div class="SignupSidebarHeader">
                <div class="SignupSidebarHeaderLeft">
                    <a href=""><i class="far fa-arrow-alt-circle-left" style="font-size: 50px;color: white;line-height: normal;"></i></a>
                </div>

                <div class="SignupSidebarHeaderCenter">
                    <span>Fuelstation</span>
                </div>
            </div>

            <div class="SignupSidebarContent">
                <span>لديك حساب؟ سجل دخولك الان</span>
                <a href="/login"><button type="button" class="btn btn-light" style="border-radius:75px;font-size: 25px;width: 200px;">تسجيل الدخول</button></a>
            </div> 

            <div class="SignupSidebarFooter">
                <a href="">عنوان</a>
                <a href="">عنوان</a>
                <a href="">عنوان</a>
            </div>
        
        </div>

        <div class="SignupContent">
            <div class="SignupContentHeader">
                <div class="SignupContentHeaderLeft">
                    <a href=""><i class="far fa-arrow-alt-circle-left" style="font-size: 50px;color: #308CBA;line-height: normal;"></i></a>
                </div>

                <div class="SignupContentHeaderCenter">
                    <span>Fuelstation</span>
                </div>
            </div>
            <div class="SignupContentSignup">
                <span style="color:#308CBA;font-size:48px ;">انشاء حساب</span>
                @if ($errors->any())
            <div class="alert alert-danger" style="direction: rtl;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

                <div>
                    <form action="/register" method="POST" style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                        <input type="text" placeholder="الاسم الكامل" name="fullname" id="fullname" onkeyup="verifyname()">
                        <input type="email" placeholder="الايمايل" name="email" id="email" onkeyup="verifyemail()">
                        <input type="password" placeholder="كلمة المرور" name="password" id="password" onkeyup="verifypassword()">
                        <input type="password" placeholder=" اعد كلمة المرور" name="passwordverify" id="passwordv" onkeyup="verifypasswordv()" >
                        <div style="display: flex;flex-direction: center;justify-content: space-between;align-self: center;margin: 0px 20px 0px 20px;padding: 0px 10px 10px 10px">
                            <div>
                                <a href="">لديك حساب؟ سجل الدخول</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-light" type="submit" style="background-color:#308CBA;width: 200px;border-radius: 75px;color: white;">انشاء حساب</button>
                        @csrf
                    </form>
                </div>

            </div>


            <div class="SignupContentFooter">
                <span>أو سجل دخولك عبر حسابك على</span>
                <div style="display: flex;justify-content: center;">
                <button type="button" class="btn btn-primary" style="background-color:#308CBA;width: 45px;border-radius: 75px;margin:10px;"><i class="fab fa-facebook-f" style="color:white;"></i></button>
                <button type="button" class="btn btn-primary" style="background-color:#308CBA;width: 45px;border-radius: 75px;margin:10px;"><i class="far fa-envelope" style="color:white;"></i></button>
                <button type="button" class="btn btn-primary" style="background-color:#308CBA;width: 45px;border-radius: 75px;margin:10px;"><i class="fab fa-twitter" style="color:white;"></i></button>
                </div>
            </div>

        </div>

    </div>

@if ($errors->has('fullname'))
    <script>
        document.getElementById('fullname').style.borderRight = "12px solid red"
    </script>
@endif
@if ($errors->has('email'))
    <script>
        document.getElementById('email').style.borderRight = "12px solid red"
    </script>
@endif
@if ($errors->has('password'))
    <script>
        document.getElementById('password').style.borderRight = "12px solid red"
    </script>
@endif
@if ($errors->has('passwordverify'))
    <script>
        document.getElementById('passwordv').style.borderRight = "12px solid red"
    </script>
@endif

<script>
    function verifyemail(){
        var email = document.getElementById('email').value; 
        var pattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;

        if(email.match(pattern)){
            document.getElementById('email').style.borderRight = "12px solid #308CBA"
  
        }else{
            document.getElementById('email').style.borderRight = "12px solid red"
    
        }
    }

    function verifypassword(){
        var password = document.getElementById('password').value;
        var pattern = /^[0-9a-zA-Z]{8,}$/;

        if(password.match(pattern)){
            document.getElementById('password').style.borderRight = "12px solid #308CBA"
  
        }else{
            document.getElementById('password').style.borderRight = "12px solid red"
    
        }
    }

    function verifypasswordv(){
        var password = document.getElementById('password').value;
        var passwordv = document.getElementById('passwordv').value;

        if(passwordv == password){
            document.getElementById('passwordv').style.borderRight = "12px solid #308CBA"
  
        }else{
            document.getElementById('passwordv').style.borderRight = "12px solid red"
    
        }
    }

    function verifyname(){
        var fullname = document.getElementById('fullname').value;
        var pattern = /^[a-zA-Z]{4,}$/;

        if(fullname.match(pattern)){
            document.getElementById('fullname').style.borderRight = "12px solid #308CBA"
  
        }else{
            document.getElementById('fullname').style.borderRight = "12px solid red"
    
        }
    }
</script>
</body>
</html>