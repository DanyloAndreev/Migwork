<main class="greeting">
    <div class="greeting_page">
        <p>Добавьте необходимые данные о себе</p>
    </div>
    <div class="greeting_registration">
        <form method="post" enctype="multipart/form-data" name="registration_info" action="../pages/registration.php" class="greeting_registration_form">
            <br>Я из<br>
            <select class="greeting_registration_input" name="native_country" required>
                <option value="2" selected>Украина</option>
                %optionNativeCountry%
            </select>
            <br>Сейчас работаю в<br>
            <select class="greeting_registration_input" name="work_at" required>
                <option value="9" selected>США</option>
                %optionWorkAt%
            </select>
            <br>На должности<br>
            <select class="greeting_registration_input" name="position" required>
                <option value="149" selected>Программист</option>
                %optionPosition%
            </select>
            <br>Зарабатываю<br>
            <select class="greeting_registration_input" name="earn" required>
                <option selected value="6">1500-2000$</option>
                %optionEarn%
            </select>
            <br><br>
            Добавьте свое фото
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
            <input type="file" accept="image/jpeg,image/png" name="user_foto" required><br>
            <br>
            <p>О себе</p>
            <textarea class="greeting_registration_input" name="about" cols="40" rows="7" required></textarea>
            <br><br>
            <p><input type="submit" value="Создать аккаунт" class="btn_submit" name="submit_registration"></p>
        </form>
    </div>
</main>