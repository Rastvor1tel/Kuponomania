<div class="order-success">
    <h1>Заказ оформлен</h1>
    <p><b>Номер заказа:</b> {$order['num']}</p>
    <p><b>Способ оплаты:</b> {$payment['name']}</p>
    {if $payment_link?}
        <div class="payment-block">
            <img class="payment-block__img" src="{$payment['logo']}" alt="">
            <a class="payment-block__btn btn btn-primary btn--green" href="{$payment_link}">Оплатить</a>
        </div>
    {/if}
</div>
