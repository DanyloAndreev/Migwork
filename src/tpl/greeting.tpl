<main class="greeting">
    <div class="greeting_page">
        <p>Зарегистрироваться на Migwork</p>
        <p class="greeting_page_info">Обменивайтесь информацией о работе за границей</p>
    </div>
    <div class="greeting_registration">
        <form method="post" name="registration" action="../pages/greeting.php" class="greeting_registration_form">
            <br>Email<br>
            <input type="email" name="email" class="greeting_registration_input" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
            <br>Имя<br>
            <input name="name" type="text" class="greeting_registration_input"  pattern="[А-Яа-яЁёA-Za-z]{3,16}" required>
            <br>Фамилия<br>
            <input name="surname" type="text" class="greeting_registration_input" pattern="[А-Яа-яЁёA-Za-z]{2,30}" required>
            <br>
            <br>Пароль<br>
            <input name="pass" type="password" class="greeting_registration_input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            <br>Повторить пароль<br>
            <input name="pass_confirm" type="password" class="greeting_registration_input" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
            <br><br>
            <p>Дата рождения</p>
            <input type="date" name="birthday" max="2001-12-31" min="1900-01-01" required>
            <br><br>
            <p><input type="submit" value="Создать аккаунт" class="btn_submit" name="submit_greeting"></p>
        </form>
    </div>
</main>