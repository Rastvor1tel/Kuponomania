<div class="footer">
    <div class="footer-wrapper">
        <div class="footer-content">
            <div class="content-wrapper">
                <div class="footer-column footer-support">
                    <div class="footer-column-name"><span></span>Тех. поддержка сайта
                    </div>
                    <ul>
                        <li class="large-text phone">{'phone' | option}</li>
                        <li style="display: none;">с 9.00 до 21.00<br>по московскому времени</li>
                        <li class="large-text"><a href="emailto:{'email' | option}">{'email' | option}</a></li>
                    </ul>
                </div>
                <div class="footer-column footer-info">
                    <div class="footer-column-name"><span></span>Информация</div>
                    {'pdoMenu' | snippet : [
                    'parents' => 18,
                    'level' => '1',
                    'tplOuter' => '@INLINE <ul class="info-links-list">[[+wrapper]]</ul>',
                    'tpl' => '@INLINE <li><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a></li>',
                    'tplHere' => '@INLINE <li><span [[+attributes]]>[[+menutitle]]</span></li>'
                    ]}
                </div>
                <div class="footer-column footer-social">
                    <div class="footer-column-name"><span></span>Мы в социальных сетях</div>
                    <ul class="social">
                        <li><a target="_blank" class="social-link link-telegram" href="{'telegram' | option}"></a></li>
                        <li><a target="_blank" class="social-link link-vk" href="{'vk' | option}"></a></li>
                        <li><a target="_blank" class="social-link link-instagram" href="{'inst' | option}"></a></li>
                    </ul>
                    <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Связаться с нами</button>
                </div>
            </div>
        </div>
        <div class="footer-subscribe" style="display: none;">
            <div class="subscribe-wrapper">
                <p class="column-name">
                    Сэкономьте до 90% при любых покупках
                    <br>
                    Подпишитесь на самые выгодные предложения
                </p>
                <form accept-charset="UTF-8" action="/user_subscriptions" method="post">
                    <fieldset>
                        <input class="subscribeinput" id="subscription_email" name="subscription[email]" placeholder="Введите ваш email" type="text" value="">
                        <a href="http://kuponomaniya.ru/logingo"><input class="button" name="commit" type="submit" value="Начать экономить!"></a>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- МОДАЛЬНАЯ ФОРМА ОБРАТНОЙ СВЯЗИ -->
{'!AjaxForm' | snippet : [
'form'=>'@FILE chunks/AjaxForm/form.tpl',
'snippet'=>'FormIt',
'hooks'=>'FormItSaveForm,email',
'emailSubject'=>'Тестовое сообщение',
'emailTo'=>'kuponomaniya@inbox.ru',
'emailFrom'=>'no-reply@kuponomaniya.ru',
'emailTpl'=>'@FILE chunks/AjaxForm/email.tpl',
'validate'=>'name:required,email:email:required,message:required',
'validationErrorMessage'=>'В форме содержатся ошибки!',
'successMessage'=>'Сообщение успешно отправлено'
]}