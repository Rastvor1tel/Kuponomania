{'!Register' | snippet : [
    'submitVar' => 'registerbtn',
    'activation' => '0',
    'submittedResourceId' => '25',
    'usergroups' => 'Users',
    'usernameField' => 'username',
    'passwordField' => 'password',
    'excludeExtended' => 'email:email:required,login-updprof-btn'
]}

<div class="login-form">
    <div class="register">
        <div class="registerMessage">[[+error.message]]</div>
        <form class="form" action="{$_modx->resource.id | url}" method="post">
            <fieldset class="loginLoginFieldset">
                <legend class="loginLegend">Регистрация</legend>

                <label for="username">[[%register.username? &namespace=`login` &topic=`register`]]
                    <span class="error">[[+error.username]]</span>
                    <input type="text" name="username:required:minLength=6" id="username" value="[[+username]]" />
                </label>
                <label for="password">[[%register.password]]
                    <span class="error">[[+error.password]]</span>
                    <input type="password" name="password:required:minLength=6" id="password" value="[[+password]]" />
                </label>

                <label for="password_confirm">[[%register.password_confirm]]
                    <span class="error">[[+error.password_confirm]]</span>
                    <input type="password" name="password_confirm:password_confirm=`password`" id="password_confirm" value="[[+password_confirm]]" />
                </label>

                <label for="fullname">[[%register.fullname]]
                    <span class="error">[[+error.fullname]]</span>
                    <input type="text" name="fullname:required" id="fullname" value="[[+fullname]]" />
                </label>

                <label for="email">[[%register.email]]
                    <span class="error">[[+error.email]]</span>
                    <input type="text" name="email:email" id="email" value="[[+email]]" />
                </label>
                <div class="form-buttons">
                    <input class="btn btn-primary btn--green" type="submit" name="registerbtn" value="Зарегистрироваться" />
                </div>
            </fieldset>
        </form>
        <a class="register-link" href="{25 | url}">Войти</a>
    </div>
</div>