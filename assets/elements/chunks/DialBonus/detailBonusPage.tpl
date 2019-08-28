<div class="client-info">
    <div class="client-info__left">
        <div class="client-info__status">
            <p>Ваш статус: <br><span>{$cur_group_name}</span></p>
            <div class="client-info__percent-bonus">
                <p>{$cur_group_discount}%</p>
            </div>
        </div>
        <div class="client-spending">
            <div id="money-progress" data-from="0" data-to="{$cur_group_border}" data-current="{$order_sum}" class="client-spending__money-scale"></div>
            <div class="client-spending__money">
                <p class="money-from">0</p>
                <p class="money-to">{$cur_group_border}</p>
            </div>
        </div>
    </div>
    <div class="client-info__right">
        <div class="client-info__bonus-info">
            <p>Вы можете оплатить купон бонусами до {$cur_group_discount}% от стоимости заказа.</p>
            {if $next_group_name}
                <p>Для получения статуса "{$next_group_name}" необходимо купить еще на {$sum_to_next_group} руб. Следующий статус увеличит вашу скидку еще на {$next_group_discount}%.</p>
            {/if}
        </div>
    </div>
    <a href="{36 | url}" class="about-status">Подробнее о статусах</a>
</div>