{'!ChangePassword' | snippet : [
    'submitVar' => 'change-password',
    'placeholderPrefix' => 'cp.',
    'validateOldPassword' => '1',
    'validate' => 'nospam:blank',
    'reloadOnSuccess' => '0',
    'successMessage' => 'Ваш пароль успешно изменён'
]}

<div class="row">
    <div class="col-sm-12">
        <div class="updprof-error">[[!+cp.error_message]]</div>
        <p>[[!+cp.successMessage]]</p>
        <form class="form-horizontal" action="{$_modx->resource.id | url}" method="post">
            <input type="hidden" name="nospam" value="">
            <div class="form-group">
                <label for="password_old" class="col-sm-4 control-label">Старый пароль</label>
                <div class="col-sm-8">
                    <input type="password" name="password_old" id="password_old" value="[[+cp.password_old]]" class="form-control">
                    <span class="help-block text-error">
                      [[!+cp.error.password_old]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="password_new" class="col-sm-4 control-label">Новый пароль</label>
                <div class="col-sm-8">
                    <input type="password" name="password_new" id="password_new" value="[[+cp.password_new]]" class="form-control">
                    <span class="help-block text-error">
                      [[!+cp.error.password_new]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="password_new_confirm" class="col-sm-4 control-label">Введите новый пароль ещё раз</label>
                <div class="col-sm-8">
                    <input type="password" name="password_new_confirm" id="password_new_confirm" value="[[+cp.password_new_confirm]]" class="form-control">
                    <span class="help-block text-error">
                      [[!+cp.error.password_new_confirm]]
                    </span>
                </div>
            </div>
            <input type="submit" value="Изменить пароль" name="change-password" id="change-password" class="btn btn-primary pull-right btn--green">
        </form>
    </div>
</div>