<!DOCTYPE html>
<html lang="ru">
    <head>
        {include 'file:chunks/meta.tpl'}
    </head>
    <body>
    {include 'file:chunks/header.tpl'}
    <div class="container">
        <div class="content-wrapper">
            {include 'file:chunks/logo.tpl'}
            {include 'file:chunks/category.tpl'}
            <div class="content">
                <div class="p-deal_containers">
                    {block 'content'}
                    {/block}
                </div>
            </div>
        </div>
    </div>
    {include 'file:chunks/footer.tpl'}
    {include 'file:chunks/scripts.tpl'}
    </body>
</html>