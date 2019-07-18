<div id="msProduct" class="d-header">
    <form class="form-horizontal ms2_form" method="post">
        <input type="hidden" name="id" value="[[*id]]"/>
        <div class="d-header-title">
            <h1 class="coupon-title">{$_modx->resource.pagetitle}</h1>
            <div class="link-back">
                <a href="#" onclick="history.back(-1);">Вернуться к списку</a>
            </div>
        </div>
        <div class="d-header-content">
            <div class="d-h-content-left">
                {'msGallery' | snippet}
            </div>
            <div class="d-h-content-right">
                <div class="info-row info-row-first">
                    <div class="info-col">
                        <div class="info-text">
                            <div class="info-cost">{$price} {'ms2_frontend_currency' | lexicon}</div>
                        </div>
                        <input type="hidden" name="count" id="product_price" class="input-sm form-control" value="1"/>
                    </div>
                    <div class="info-col">
                        <div class="form-group row align-items-center">
                            <button type="submit" class="btn btn-primary btn--green" name="ms2_action" value="cart/add">
                                <img src="/template/images/white-cart.png" alt="">
                                Купить
                            </button>
                        </div>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-col">
                        <div class="info-label">Цена без скидки</div>
                        <div class="info-text">
                            <div class="info-cost">{$old_price} {'ms2_frontend_currency' | lexicon}</div>
                        </div>
                    </div>
                    <div class="info-col sale">
                        <div class="info-label">Скидка</div>
                        <div class="info-text">
                            <div class="discount">{round(100 - ($price / $old_price * 100))}%</div>
                        </div>
                    </div>
                    <div class="info-col">
                        <div class="info-label">Экономия</div>
                        <div class="info-text">
                            <div class="economy">{$old_price-$price} {'ms2_frontend_currency' | lexicon}</div>
                        </div>
                    </div>
                </div>
                <div class="info-row info-row-icon icon-time">
                    <div class="info-col">
                        <div class="info-label">На покупку купона осталось:</div>
                        <div class="info-text">
                            <div class="end-date">
                                <time datetime="2018-12-14T11:37:02Z" class="datetime">00дн. 00:00:00</time>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="info-row painted info-row-icon icon-man">
                    <div class="info-col">
                        <div class="info-label">Уже купили:</div>
                        <div class="info-text">?? купонов</div>
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
        <li class="nav-item active" data-toggle="tab" href="#text" role="tab"><a class="nav-link">УСЛОВИЯ И ОСОБЕННОСТИ</a></li>
        <li class="nav-item nav-item--quantity">
            <a class="nav-link" href="{$_modx->resource.companyUrl}">ОТЗЫВЫ</a>
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
                        <div class="promotion-organisation">
                            <div class="promotion-organisation-row promotion-organisation-row--address">
                                {$_modx->resource.companyAdress}
                            </div>
                            <div class="promotion-organisation-row">
                                <div class="promotion-organisation-phone"><a href="tel:{$_modx->resource.companyPhone};">{$_modx->resource.companyPhone};</a></div>
                            </div>
                            <div class="promotion-organisation-row">
                                <div class="promotion-organisation-row-worktime">{$_modx->resource.companyWorktime}</div>
                            </div>
                        </div>
                        <div class="promotion-organisation-row promotion-organisation-row--last promotion-organisation-row--link">
                            <div class="social-link-text">Социальные сети:</div>
                            <a class="vk-link" href="{$_modx->resource.vkUrl}"></a>
                            <a class="insta-link" href="{$_modx->resource.instaUrl}"></a>
                            <a class="tlgrm-link" href="{$_modx->resource.tlgrmUrl}"></a>
                        </div>
                    </div>
                </div>
                <div class="text-formatted">
                    [[*content-right]]
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-promo">
    <div class="d-promo-left">
        <div class="content-inner">
            <div class="text-formatted">
                <img src="/[[*gallery-image-1]]">
                <img src="/[[*gallery-image-2]]">
                <img src="/[[*gallery-image-3]]">
            </div>
        </div>
        <div class="promo-gallery">
        </div>
    </div>
    <div class="d-promo-right">

    </div>
</div>
<div id="coupon-option" class="mfp-hide">
    {'pdoPage' | snippet : ['element' => 'msProducts']}
</div>