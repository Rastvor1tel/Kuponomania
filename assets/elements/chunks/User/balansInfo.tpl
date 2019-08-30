<div class="info-content">
    <div class="lk-param">
        <div class="lk-param-label">Ваш баланс:</div>
        <div class="lk-param-value">
            {'!msProfile' | snippet : ['tpl' => '@INLINE {$account}']} <span class="lk-param-currency">руб.</span>
        </div>
        <div class="lk-param-footer">
            <a href="{37 | url}" class="lk-param-link">Пополнить</a>
        </div>
    </div>
</div>