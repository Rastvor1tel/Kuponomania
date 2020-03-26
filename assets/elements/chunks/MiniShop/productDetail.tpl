<div id="msProduct" class="d-header">
    <form class="form-horizontal ms2_form" method="post">
        <input type="hidden" name="id" value="{$_modx->resource.id}"/>
        <input class="hidden" type="submit" name="ms2_action" value="cart/add"/>
        <div class="d-header-title">
            <h1 class="coupon-title">{$_modx->resource.pagetitle}</h1>
            <div class="link-back">
                <a href="#" onclick="history.back(-1);">Вернуться к списку</a>
            </div>
        </div>
        <div class="d-header-content">
            <div class="d-h-content-left">
                {'msGallery' | snippet : [
                'tpl'=> '@FILE chunks/MiniShop/detailGallery.tpl'
                ]}
            </div>
            <div class="d-h-content-right">
                <div class="info-row info-row-first">
                    <div class="info-col">
                        <div class="info-text">
                            <div class="info-cost">
                                от <span class="pr_change">{$price}</span> {'ms2_frontend_currency' | lexicon}
                            </div>
                        </div>
                        <input type="hidden" name="count" id="product_price" class="input-sm form-control" value="1"/>
                    </div>
                    {'!msOptions' | snippet : [
                    'tpl' => '@FILE chunks/MiniShop/msOption.tpl',
                    'options' => 'size'
                    ]}
                </div>
                <div class="info-row">
                    {if $_modx->resource.oldPrice}
                        <div class="info-col">
                            <div class="info-label">Цена без скидки</div>
                            <div class="info-text">
                                <div class="info-cost">
                                    до {$_modx->resource.oldPrice} {'ms2_frontend_currency' | lexicon}</div>
                            </div>
                        </div>
                    {/if}
                    {if $_modx->resource.discount}
                        <div class="info-col sale">
                            <div class="info-label">Скидка</div>
                            <div class="info-text">
                                <div class="discount">{$_modx->resource.discount}%</div>
                            </div>
                        </div>
                    {/if}
                    {if $_modx->resource.economy}
                        <div class="info-col">
                            <div class="info-label">Экономия</div>
                            <div class="info-text">
                                <div class="economy">
                                    до {$_modx->resource.economy} {'ms2_frontend_currency' | lexicon}</div>
                            </div>
                        </div>
                    {/if}
                </div>
                {if $_modx->resource.unpub_date}
                    <div class="info-row info-row-icon icon-time">
                        <div class="info-col">
                            <div class="info-label">На покупку купона осталось:</div>
                            <div class="info-text">
                                <div class="end-date">
                                    <div class="timer" data-time="{strtotime($_modx->resource.unpub_date)}">
                                        <div class="timer__days">00</div>
                                        <span class="timer__days-unit">дн.</span>
                                        <div class="timer__hours">00</div>
                                        <span class="timer__days-separator">:</span>
                                        <div class="timer__minutes">00</div>
                                        <span class="timer__days-separator">:</span>
                                        <div class="timer__seconds">00</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {/if}
                <div class="info-row painted info-row-icon icon-man">
                    <div class="info-col">
                        <div class="info-label">Уже купили купонов:</div>
                        <div class="info-text">
                            {'@FILE snippets/countBuyedProducts.php' | snippet : [
                            'product'=>$_modx->resource.id
                            ]}
                        </div>
                    </div>
                </div>
                <div class="info-row info-row-last">
                    <div class="info-col">
                        <div class="info-label">Поделиться в соц. сети:</div>
                        <div class="ya-share">
                            <div class="ya-share2" data-services="collections,vkontakte,facebook,odnoklassniki,moimir"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="d-description">
    <ul class="nav-d-d">
        <li class="nav-item active" data-toggle="tab" href="#text" role="tab">
            <a class="nav-link">УСЛОВИЯ И ОСОБЕННОСТИ</a>
        </li>
        <li class="nav-item nav-item--quantity">
            <a class="nav-link js-prodcomments" href="#">ОТЗЫВЫ</a>
        </li>
    </ul>
    <div class="d-d-content">
        <div class="content-inner">
            <div class="content-left-column">
                <div class="text-formatted">
                    {$_modx->resource.content}
                </div>
            </div>
            <div class="content-right-column">
                <div class="sidebar">
                    <div class="sidebar-header">
                        <div class="sidebar-header-label">Организация:</div>
                        <div class="sidebar-header-title">{$_modx->resource.companyName}</div>
                    </div>
                    <div class="promotion-adress-map" style="">{$_modx->resource.companyMapLink}</div>
                    <div class="promotion-organisations">
                        {if $_modx->resource.companyAdress || $_modx->resource.companyPhone || $_modx->resource.companyWorktime}
                            <div class="promotion-organisation">
                                <div class="promotion-organisation-row promotion-organisation-row--address">
                                    {$_modx->resource.companyAdress}
                                </div>
                                <div class="promotion-organisation-row">
                                    <div class="promotion-organisation-phone">
                                        <a href="tel:{$_modx->resource.companyPhone}">{$_modx->resource.companyPhone}</a>
                                    </div>
                                </div>
                                <div class="promotion-organisation-row">
                                    <div class="promotion-organisation-row-worktime">{$_modx->resource.companyWorktime}</div>
                                </div>
                            </div>
                        {/if}
                        {if $_modx->resource.vkUrl || $_modx->resource.instaUrl || $_modx->resource.tlgrmUrl}
                            <div class="promotion-organisation-row promotion-organisation-row--last promotion-organisation-row--link">
                                <div class="social-link-text">Социальные сети:</div>
                                {if $_modx->resource.vkUrl}
                                    <a class="vk-link" target="_blank" href="{$_modx->resource.vkUrl}"></a>
                                {/if}
                                {if $_modx->resource.instaUrl}
                                    <a class="insta-link" target="_blank" href="{$_modx->resource.instaUrl}"></a>
                                {/if}
                                {if $_modx->resource.tlgrmUrl}
                                    <a class="tlgrm-link" target="_blank" href="{$_modx->resource.tlgrmUrl}"></a>
                                {/if}
                            </div>
                        {/if}
                    </div>
                </div>
                {if $_modx->resource.contentRight}
                    <div class="text-formatted">
                        {$_modx->resource.contentRight}
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
<div class="prod_comment">
    {'!TicketComments' | snippet : [
    'allowGuest' => 1,
    'autoPublish' => 0,
    'autoPublishGuest' => 0,
    'enableCaptcha' => 0
    ]}
</div>

<div id="coupon-option" class="mfp-hide">
    {'pdoPage' | snippet : ['element' => 'msProducts']}
</div>
