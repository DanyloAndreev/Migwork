<main class="greeting">
    <div class="greeting_page">
        <p>Зарегистрироваться на Migwork</p>
        <p class="greeting_page_info">Обменивайтесь информацией о работе за границей</p>
    </div>
    <div class="greeting_registration">
        <form method="post" name="registration" action="/src/pages/registration.php" class="greeting_registration_form">
            <br>Email<br>
            <input type="email" class="greeting_registration_input"><br>
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