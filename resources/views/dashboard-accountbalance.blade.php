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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>
    <style>
    ::placeholder{
        color:black;
        opacity: 60%;
    }
    </style>
</head>
<body>
    <div class="dashboardmain" id="dashboardbalance">

        <div class="dashboardmaincontent">
            <div class="headerofdashboardmaincontent" style="justify-content: flex-end;">
               <div class="two">
                   <h1 style="color:#308CBA;">رصيد الحساب</h1>
               </div>
            </div>
            <div class="mainofdashboardmaincontent" style=" flex-direction: column;    justify-content: normal;">
                <div class="totalbalence">

                    <div class="totalblancemoney">
                        <div class="currentmoney">
                            <span>الرصيد الكلي</span>
                            <span>000</span>
                        </div>
                        <div class="lastmonthmoney">
                            <span>رصيد اخر الشهر</span>
                            <span>000</span>
                        </div>
                        
                    </div>
                    <button type="button" style="border-radius: 75px;" class="btn btn-light">اضافة</button>
                </div>
                <div style="max-height: 400px;max-width: 400px;">
                <canvas id="myChart" width="400" height="400"></canvas>
            </div>
            </div>
        </div>

        <div class="latesttransactions">
            <div class="searchbaroflatesttransactions">
               <div>
                <input type="text" placeholder="ابحث" >
                <i class="fas fa-search"></i> 
               </div>  
            </div>

            <div class="userinformationsoflatesttransactions">

                <div class="Qrcode"></div>

                <div class="userinfos">
                    <span>اسم المستخدم</span>
                    <span>رقم الحساب</span>
                </div>

                <div class="latesttransactionsoflatesttransactionsdiv">
                    <span>اخر المعاملات</span>

                    <div class="transactionresponsible">

                        <div class="right">
                            <img src="../Assets/images/userimg.svg" alt="responsible of transaction">

                            <div class="infosoftheresponsibleoftransaction">
                                <span>اسم المستخدم</span>
                                <span>رقم الحساب</span>
                            </div>

                        </div>

                        <div class="left">
                            <span>+ 000</span>
                        </div>

                    </div>

                    <div class="transactionresponsible">

                        <div class="right">
                            <img src="../Assets/images/userimg.svg" alt="responsible of transaction">

                            <div class="infosoftheresponsibleoftransaction">
                                <span>اسم المستخدم</span>
                                <span>رقم الحساب</span>
                            </div>

                        </div>

                        <div class="left">
                            <span>+ 000</span>
                        </div>

                    </div>
                    <div class="transactionresponsible">

                        <div class="right">
                            <img src="../Assets/images/userimg.svg" alt="responsible of transaction">

                            <div class="infosoftheresponsibleoftransaction">
                                <span>اسم المستخدم</span>
                                <span>رقم الحساب</span>
                            </div>

                        </div>

                        <div class="left">
                            <span>+ 000</span>
                        </div>

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
            <a href=""><button id="activebutton"><img src="../Assets/images/dashboard assets/wallet.svg" width="30px" alt=""></button></a>
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
    <script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
    </script>
</body>
</html>