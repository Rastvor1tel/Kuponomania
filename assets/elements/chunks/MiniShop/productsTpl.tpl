<div class="row ms2_product">
    <div class="promotion-teaser">
        <a href="{$id | url}" class="promotion-teaser__image">
            {if $image?}
                <img class="coupon_avatar" src="{$thumb}" data-echo="{$image}" alt="{$pagetitle}" title="{$pagetitle}"/>
            {else}
                <img class="coupon_avatar" src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png" srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x" alt="{$pagetitle}" title="{$pagetitle}"/>
            {/if}
        </a>
        <form method="post" class="ms2_form promotion-teaser__content">
            <div class="promotion-teaser-content">
                <input type="hidden" name="id" value="{$id}">
                <input type="hidden" name="count" value="1">
                <input type="hidden" name="options" value="[]">
                <a href="{$id | url}" style="height: 15%; color: #4a4a4a;">[[+pagetitle]]</a>
                <span class="flags">
                    {if $new}
                        <i class="glyphicon glyphicon-flag" title="{'ms2_frontend_new' | lexicon}"></i>
                    {/if}
                    {if $popular}
                        <i class="glyphicon glyphicon-star" title="{'ms2_frontend_popular' | lexicon}"></i>
                    {/if}
                    {if $favorite}
                        <i class="glyphicon glyphicon-bookmark" title="{'ms2_frontend_favorite' | lexicon}"></i>
                    {/if}
                </span>
            </div>
            <div class="promotion-teaser__price">
                <div class="promotion-teaser-footer">
                    <div class="promotion-teaser-footer-col">
                        <div class="old-price-teaser">
                            {if $old_price}
                                <span>{$old_price}</span><span style="font-size:20px;">{'ms2_frontend_currency' | lexicon}</span>
                            {/if}
                        </div>
                    </div>
                    <div class="promotion-teaser-footer-col promotion-teaser-footer-col--link">
                        <div class="new-price-teaser">
                            {$price}<span style="font-size:20px;">{'ms2_frontend_currency' | lexicon}</span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {if $introtext}
            <p>
                <small>{$introtext}</small>
            </p>
        {/if}
    </div>
</div>