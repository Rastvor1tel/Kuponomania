<div class="toolbar">
    <div class="toolbar-wrapper">
        <div class="menu-left">
            <ul class="menu-group">
                <li class="menu-splitter"></li>
                <li class="menu-item--city resolved_city_id">
                    <a class="role-city-toggle" href="">
                        <i class="icon--city"></i>Новомосковск<span class="menu-item-trigger"></span></a>
                </li>
                <li class="menu-splitter"></li>
                <li class="menu-item menu-phone-support">
                    {'phone' | option}
                    <div class="phone-hint">
                        <div class="b-text"></div>
                    </div>
                </li>
                <li class="menu-splitter splitter-margin"></li>
            </ul>
        </div>
        <div class="menu-right">
            <ul class="menu-group menu-group--account">
                <li class="menu-splitter"></li>
                <li class="menu-item menu-cart">
                    <a href="[[~17]]" style="text-decoration: none;">{'!msMiniCart' | snippet : ['tpl' => '@FILE chunks/MiniShop/miniCart.tpl']}</a>
                </li>
                <li class="menu-splitter"></li>
                <li class="menu-item">
                    {if $_modx->isAuthenticated('web')}
                        {include 'file:chunks/Login/headerLk.tpl'}
                    {else}
                        {include 'file:chunks/Login/headerLogin.tpl'}
                    {/if}
                </li>
                <li class="menu-splitter"></li>
            </ul>
        </div>
    </div>
</div>