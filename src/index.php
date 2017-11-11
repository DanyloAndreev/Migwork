<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Migwork</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    <header class="head">
        <div class="head_logo">
            <a href="http://localhost/migwork/src/index.php">Migwork</a>
        </div>
        <div class="head_login">
            <form method="post" name="login" action="#">
                <input name="email" type="email" placeholder="Введите email" required>
                <input name="password" type="password" placeholder="Введите пароль" required>
                <input type="submit" value="Войти" class="btn_submit">
            </form>
            <div class="head_login_forget"><a href="#">Забыли пароль?</a></div>
        </div>
    </header>
    <main class="greeting">
        <div class="greeting_page">
            <p>Зарегистрироваться на Migwork</p>
            <p class="greeting_page_info">Обменивайтесь информацией о работе за границей</p>
        </div>
        <div class="greeting_registration">
            <form method="post" name="registration" action="#" class="greeting_registration_form">
                Имя<br>
                <input name="name" type="text" class="greeting_registration_input" required>
                <br>Фамилия<br>
                <input name="surname" type="text" class="greeting_registration_input" required>
                <br>
                <br>Пароль<br>
                <input name="password" type="password" class="greeting_registration_input" required>
                <br>Повторить пароль<br>
                <input name="password_confirm" type="password" class="greeting_registration_input" required>
                <br><br>
                <p>Дата рождения</p>
                <input type="date" max="2000-12-31" min="1900-01-01" required>
                <br><br>
                <p><input type="submit" value="Создать аккаунт" class="btn_submit"></p>
            </form>
        </div>
    </main>
    <footer class="foo">
        <div>
            <p>Migwork © 2017</p>
        </div>
        <div>
            <a href="#">О компании</a>
            <a href="#">Пользовательское соглашение</a>
            <a href="#">Правила сообщества</a>
        </div>
        <div>
            <form action="#" method="post">
                <select>
                    <option disabled>Выберите язык</option>
                    <option selected value="rus">Русский</option>
                    <option value="ukr">Українська</option>
                    <option value="eng">English</option>
                </select>
            </form>
        </div>
    </footer>
</div>
</body>
</html>