<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login E-Jurnal SMEKTA</title>
    <link rel="stylesheet" href="\assets\css\navbarIndex.css">
    <link rel="stylesheet" href="\assets\css\login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="/assets/js/showPassword.js" ></script>
</head>
<body style="background-image: url(/assets/background/bgLogin.png); background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; ">
    <section class="section1"  >
        <div class="card-section1" >
            <div class="container">
                <div class="contentLogin" >
                    <h1 class="h1-content" >Login E-Jurnal</h1>
                    <p>Silahkan Masukkan Username dengan nama lengkapmu dan masukan juga password yang sesuai</p>
                </div>
                
                <form class="formLogin" action="post">
                    <label for="">Username</label>
                    <input type="text" placeholder="Masukkan Username" >

                    <label for="">Password</label>
                    <input id="password" type="password" placeholder="Masukkan Password" >

                    <div class="container-link" >
                        <label><input id="show-password" type="checkbox">Tampilkan sandi</label>
                        <a class="link-lupasandi" href="../landingpage/lupaPassword.php">Lupa Sandi?</a>
                    </div>

                    <div class="coverBtn" >
                        <a class="btnLogin" href="../siswa/siswaDb.php">Masuk</a>
                    </div>
                    
                </form>
            </div>
        </div>
        <!-- <p>Desain By kjpargeter</p> -->
    </section>
    <footer>
        <a href="https://www.freepik.com/author/kjpargeter" target="_blank" ><span>Background Desain By </span>kjpargeter</a>
    </footer>
    <!-- <div class="blackDisplay-login" ></div> -->
</body>
</html>