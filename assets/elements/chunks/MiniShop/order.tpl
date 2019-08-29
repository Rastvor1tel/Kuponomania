{$modx->regClientCSS($_modx->config['bonus.assets_url'] ~ 'css/web/order.css')}
{$modx->regClientScript($_modx->config['bonus.assets_url'] ~ 'js/web/order.js')}
<form class="ms2_form" id="msOrder" method="post">
    <div class="row">
        <div class="col-12 col-md-6">
            <h4>{'ms2_frontend_credentials' | lexicon}:</h4>
            {foreach ['email','receiver','phone'] as $field}
                <div class="form-group row input-parent">
                    <label class="col-md-4 col-form-label" for="{$field}">
                        {('ms2_frontend_' ~ $field) | lexicon} <span class="required-star">*</span>
                    </label>
                    <div class="col-md-8">
                        <input type="text" id="{$field}" placeholder="{('ms2_frontend_' ~ $field) | lexicon}" name="{$field}" value="{$form[$field]}" class="form-control{($field in list $errors) ? ' error' : ''}">
                    </div>
                </div>
            {/foreach}

            <div class="form-group row input-parent">
                <label class="col-md-4 col-form-label" for="comment">
                    {'ms2_frontend_comment' | lexicon} <span class="required-star">*</span>
                </label>
                <div class="col-md-8">
                    <textarea name="comment" id="comment" placeholder="{'ms2_frontend_comment' | lexicon}" class="form-control{('comment' in list $errors) ? ' error' : ''}">{$form.comment}</textarea>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6" id="payments">
            <h4>{'ms2_frontend_payments' | lexicon}:</h4>
            <div class="form-group row">
                <div class="col-12">
                    {foreach $payments as $payment index=$index}
                        {var $checked = !($order.payment in keys $payments) && $index == 0 || $payment.id == $order.payment}
                        <div class="checkbox">
                            <label class="col-form-label payment input-parent">
                                <input type="radio" name="payment" value="{$payment.id}" id="payment_{$payment.id}"{$checked ? 'checked' : ''}>
                                {if $payment.logo?}
                                    <img src="{$payment.logo}" alt="{$payment.name}" title="{$payment.name}" class="mw-100"/>
                                {else}
                                    {$payment.name}
                                {/if}
                                {if $payment.description?}
                                    <p class="small">{$payment.description}</p>
                                {/if}
                            </label>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6" id="deliveries">
            <h4>{'ms2_frontend_deliveries' | lexicon}:</h4>
            <div class="form-group row">
                <div class="col-12">
                    {foreach $deliveries as $delivery index=$index}
                        {var $checked = !($order.delivery in keys $deliveries) && $index == 0 || $delivery.id == $order.delivery}
                        <div class="checkbox">
                            <label class="col-form-label delivery input-parent">
                                <input type="radio" name="delivery" value="{$delivery.id}" id="delivery_{$delivery.id}" data-payments="{$delivery.payments | json_encode}"{$checked ? 'checked' : ''}>
                                {if $delivery.logo?}
                                    <img src="{$delivery.logo}" alt="{$delivery.name}" title="{$delivery.name}"/>
                                {else}
                                    {$delivery.name}
                                {/if}
                                {if $delivery.description?}
                                    <p class="small">
                                        {$delivery.description}
                                    </p>
                                {/if}
                            </label>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6" id="bonus-block">
            <div class="bonus-block bonus-ajax-content">
                <h4>Использование бонусов:</h4>
                <p>Доступно: <span id="bonus-balance">{'@FILE snippets/DialBonus/bonusBalance.php' | snippet}</span> бонусов.</p>
                <p>Вы можете оплатитьбонусами {'@FILE snippets/DialBonus/bonusDiscount.php' | snippet * 100}% ({'@FILE snippets/DialBonus/bonusDiscount.php'|snippet:['orderSum'=>$order.cost,'front'=>true]} {'ms2_frontend_currency' | lexicon}) от заказа.</p>
                <div class="bonus-block__form">
                    <div class="bonus-block__input">
                        <label for="bonuspayed"><span class="btn btn-success btn-lg">Оплатить используя бонусы</span></label>
                        <input type="checkbox" class="hidden" id="bonuspayed" value="Y" name="extfld_bonuspayed">
                    </div>
                    <div class="bonus-block__input bonus-value">
                        <label for="bonusvalue">Количество бонусов</label>
                        <input type="number" max="{'@FILE snippets/DialBonus/bonusDiscount.php'|snippet:['orderSum'=>$order.cost]}" data-modifier="{'@FILE snippets/DialBonus/bonusDiscount.php' | snippet}" id="bonusvalue" placeholder="0" name="extfld_bonusvalue" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="button" name="ms2_action" value="order/clean" class="btn btn-danger ms2_link">
        {'ms2_frontend_order_cancel' | lexicon}
    </button>

    <hr class="mt-4 mb-4"/>

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-end">
        <h4 class="mb-md-0">{'ms2_frontend_order_cost' | lexicon}:</h4>
        <h3 class="mb-md-0 ml-md-2"><span id="ms2_order_cost">{$order.cost}</span> {'ms2_frontend_currency' | lexicon}</h3>

        <button type="submit" name="ms2_action" value="order/submit" class="btn btn-lg btn-primary ml-md-2 ms2_link">
            {'ms2_frontend_order_submit' | lexicon}
        </button>
    </div>
</form>