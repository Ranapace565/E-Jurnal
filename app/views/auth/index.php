<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login E-Jurnal SMEKTA</title>
    <link rel="stylesheet" href="/assets/css/navbarIndex.css">
    <link rel="stylesheet" href="/assets/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="/assets/js/showPassword.js"></script>
</head> -->
<?php require_once __DIR__ . '/../components/header.php'; ?>

<!-- <body style="background-image: url(/assets/background/bgLogin.png); background-position: center; background-repeat: no-repeat; background-size: cover; background-attachment: fixed; ">
    <section class="section1">


        <div class="card-section1">
            <div class="container">
                <div class="contentLogin">
                    <h1 class="h1-content">Login E-Jurnal</h1>
                    <p>Silahkan Masukkan Username dengan nama lengkapmu dan masukan juga password yang sesuai</p>
                </div>

                <form class="formLogin" action="/login" method="POST">
                    <input type="hidden" name="_method" value="LOGIN">

                    <label for="">Username</label>
                    <input type="text" name="username" id="username" placeholder="Masukkan Username">

                    <label for="">Password</label>
                    <input id="password" name="password" type="password" placeholder="Masukkan Password">

                    <div class="container-link">
                        <label><input id="show-password" type="checkbox">Tampilkan sandi</label>

                        <a class="link-lupasandi" href="../landingpage/lupaPassword.php">Lupa Sandi?</a>
                    </div>

                    <button type="submit">Masuk</button>

                </form>
            </div>
        </div>
    </section>
    <footer>
        <a href="https://www.freepik.com/author/kjpargeter" target="_blank"><span>Background Desain By </span>kjpargeter</a>
    </footer>
</body>

</html> -->

<section class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <!-- <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
            Flowbite
        </a> -->
        <?php if (!empty($flash)): ?>
            <div class="alert alert-<?= $flash['type'] ?>">
                <?= htmlspecialchars($flash['message']) ?>
            </div>
        <?php endif; ?>

        <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Login E-Jurnal SMEKTA </h1>
                <?php require_once __DIR__ . '/../components/alert.php'; ?>
                <form class="space-y-4 md:space-y-6" action="/login" method="POST">
                    <input type="hidden" name="_method" value="LOGIN">
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="username" required="">
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="show-password" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember" class="text-gray-500 dark:text-gray-300">Tampilkan password</label>
                            </div>
                        </div>
                        <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Masuk</button>
                    <!-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Don’t have an account yet? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                    </p> -->
                </form>
            </div>
        </div>
    </div>
</section>