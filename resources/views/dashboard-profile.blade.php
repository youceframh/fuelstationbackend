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
            <div class="headerofdashboardmaincontent" style="justify-content: center;">
               <div class="two">
                   <h1 style="color:#308CBA;">الحساب الشخصي</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent" >

              <div class="mainofcontentuserinfos">
                <div class="mainofcontentuserprofile" >

                    <div class="one">
                        <div class="usernameandimg">
                            <img src="../Assets/images/userimg.svg" alt="" width="150px">
                            <h2 style="color: #308CBA;">اسم الحساب</h2>
                        </div>
                    </div>
  
                    <div class="two">
                      <button type="button"  class="btn" type="submit" style="background-color:transparent;color: white;border: 0px; width: auto;text-align: center; "><i class="far fa-edit" style="color:#308cba;font-size: 35px;"></i></button>
                    </div>
  
                </div>
                <div class="inputsofuserprofile">
                    <form action="">

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        
                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-briefcase"></i>
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-user"></i>
                        </div>

                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-birthday-cake"></i>
                        </div>
                        
                        <div class="inputype2container">
                            <input type="text" placeholder="الاسم الكامل">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="submitformofuserinfos">
                            <button type="button" class="btn btn-secondary" style="border-radius: 20px 0px 0px 20px;" >الغاء</button>
                            <button type="button" class="btn btn-primary" style="border-radius: 0px 20px 20px 0px;"  >حفظ</button>
                        </div>
                    </form>

                    
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