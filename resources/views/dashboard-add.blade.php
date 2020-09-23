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
        color:#308CBA;
        opacity: 60%;
    }
    
    </style>
    <script>   
    $(function(){
        $('#uploadfile').click(function(){
            $('#uploadinput').click();
    })
    })
   
    </script>
</head>
<body>
    <div class="dashboardmain">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent" style="justify-content: center;">
               <div class="two">
                   <h1 style="color:#308CBA;">عنوان</h1>   
                 </div>
            </div>
            <div class="mainofdashboardmaincontent">
                <div class="dashboardaddtask">
                    <div class="inputsofuserprofile">
                        <form action="">
    
                            <div class="inputype1container">
                                <input type="text" placeholder="الاسم الكامل">
                            </div>
    
                            <div class="inputype1container">
                                <input type="text" placeholder="الاسم الكامل">
                            </div>
    
                            <div class="inputype1container" style="direction: rtl;">
                                <select name="" id="" style="padding-left: 10px;">
                                    <option value="">عنوان</option>
                                </select>
                            </div>
                            
                            <div class="inputype1container">
                                <input type="text" placeholder="الاسم الكامل">
                            </div>
    
                            <div class="inputype1container">
                                <input type="text" placeholder="الاسم الكامل">
                            </div>
    
                            <div class="inputype1container">
                                <input type="date" placeholder="الاسم الكامل" style="color: #308CBA;">
                            </div>
    
                            <div class="inputype1container">
                                <input type="number" placeholder="الاسم الكامل" style="direction: rtl;">
                            </div>
                            
                            <div class="inputype1container">
                                <input type="text" placeholder="الاسم الكامل">
                            </div>
                            
                            <div class="inputype1container" style="width:100%;">
                                <textarea name="" placeholder="عنوان"></textarea>
                            </div>

                            <div class="checkings">

                                <div class="radiochecking">
                                    <div>
                                        <input type="radio">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>
                                    <div>
                                        <input type="radio">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>
                                    <div>
                                        <input type="radio">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>
                                </div>

                                <div class="checkboxchecking">
                                    <div>
                                        <input type="checkbox">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>

                                    <div>
                                        <input type="checkbox">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>
                                    <div>
                                        <input type="checkbox">
                                        <span style="color: #308CBA; font-size: 30px;">عنوان</span>
                                    </div>
                                </div>

                            </div>
                            <div style="width: 100%;
                            display: flex;
                            flex-direction: column;
                            align-items: center;margin:20px;">

                                <div class="inputsofuserprofilebuttons">

                                    <div class="inputsofuserprofilebuttonsuploadfile">
                                        <input type="file" style="display: none;" id="uploadinput">
                                        <button type="button" class="btn btn-primary" id="uploadfile" >اختر ملف</button>
                                        <span style="color: #308CBA;font-size: 23;">اختر ملفا للرفع</span>
                                    </div>
    
                                    <div class="inputsofuserprofileotherbuttons">
                                        <button type="button" class="btn btn-primary" >اختر ملف</button>
                                        <button type="button" class="btn btn-primary" >اختر ملف</button>
                                        <button type="button" class="btn btn-primary"  >اختر ملف</button>
                                    </div>
                                    
                                </div>
    
    
                                <div class="submitformofuserinfos">
                                    <button type="submit" class="btn btn-secondary" style="border-radius: 20px 0px 0px 20px;" >الغاء</button>
                                    <button type="reset" class="btn btn-primary" style="border-radius: 0px 20px 20px 0px;"  >حفظ</button>
                                </div>
    

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
            <a href=""><button><img src="../Assets/images/dashboard assets/user.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/wallet.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/Icons.svg" width="30px" alt=""></button></a>
            <a href=""><button><img src="../Assets/images/dashboard assets/supermarket.svg" width="30px" alt=""></button></a>
            <a href=""><button id="activebutton"><img src="../Assets/images/dashboard assets/add.svg" width="30px" alt="" srcset=""></button></a>
            <a href="/logout"><button>Logout</button></a>
        </div>

        <div class="dashboardmainsidebarquestion">
            <div><i class="far fa-question-circle" style="font-size: 30px;color: white;"></i></div>
        </div>
    </div>
    </div>
</body>
</html>