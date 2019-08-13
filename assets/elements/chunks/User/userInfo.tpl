<div class="info-content">
    <div class="lk-user-info">
        <div class="lk-user-info-left">
            <div class="lk-user-photo"><img src="{$_modx->user.photo}" alt=""></div>
        </div>
        <div class="lk-user-info-right">
            <div class="lk-user-info-row lk-user-info-row--name"><span class="lk-user-info-name-bold">{$_modx->user.fullname}</span></div>
            <div class="lk-user-info-row lk-user-info-row--email">{$_modx->user.email}</div>
            <div class="lk-user-info-row lk-user-info-row--params">
                <div class="lk-user-info-param">Никнейм: <b>{$_modx->user.username}</b></div>
                <div class="lk-user-info-param">ID: <b>{$_modx->user.internalKey}</b></div>
            </div>
        </div>
    </div>
</div>