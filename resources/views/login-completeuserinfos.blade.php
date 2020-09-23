<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../Assets/css/bootstrap.min.css">
        <script src="../Assets/js/jquery.min.js"></script>
        <script src="../Assets/js/popper.min.js"></script>
        <script src="../Assets/js/bootstrap.min.js"></script>
        <link  rel="stylesheet" href="../Assets/css/style.css"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <script>
        $(function(){
            $('#changeimage').click(function(){
                $('#uploadnewimage').click();
            })
        })
    </script>
    </head>
<body>
    <div class="completeinfos">

        <div class="completeinfosheader">
            <div>
                <h2>أكمل حسابك بالمعلومات الضرورية</h2>
            </div>
        </div>

        <div class="completeinfosmain">
            <div>
                <form action="" style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                    <div style="display: flex;flex-wrap: wrap;justify-content: center;">
                        <figure style="position: relative;">
                            <img src="../Assets/images/userimg.svg" alt="" style="width:140px;border:3px solid #308CBA;border-radius: 100%;padding: 4px;margin: 15px;border-radius: 50%;">
                            <button id="changeimage" style="position: absolute;bottom: 10%;right: 10%;background-color: white;border: 3px solid #308CBA;border-radius: 50%;"><i class="fas fa-plus"></i></button>
                            <input id="uploadnewimage" type="file" style="display: none;">
                        </figure>
                        <span style="color: #308CBA;font-size: 48px;align-self: center;padding-bottom: 15px;margin: 15px;">User name</span>
                    </div>
                    <input type="text" placeholder="اسم المستخدم">
                    <input type="text" placeholder="كلمة المرور">
                    <input type="text" placeholder="كلمة المرور">
                    <input type="text" placeholder="كلمة المرور">
                    <input type="text" placeholder="كلمة المرور">
                    <textarea name="" id="" rows="5" cols="20"></textarea>
                    <div style="display: flex;flex-direction: row-reverse;justify-content: space-between;align-self: normal;margin: 0px 20px 0px 20px;padding: 0px 10px 10px 10px">

                    </div>
                    <button type="button" class="btn btn-light" type="submit" style="background-color:#308CBA;width: 300px;border-radius: 75px;color: white;font-size: 30px;margin-bottom: 30px;">الدخول الى الحساب</button>
                   
                </form>
            </div>
        </div>
    </div>
</body>
</html>