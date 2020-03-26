<div class="row ms2_product">
    <div class="promotion-teaser">
        <a href="{$prod_id | url}" class="promotion-teaser__image">
            {if $previewImage}
                <img class="coupon_avatar" src="{$previewImage}" data-echo="{$previewImage}" alt="{$pagetitle}" title="{$pagetitle}"/>
            {elseif $image}
                <img class="coupon_avatar" src="{$image}" data-echo="{$image}" alt="{$pagetitle}" title="{$pagetitle}"/>
            {else}
                <img class="coupon_avatar" src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png" srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x" alt="{$pagetitle}" title="{$pagetitle}"/>
            {/if}
        </a>
        <form method="post" name="set_used_form" class="set_used_form promotion-teaser__content">
            <div class="promotion-teaser-content">
                <input type="hidden" name="b_id" value="{$id}">
               {* <a href="{$prod_id | url}" style="height: 15%; color: #4a4a4a;">{$pagetitle}</a>*}
            </div>
            <b>Код: {$code}</b>
            {if $used}
                <div class="promotion__used _used">Использован</div>
            {else}
                <div class="promotion__used _setused"><button type="submit" class="js-setused">Отметить использованным</button></div>
            {/if}
            <br>
            {*<div class="promotion-teaser__price">
                <div class="promotion-teaser-footer">
                    <div class="promotion-teaser-footer-col">
                        <div class="old-price-teaser">
                            {if $old_price}
                                <span>{$old_price}</span><span style="font-size:20px;">{'ms2_frontend_currency' | lexicon}</span>
                            {/if}
                        </div>
                    </div>
                    <div class="promotion-teaser-footer-col promotion-teaser-footer-col--link" style="min-width: 52%;padding:0;">
                        <div class="new-price-teaser">
                            {$price}<span style="font-size:21px;">{'ms2_frontend_currency' | lexicon}</span>
                        </div>
                    </div>
                </div>
            </div>*}
        </form>
        {if $introtext}
            <p>
                <small>{$introtext}</small>
            </p>
        {/if}
    </div>
</div>