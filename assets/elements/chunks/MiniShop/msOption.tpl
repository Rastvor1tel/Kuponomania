{if $options}
    {foreach $options as $name => $values}
        <div class="popup js-purchaseOption">
            <div class="popup__overlay js-watchPopup">
                <div class="popup__body">
                    <div class="popup__wrap">
                        <div class="popup__close js-closePopup"></div>
                        <div class="popup__title">
                            Выберете вариант покупки:
                        </div>
                        <div class="popup__items">
                            {foreach $values as $value}
                                <div class="popup-item">
                                    <div class="popup-item__title">{$value}</div>
                                    <div class="popup-item__price" data-option="{$value}"></div>
                                    <span class="popup-item__button btn--green" data-value="{$value}">Купить</span>
                                </div>
                            {/foreach}
                        </div>
                        <a href="/personal/korzina/" class="popup-basket-button btn--green">
                            В корзину
                        </a>
                    </div>
                </div>
            </div>
        </div>
    {/foreach}
    {foreach $options as $name => $values}
        <div class="hidden-block__option form-group row align-items-center">
            <div class="col-12">
                <div>Виды купонов</div>
                <select name="options[{$name}]" class="form-control col-md-6" id="option_{$name}">
                    {foreach $values as $value}
                        <option value="{$value}">{$value}</option>
                    {/foreach}
                </select>
            </div>
        </div>
    {/foreach}
    {'@FILE snippets/productCoupons.php' | snippet : [
    'tpl' => '@FILE chunks/MiniShop/selectButton.tpl',
    'product' => $_modx->resource.id
    ]}
{else}
    {'@FILE snippets/productCoupons.php' | snippet : [
    'tpl' => '@FILE chunks/MiniShop/buyButton.tpl',
    'product' => $_modx->resource.id,
    'type' => 'buy'
    ]}
{/if}