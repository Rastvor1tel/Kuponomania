{'@FILE snippets/bonus.php' | snippet}
<div class="bonus-inform">
    <div class="bonus-inform__title">Бонусная программа</div>
    <a href="#">Как пользоваться бонусами?</a>
</div>
<div class="client-info">
    <div class="client-info__left">
        <div class="client-info__status">
            <p>Ваш статус: <br><span>Новый клиент</span></p>
            <div class="client-info__percent-bonus">
                <p>10%</p>
            </div>
        </div>
        <div class="client-spending">
            <div class="client-spending__money-scale"></div>
            <div class="client-spending__money">
                <p class="money-from">0</p>
                <p class="money-to">1000</p>
            </div>
        </div>
    </div>
    <div class="client-info__right">
        <div class="client-info__bonus-info">
            <p>Вы можете оплатить купон бонусами до 10% от стоимости заказа.</p>
            <p>Для получения статуса "Пользователь" необходимо купить еще на 1000 руб.
                Следующий статус увеличит вашу скидку еще на 5%.</p>
        </div>
    </div>
    <a href="#" class="about-status">Подробнее о статусах</a>
</div>
<div class="client-promocode">
    <form class="client-promocode__form" action="#" method="POST">
        <label>Активировать промо-код:</label>
        <input type="text" placeholder="Для зачисления бонусов введите подарочный промокод">
        <input type="submit" value="Подтвердить">
    </form>
</div>
<div class="bonus-story">
    <div class="bonus-story__title">История операций с бонусами:</div>
    <div class="bonus-story__table">
        <div class="bonus-table__date">
            <p class="bonus-table__th">Дата операции</p>
            <p><time pubdate datetime="2019-08-14">14.08.19</time></p>
            <p><time pubdate datetime="2019-08-14">14.08.19</time></p>
        </div>
        <div class="bonus-table__name">
            <p class="bonus-table__th">Название операции</p>
            <p>Тест</p>
            <p>Тест</p>
        </div>
        <div class="bonus-table__credited">
            <p class="bonus-table__th">Зачислено</p>
            <p>1000 руб.</p>
            <p>1000 руб.</p>
        </div>
        <div class="bonus-table__spend">
            <p class="bonus-table__th">Списано</p>
            <p>1000 руб.</p>
            <p>1000 руб.</p>
        </div>
    </div>
</div>
