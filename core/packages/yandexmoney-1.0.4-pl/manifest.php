<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'Лицензионный договор.

Любое использование Вами программы означает полное и безоговорочное принятие Вами условий лицензионного договора,
размещенного по адресу https://money.yandex.ru/doc.xml?id=527132 (далее – «Лицензионный договор»). Если Вы не
принимаете условия Лицензионного договора в полном объёме, Вы не имеете права использовать программу в
каких-либо целях.',
    'readme' => '--------------------
Extra: YandexMoney
--------------------
Version: 2.0

Инструкция для работы с модулем.

После установки модуля необходимо:
1. В чанке формы заказа, в списке способов оплаты указать [[!YandexMoney?&action=`showMethods`]]
Т.е., например, в чанке shopOrderForm будет:
```
<select name="payment" style="width:200px;">
	<option value="При получении" [[!+fi.payment:FormItIsSelected=`При получении`]]>При получении</option>
        [[!YandexMoney? &action=`showMethods` ]]
</select>
```
2. В чанке страницы заказа, в список хуков FormIt добавить YandexMoneyHook
Т.е., например, чанк orderform_page
```
[[!FormIt?
&hooks=`spam,shk_fihook,YandexMoneyHook,email,FormItAutoResponder,redirect`
&submitVar=`order`
&emailTpl=`shopOrderReport`
&fiarTpl=`shopOrderReport`
&emailSubject=`В интернет-магазине "[[++site_name]]" сделан новый заказ`
&fiarSubject=`Вы сделали заказ в интернет-магазине "[[++site_name]]"`
&emailTo=`[[++emailsender]]`
&redirectTo=`25`
&validate=`address:required,fullname:required,email:email:required,phone:required`
&errTpl=`<br /><span class="error">[[+error]]</span>`
]]
```
3. Создать 2 страницы: для успешно завершенного платежа и неуспешно завершенного. Указать их ID документа в параметрах сниппета YandexMoney.

4. Указать настройки магазина в параметрах сниппета YandexMoney.
',
    'changelog' => 'Changelog file for YandexMoney component.
 
YandexMoney 2.0.0
====================================

### v1.0.2 от 05.06.2018
* Добавлена отправка описания платежа в ЛК Яндекс.Кассы

### v1.0.1 от 03.05.2018
* Актуализация PHP SDK до версии 1.0.9
* Добавлен метод "Заплатить по частям"

### v1.0.0 от 20.04.2018
* Добавлена возможность оплаты с помощью PHP SDK через API Яндекс.Кассы

',
    'setup-options' => 'yandexmoney-1.0.4-pl/setup-options.php',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'a97438ead472491f5acdbddc37353f6d',
      'native_key' => 'yandexmoney',
      'filename' => 'modNamespace/c6da70a289b9d24d0fc25eca25f36c94.vehicle',
      'namespace' => 'yandexmoney',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '35f551d60a8b51e730e71954c1c3dc91',
      'native_key' => 1,
      'filename' => 'modCategory/d766817c7b6045e39203462998c69e2d.vehicle',
      'namespace' => 'yandexmoney',
    ),
  ),
);