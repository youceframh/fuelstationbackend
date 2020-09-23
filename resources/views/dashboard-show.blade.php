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
            <div class="mainofdashboardmaincontent" style="flex-direction: column;">
                <div class="mainofdashboardmaincontentsect1">

                    <div style="display: flex;
                    flex-direction: row-reverse;">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                الفئة
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Action</a>
                              <a class="dropdown-item" href="#">Another action</a>
                              <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                          </div>

                       <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                اليوم
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <input type="date">
                            </div>
                          </div>

                        <div><button type="button"  class="btn btn-light" type="submit" style="background-color:white;color: black;">الفلترة</button></div>
                    </div>

                    <div>
                        <button type="button"  class="btn btn-light" type="submit" style="background-color:#308CBA;color: white;border: 0px;">اضافة</button>
                        <button type="button"  class="btn btn-light" type="submit" style="background-color:#535353;color: white;border: 0px;">تصدير</button>
                    </div>

                </div>

                <div class="mainofdashboardmaincontentsect2">
                    <div class="table-responsive">
                        <table class="table">
                            <thead style="background-color: white;">
                                <tr>
                                    <th scope="col">
                                        <img src="../Assets/images/dashboard assets/arrows.png" alt="">
                                    </th>
                                    <th scope="col">السعر</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">التوقيت</th>
                                  <th scope="col">الوصف</th>
                                  <th scope="col">الايمايل</th>
                                  <th scope="col">الاسم</th>
                                  <th scope="col"><input type="checkbox"></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                  <th scope="row">
                                    <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-trash"></i></button>
                                    <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-pencil-alt"></i></button>
                                    <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fab fa-telegram-plane"></i></button>
                                  </th>
                                  <td>00$</td>
                                  <td style="color: green;">مفعل</td>
                                  <td>01/01/2020</td>
                                  <td></td>
                                  <td>Mark@gmail.com</td>
                                  <td>يوسف</td>
                                  <td><input type="checkbox"></td>
                                </tr>
                                <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                    <th scope="row">
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-trash"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fab fa-telegram-plane"></i></button>
                                    </th>
                                    <td>00$</td>
                                    <td style="color: green;" >مفعل</td>
                                    <td>01/01/2020</td>
                                    <td></td>
                                    <td>Mark@gmail.com</td>
                                    <td>يوسف</td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                    <th scope="row">
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-trash"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fab fa-telegram-plane"></i></button>
                                    </th>
                                    <td>00$</td>
                                    <td style="color: green;">مفعل</td>
                                    <td>01/01/2020</td>
                                    <td></td>
                                    <td>Mark@gmail.com</td>
                                    <td>يوسف</td>
                                    <td><input type="checkbox"></td>
                                </tr>
                                <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                    <th scope="row">
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-trash"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fab fa-telegram-plane"></i></button>
                                    </th>
                                  <td>00$</td>
                                  <td style="color: green;">مفعل</td>
                                  <td>01/01/2020</td>
                                  <td></td>
                                  <td>Mark@gmail.com</td>
                                  <td>يوسف</td>
                                  <td><input type="checkbox"></td>
                                  </tr>
                                  <tr style="background-color: #F4F4F4;border: 0px solid #F4F4F4;">
                                    <th scope="row">
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-trash"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fas fa-pencil-alt"></i></button>
                                        <button type="button"   type="submit" style="background-color:#308CBA;border-radius: 75px;color: white;border: 0px;"><i class="fab fa-telegram-plane"></i></button>
                                    </th>
                                    <td>00$</td>
                                    <td style="color: green;">مفعل</td>
                                    <td>01/01/2020</td>
                                    <td></td>
                                    <td>Mark@gmail.com</td>
                                    <td>يوسف</td>
                                    <td><input type="checkbox"></td>
                                  </tr>
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