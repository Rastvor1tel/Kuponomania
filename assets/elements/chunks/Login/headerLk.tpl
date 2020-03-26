<div class="header-lk">
    <a href="{16 | url}" style="min-width: 150px; text-align: center;">
        {if $_modx->user.fullname}
            {$_modx->user.fullname}
        {else}
            {$_modx->user.username}
        {/if}
    </a>
    <div id="box" class="header-lk__dropdown">
        <ul>
            <li><a href="{16 | url}">Личный кабинет</a></li>
            <li><a href="{30 | url}">Редактирование</a></li>
            <li><a href="{29 | url}">Изменить пароль</a></li>
            <li>{'!Login' | snippet : [ 'logoutTpl' => 'logoutTpl', 'logoutResourceId' => '1']}</li>
        </ul>
    </div>
</div>