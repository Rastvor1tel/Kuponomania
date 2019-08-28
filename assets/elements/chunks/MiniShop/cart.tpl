<div class="cart-header">
    <h1>{$_modx->resource.pagetitle}</h1>
</div>
<div id="msCart">
    {if !count($products)}
        <div style="margin: 0 auto; text-align: center; height: 50px; padding-top: 20px;">
            {'ms2_cart_is_empty' | lexicon}
        </div>
    {else}
        <div class="table-responsive">
            <table class="table table-striped">
                {foreach $products as $product}
                    <tr id="{$product.key}" class="cart-item">
                        <td class="cart-item-info">
                            <div class="shape"></div>
                            <img src="{$product.thumb}" alt="{$product.pagetitle}" title="{$product.pagetitle}"/>
                            <div class="title">
                                {if $product.id?}
                                    <a href="{$product.id | url}">{$product.pagetitle}</a>
                                {else}
                                    {$product.name}
                                {/if}
                                {if $product.options?}
                                    <div class="small">
                                        {$product.options | join : '; '}
                                    </div>
                                {/if}
                            </div>
                        </td>
                        <div class="params">
                            <td class="block price">
                                <div class="label">Цена</div>
                                <div class="currency-content data"><span>{$product.price}</span> {'ms2_frontend_currency' | lexicon}</div>
                            </td>
                            <td class="block num count">
                                <div class="label">Количество</div>
                                <form method="post" class="ms2_form form-inline" role="form">
                                    <input type="hidden" name="key" value="{$product.key}"/>
                                    <div class="form-group">
                                        <input type="number" name="count" value="{$product.count}" class="product-quantity input-sm form-control"/>
                                        <span class="hidden-xs">{'ms2_frontend_count_unit' | lexicon}</span>
                                        <button class="btn btn-default" type="submit" name="ms2_action" value="cart/change">
                                            <i class="glyphicon glyphicon-refresh">ок</i>
                                        </button>
                                    </div>
                                </form>
                            </td>
                            <td class="block summ">
                                <div class="label">Сумма</div>
                                <div class="data">
                                    <span class="currency-content summ-price">{$product.cost}</span> {'ms2_frontend_currency' | lexicon}
                                </div>
                            </td>
                            <div class="block weight" style="display: none;">
                                <span>{$product.weight}</span> {'ms2_frontend_weight_unit' | lexicon}
                            </div>
                            <td class="controls">
                                <form method="post" class="ms2_form">
                                    <input type="hidden" name="key" value="{$product.key}">
                                    <button class="btn btn-default delete" type="submit" name="ms2_action" value="cart/remove">
                                        <i class="ico">удалить</i>
                                    </button>
                                </form>
                            </td>
                        </div>
                    </tr>
                {/foreach}
            </table>
        </div>
        <div class="cart-total">

            <div id="clear_form">
                <div class="clear-block">
                    <form method="post">
                        <button class="btn btn-default btn--green" type="submit" name="ms2_action" value="cart/clean">
                            <i class="glyphicon glyphicon-remove"></i> {'ms2_cart_clean' | lexicon}
                        </button>
                    </form>
                </div>
            </div>
            <div id="total_summ">
                <div class="total-summ">
                    <div class="for-total shape"></div>
                    <div class="total-summ-wrap">

                        <div class="coupons-num total-summ-block">
                            <span>Всего</span>
                            <span class="ms2_total_count data">{$total.count}</span>
                            <span>купона</span>
                        </div>

                        <div class="total-price total-summ-block">
                            <div class="main-block">
                                <span class="label">К оплате</span>
                                <span class="ms2_total_cost summ-price data">{$total.cost}</span> {'ms2_frontend_currency' | lexicon}
                            </div>
                        </div>

                        <div class="total_weight" style="display: none";>
                            <span class="ms2_total_weight">{$total.weight}</span> {'ms2_frontend_weight_unit' | lexicon}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {/if}
</div>
