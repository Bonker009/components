<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://seeklogo.com/images/M/mugiwara-logo-303FD55C54-seeklogo.com.png" type="image/x-icon">
    <title>East Blue</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 ">

    <?php include("../UI/header.php") ?>
    <main class="flex flex-row justify-center items-center p-20 ">

        <div>
            <div class="bg-white shadow-md border border-gray-200 rounded-lg max-w-sm p-4 sm:p-6 lg:p-8 w-[50rem]">
                <form class="space-y-6" action="<?php $_SERVER["PHP_SELF"] ?>" method="post">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">Sign in to our platform</h3>
                    <div>
                        <label for="email" class="text-sm font-medium text-gray-900 block mb-2 ">Your email</label>
                        <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="name@company.com" required="">
                    </div>
                    <div>
                        <label for="password" class="text-sm font-medium text-gray-900 block mb-2 ">Your password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required="">
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember" aria-describedby="remember" type="checkbox" class="bg-gray-50 border border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded dark:bg-gray-700" required="">
                            </div>
                            <div class="text-sm ml-3">
                                <label for="remember" class="font-medium text-gray-900 ">Remember me</label>
                            </div>
                        </div>
                        <a href="#" class="text-sm text-blue-700 hover:underline ml-auto ">Lost
                            Password?</a>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ">Login to your account</button>
                    <div class="text-sm font-medium text-gray-500 ">
                        Not registered? <a href="register.php" class="text-blue-700 hover:underline ">Create
                            account</a>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include("../UI/footer.php") ?>
</body>

</html>
<?php

include("../database.php");

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if ($email && $password) {
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($db_conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            header("Location: ../../index.php");
        } else {
            echo "Email or password is incorrect";
        }
    }
}

?>