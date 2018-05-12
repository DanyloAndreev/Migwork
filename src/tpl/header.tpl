<header class="head">
    <div class="head_logo">
        <a href="../pages/greeting.php">Migwork</a>
    </div>
    <div class="head_login">
        <form method="post" name="login" action="../pages/autorization.php">
            <input name="email" type="email" placeholder="Введите email" required>
            <input name="pass" type="password" placeholder="Введите пароль" required>
            <input type="submit" value="Войти" class="btn_submit" name="login_submit">
            <div class="head_login_forget"><a href="#">Забыли пароль?</a></div>
        </form>
    </div>
</header>