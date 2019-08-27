{extends 'file:templates/index.tpl'}
{block 'content'}
    <div class="kabinet-title">
        <h1>{$_modx->resource.pagetitle}</h1>
        <div class="logout-link"></div>
    </div>
    <div class="kabinet-header">
        <div class="user-info lk-header-col">
            {include 'file:chunks/User/userInfo.tpl'}
        </div>
        <div class="bonus-info lk-header-col">
            {include 'file:chunks/User/bonusInfo.tpl'}
        </div>
        <div class="balans-info lk-header-col">
            {include 'file:chunks/User/balansInfo.tpl'}
        </div>
    </div>
    <div class="kabinet-column">
        <div class="kabinet-column-left">
            <div class="left-content">
                <div class="sidebar-header">
                    <div class="sidebar-header-title">
                        <a href="{16 | url}" class="sidebar-body-title-link lk-current-page">Профиль</a>
                    </div>
                </div>
                <div class="sidebar-body sidebar-body--dotted">
                    <div class="sidebar-body-title">
                        <a href="#" class="sidebar-body-title-link">Купоны</a>
                        {'@FILE snippets/orders.php' | snippet}
                    </div>
                </div>
                <div class="sidebar-body">
                    <div class="sidebar-body-title">
                        <a href="{35 | url}" class="sidebar-body-title-link">Бонусная программа</a>
                    </div>
                    <div class="sidebar-body-title">
                        <a href="#" class="sidebar-body-title-link">Партнерская программа</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kabinet-column-right">
            <div class="right-content">
                {$_modx->resource.content}
            </div>
        </div>
    </div>
{/block}