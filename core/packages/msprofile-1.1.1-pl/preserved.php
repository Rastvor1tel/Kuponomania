<?php return array (
  'f2cc974f8bee1696a3c839131ca5c7f0' => 
  array (
    'criteria' => 
    array (
      'name' => 'msprofile',
    ),
    'object' => 
    array (
      'name' => 'msprofile',
      'path' => '{core_path}components/msprofile/',
      'assets_path' => '',
    ),
  ),
  '51c1138a602ac2cbff1e9432754e2f52' => 
  array (
    'criteria' => 
    array (
      'category' => 'msProfile',
    ),
    'object' => 
    array (
      'id' => 25,
      'parent' => 0,
      'category' => 'msProfile',
      'rank' => 0,
    ),
  ),
  '11a6e784289aa1944503a2874fa36254' => 
  array (
    'criteria' => 
    array (
      'name' => 'tpl.msProfile.charge.form',
    ),
    'object' => 
    array (
      'id' => 81,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'tpl.msProfile.charge.form',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '<form action="[[~[[*id]]]]" method="post">
    <div class="form-group">
        <label for="sum">[[%ms2_profile_enter_sum]]</label>
        <input type="text" class="form-control" name="sum" id="sum" value="[[+sum]]"/>
        <div class="error">[[+error_sum]]</div>
    </div>

    <div class="form-group">
        <label>[[%ms2_profile_select_payment]]</label>
        [[+payments]]
        <div class="error">[[+error_payment ]]</div>
    </div>
    [[+error]]
    <input type="hidden" name="action" value="profile_charge"/>
    <input type="submit" class="btn btn-primary" value="[[%ms2_profile_pay]]"/>
</form>
<!--minishop2_error <div class="alert alert-danger">[[+error]]</div>-->',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => 'core/components/msprofile/elements/chunks/chunk.charge_form.tpl',
      'content' => '<form action="[[~[[*id]]]]" method="post">
    <div class="form-group">
        <label for="sum">[[%ms2_profile_enter_sum]]</label>
        <input type="text" class="form-control" name="sum" id="sum" value="[[+sum]]"/>
        <div class="error">[[+error_sum]]</div>
    </div>

    <div class="form-group">
        <label>[[%ms2_profile_select_payment]]</label>
        [[+payments]]
        <div class="error">[[+error_payment ]]</div>
    </div>
    [[+error]]
    <input type="hidden" name="action" value="profile_charge"/>
    <input type="submit" class="btn btn-primary" value="[[%ms2_profile_pay]]"/>
</form>
<!--minishop2_error <div class="alert alert-danger">[[+error]]</div>-->',
    ),
  ),
  '831a33f55f4f57f820792774bc3c9a40' => 
  array (
    'criteria' => 
    array (
      'name' => 'tpl.msProfile.charge.payment',
    ),
    'object' => 
    array (
      'id' => 82,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'tpl.msProfile.charge.payment',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '<div class="radio">
    <label>
        <input type="radio" name="payment" value="[[+id]]" id="payment_[[+id]]" [[+checked]]/>
        [[+logo:default=`[[+name]]`]]
        [[+description]]
    </label>
</div>
<!--minishop2_logo <img src="[[+logo]]" />-->
<!--minishop2_description <p><small>[[+description]]</small></p>-->',
      'locked' => 0,
      'properties' => NULL,
      'static' => 0,
      'static_file' => 'core/components/msprofile/elements/chunks/chunk.payment_row.tpl',
      'content' => '<div class="radio">
    <label>
        <input type="radio" name="payment" value="[[+id]]" id="payment_[[+id]]" [[+checked]]/>
        [[+logo:default=`[[+name]]`]]
        [[+description]]
    </label>
</div>
<!--minishop2_logo <img src="[[+logo]]" />-->
<!--minishop2_description <p><small>[[+description]]</small></p>-->',
    ),
  ),
  '16dbf2c4dd3f3a29ef6ce061b29b7d25' => 
  array (
    'criteria' => 
    array (
      'name' => 'msProfile',
    ),
    'object' => 
    array (
      'id' => 119,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'msProfile',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/** @var array $scriptProperties */
/** @var msProfile $msProfile */
$msProfile = $modx->getService(\'msprofile\', \'msProfile\', MODX_CORE_PATH . \'components/msprofile/model/msprofile/\',
    $scriptProperties
);
if (!($msProfile instanceof msProfile)) {
    return \'\';
}
if (!$modx->user->isAuthenticated($modx->context->key)) {
    return $modx->lexicon(\'ms2_profile_err_auth\');
}
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService(\'pdoFetch\');
$pdoFetch->setConfig($scriptProperties);

if (empty($id)) {
    $id = $modx->user->get(\'id\');
}

if ($profile = $modx->getObject(\'msCustomerProfile\', $id)) {
    return empty($tpl)
        ? \'<pre>\' . $pdoFetch->getChunk(\'\', $profile->toArray()) . \'</pre>\'
        : $pdoFetch->getChunk($tpl, $profile->toArray());
}',
      'locked' => 0,
      'properties' => 'a:2:{s:2:"id";a:7:{s:4:"name";s:2:"id";s:4:"desc";s:17:"msprofile_prop_id";s:4:"type";s:11:"numberfield";s:7:"options";a:0:{}s:5:"value";i:0;s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:18:"msprofile_prop_tpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/msprofile/elements/snippets/snippet.msprofile.php',
      'content' => '/** @var array $scriptProperties */
/** @var msProfile $msProfile */
$msProfile = $modx->getService(\'msprofile\', \'msProfile\', MODX_CORE_PATH . \'components/msprofile/model/msprofile/\',
    $scriptProperties
);
if (!($msProfile instanceof msProfile)) {
    return \'\';
}
if (!$modx->user->isAuthenticated($modx->context->key)) {
    return $modx->lexicon(\'ms2_profile_err_auth\');
}
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService(\'pdoFetch\');
$pdoFetch->setConfig($scriptProperties);

if (empty($id)) {
    $id = $modx->user->get(\'id\');
}

if ($profile = $modx->getObject(\'msCustomerProfile\', $id)) {
    return empty($tpl)
        ? \'<pre>\' . $pdoFetch->getChunk(\'\', $profile->toArray()) . \'</pre>\'
        : $pdoFetch->getChunk($tpl, $profile->toArray());
}',
    ),
  ),
  '1cbf65de849286af8e197153d8e76970' => 
  array (
    'criteria' => 
    array (
      'name' => 'msProfileCharge',
    ),
    'object' => 
    array (
      'id' => 120,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'msProfileCharge',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'snippet' => '/** @var array $scriptProperties */
/** @var msProfile $msProfile */
$msProfile = $modx->getService(\'msprofile\', \'msProfile\', MODX_CORE_PATH . \'components/msprofile/model/msprofile/\',
    $scriptProperties
);
if (!($msProfile instanceof msProfile)) {
    return \'\';
}
if (!$modx->user->isAuthenticated($modx->context->key)) {
    return $modx->lexicon(\'ms2_profile_err_auth\');
}
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService(\'pdoFetch\');
$pdoFetch->setConfig($scriptProperties);

$minSum = $modx->getOption(\'minSum\', $scriptProperties, 200);
$maxSum = $modx->getOption(\'maxSum\', $scriptProperties, 0);
$outputSeparator = $modx->getOption(\'outputSeparator\', $scriptProperties, "\\n");
$tplOrder = $modx->getOption(\'tplOrder\', $scriptProperties, \'tpl.msOrder.success\');
$tplPayment = $modx->getOption(\'tplPayment\', $scriptProperties, \'tpl.msProfile.charge.payment\');
$tplForm = $modx->getOption(\'tplForm\', $scriptProperties, \'tpl.msProfile.charge.form\');

if (!empty($_GET[\'msorder\'])) {
    if ($order = $modx->getObject(\'msOrder\', $_GET[\'msorder\'])) {
        if ((!empty($_SESSION[\'minishop2\'][\'orders\']) && in_array($_GET[\'msorder\'],
                    $_SESSION[\'minishop2\'][\'orders\'])) || $order->get(\'user_id\') == $modx->user->id || $modx->context->key == \'mgr\'
        ) {
            return $pdoFetch->getChunk($tplOrder, array(\'id\' => $_GET[\'msorder\']));
        }
    }
}

$error = \'\';
$errors = array();
if (!empty($_POST[\'action\']) && $_POST[\'action\'] == \'profile_charge\') {
    $response = $msProfile->createPayment($_POST);
    if (!$response[\'success\']) {
        $error = $response[\'message\'];
        $errors = $response[\'data\'];
    }
}

$where = array(\'class:NOT LIKE\' => \'CustomerAccount%\', \'class:!=\' => \'\');
if (empty($showInactive)) {
    $where[\'active\'] = true;
}
if (!empty($payments)) {
    $payments = array_map(\'trim\', explode(\',\', $payments));
    $in = $out = array();
    foreach ($payments as $payment) {
        if ($payment > 0) {
            $in[] = $payment;
        } elseif ($payment < 0) {
            $out[] = abs($payment);
        }
    }
    if (!empty($in)) {
        $where[\'id:IN\'] = $in;
    } elseif (!empty($out)) {
        $where[\'id:NOT IN\'] = $out;
    }
}

// Add custom parameters
foreach (array(\'where\') as $v) {
    if (!empty($scriptProperties[$v])) {
        $tmp = is_string($scriptProperties[$v])
            ? json_decode($scriptProperties[$v], true)
            : $scriptProperties[$v];
        if (is_array($tmp)) {
            $$v = array_merge($$v, $tmp);
        }
    }
    unset($scriptProperties[$v]);
}

$options = array(
    \'class\' => \'msPayment\',
    \'where\' => $where,
    \'sortby\' => \'rank\',
    \'sortdir\' => \'ASC\',
    \'nestedChunkPrefix\' => \'minishop2_\',
);

// Merge all properties and run!
$pdoFetch->addTime(\'Query parameters are prepared.\');
$pdoFetch->setConfig(array_merge($options, $scriptProperties));

$methods = $pdoFetch->getCollection(\'msPayment\', $where, $options);
if (empty($methods)) {
    return $modx->lexicon(\'ms2_profile_err_payments\');
}
$payments = array();
foreach ($methods as $key => $method) {
    $method[\'checked\'] = (empty($_POST[\'payment\']) && $key == 0) || (!empty($_POST[\'payment\']) && $_POST[\'payment\'] == $method[\'id\'])
        ? \'checked\'
        : \'\';
    $payments[] = $pdoFetch->getChunk($tplPayment, $method);
}
$payments = implode($outputSeparator, $payments);

$data = array(
    \'payments\' => $payments,
    \'sum\' => !empty($_POST[\'sum\'])
        ? $_POST[\'sum\']
        : $minSum,
    \'min_sum\' => $minSum,
    \'max_sum\' => $maxSum,
    \'error\' => $error,
);
foreach ($errors as $key => $error) {
    $data[\'error_\' . $key] = $error;
}

return $pdoFetch->getChunk($tplForm, $data);',
      'locked' => 0,
      'properties' => 'a:11:{s:7:"tplForm";a:7:{s:4:"name";s:7:"tplForm";s:4:"desc";s:22:"msprofile_prop_tplForm";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:25:"tpl.msProfile.charge.form";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:10:"tplPayment";a:7:{s:4:"name";s:10:"tplPayment";s:4:"desc";s:25:"msprofile_prop_tplPayment";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:28:"tpl.msProfile.charge.payment";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:8:"tplOrder";a:7:{s:4:"name";s:8:"tplOrder";s:4:"desc";s:23:"msprofile_prop_tplOrder";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:19:"tpl.msOrder.success";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:8:"payments";a:7:{s:4:"name";s:8:"payments";s:4:"desc";s:23:"msprofile_prop_payments";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:6:"sortby";a:7:{s:4:"name";s:6:"sortby";s:4:"desc";s:21:"msprofile_prop_sortby";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:5:"order";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:7:"sortdir";a:7:{s:4:"name";s:7:"sortdir";s:4:"desc";s:22:"msprofile_prop_sortdir";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:3:"ASC";s:5:"value";s:3:"ASC";}i:1;a:2:{s:4:"text";s:4:"DESC";s:5:"value";s:4:"DESC";}}s:5:"value";s:3:"ASC";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:5:"limit";a:7:{s:4:"name";s:5:"limit";s:4:"desc";s:20:"msprofile_prop_limit";s:4:"type";s:11:"numberfield";s:7:"options";a:0:{}s:5:"value";i:0;s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:15:"outputSeparator";a:7:{s:4:"name";s:15:"outputSeparator";s:4:"desc";s:30:"msprofile_prop_outputSeparator";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:1:"
";s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:6:"minSum";a:7:{s:4:"name";s:6:"minSum";s:4:"desc";s:21:"msprofile_prop_minSum";s:4:"type";s:11:"numberfield";s:7:"options";a:0:{}s:5:"value";i:200;s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:6:"maxSum";a:7:{s:4:"name";s:6:"maxSum";s:4:"desc";s:21:"msprofile_prop_maxSum";s:4:"type";s:11:"numberfield";s:7:"options";a:0:{}s:5:"value";i:0;s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}s:12:"showInactive";a:7:{s:4:"name";s:12:"showInactive";s:4:"desc";s:27:"msprofile_prop_showInactive";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:1;s:7:"lexicon";s:20:"msprofile:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/msprofile/elements/snippets/snippet.msprofile_charge.php',
      'content' => '/** @var array $scriptProperties */
/** @var msProfile $msProfile */
$msProfile = $modx->getService(\'msprofile\', \'msProfile\', MODX_CORE_PATH . \'components/msprofile/model/msprofile/\',
    $scriptProperties
);
if (!($msProfile instanceof msProfile)) {
    return \'\';
}
if (!$modx->user->isAuthenticated($modx->context->key)) {
    return $modx->lexicon(\'ms2_profile_err_auth\');
}
/** @var pdoFetch $pdoFetch */
$pdoFetch = $modx->getService(\'pdoFetch\');
$pdoFetch->setConfig($scriptProperties);

$minSum = $modx->getOption(\'minSum\', $scriptProperties, 200);
$maxSum = $modx->getOption(\'maxSum\', $scriptProperties, 0);
$outputSeparator = $modx->getOption(\'outputSeparator\', $scriptProperties, "\\n");
$tplOrder = $modx->getOption(\'tplOrder\', $scriptProperties, \'tpl.msOrder.success\');
$tplPayment = $modx->getOption(\'tplPayment\', $scriptProperties, \'tpl.msProfile.charge.payment\');
$tplForm = $modx->getOption(\'tplForm\', $scriptProperties, \'tpl.msProfile.charge.form\');

if (!empty($_GET[\'msorder\'])) {
    if ($order = $modx->getObject(\'msOrder\', $_GET[\'msorder\'])) {
        if ((!empty($_SESSION[\'minishop2\'][\'orders\']) && in_array($_GET[\'msorder\'],
                    $_SESSION[\'minishop2\'][\'orders\'])) || $order->get(\'user_id\') == $modx->user->id || $modx->context->key == \'mgr\'
        ) {
            return $pdoFetch->getChunk($tplOrder, array(\'id\' => $_GET[\'msorder\']));
        }
    }
}

$error = \'\';
$errors = array();
if (!empty($_POST[\'action\']) && $_POST[\'action\'] == \'profile_charge\') {
    $response = $msProfile->createPayment($_POST);
    if (!$response[\'success\']) {
        $error = $response[\'message\'];
        $errors = $response[\'data\'];
    }
}

$where = array(\'class:NOT LIKE\' => \'CustomerAccount%\', \'class:!=\' => \'\');
if (empty($showInactive)) {
    $where[\'active\'] = true;
}
if (!empty($payments)) {
    $payments = array_map(\'trim\', explode(\',\', $payments));
    $in = $out = array();
    foreach ($payments as $payment) {
        if ($payment > 0) {
            $in[] = $payment;
        } elseif ($payment < 0) {
            $out[] = abs($payment);
        }
    }
    if (!empty($in)) {
        $where[\'id:IN\'] = $in;
    } elseif (!empty($out)) {
        $where[\'id:NOT IN\'] = $out;
    }
}

// Add custom parameters
foreach (array(\'where\') as $v) {
    if (!empty($scriptProperties[$v])) {
        $tmp = is_string($scriptProperties[$v])
            ? json_decode($scriptProperties[$v], true)
            : $scriptProperties[$v];
        if (is_array($tmp)) {
            $$v = array_merge($$v, $tmp);
        }
    }
    unset($scriptProperties[$v]);
}

$options = array(
    \'class\' => \'msPayment\',
    \'where\' => $where,
    \'sortby\' => \'rank\',
    \'sortdir\' => \'ASC\',
    \'nestedChunkPrefix\' => \'minishop2_\',
);

// Merge all properties and run!
$pdoFetch->addTime(\'Query parameters are prepared.\');
$pdoFetch->setConfig(array_merge($options, $scriptProperties));

$methods = $pdoFetch->getCollection(\'msPayment\', $where, $options);
if (empty($methods)) {
    return $modx->lexicon(\'ms2_profile_err_payments\');
}
$payments = array();
foreach ($methods as $key => $method) {
    $method[\'checked\'] = (empty($_POST[\'payment\']) && $key == 0) || (!empty($_POST[\'payment\']) && $_POST[\'payment\'] == $method[\'id\'])
        ? \'checked\'
        : \'\';
    $payments[] = $pdoFetch->getChunk($tplPayment, $method);
}
$payments = implode($outputSeparator, $payments);

$data = array(
    \'payments\' => $payments,
    \'sum\' => !empty($_POST[\'sum\'])
        ? $_POST[\'sum\']
        : $minSum,
    \'min_sum\' => $minSum,
    \'max_sum\' => $maxSum,
    \'error\' => $error,
);
foreach ($errors as $key => $error) {
    $data[\'error_\' . $key] = $error;
}

return $pdoFetch->getChunk($tplForm, $data);',
    ),
  ),
  '83d64d8eb2184b99a464d8981e08b7f0' => 
  array (
    'criteria' => 
    array (
      'name' => 'msProfile',
    ),
    'object' => 
    array (
      'id' => 30,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'msProfile',
      'description' => '',
      'editor_type' => 0,
      'category' => 25,
      'cache_type' => 0,
      'plugincode' => 'switch ($modx->event->name) {

    case \'OnManagerPageBeforeRender\':
        if ($_GET[\'a\'] == \'mgr/orders\' && $_GET[\'namespace\'] == \'minishop2\') {
            /** @var msProfile $msProfile */
            $msProfile = $modx->getService(\'msprofile\', \'msProfile\',
                MODX_CORE_PATH . \'components/msprofile/model/msprofile/\'
            );
            $msProfile->loadManagerFiles($modx->controller);
        }
        break;

    case \'msOnChangeOrderStatus\':
        if (empty($status) || $status != 2) {
            return;
        }
        /** @var msOrder $order */
        $properties = $order->get(\'properties\');
        if (empty($properties[\'account_charge\'])) {
            return;
        } /** @var modUser $user */
        elseif ($user = $order->getOne(\'User\')) {
            /** @var msCustomerProfile $profile */
            if ($profile = $order->getOne(\'CustomerProfile\')) {
                $profile->set(\'account\', $profile->get(\'account\') + $order->get(\'cost\'));
                $profile->save();
            }
            unset($properties[\'account_charge\']);
            $order->set(\'properties\', $properties);
            $order->save();
        }
        break;

    case \'msOnBeforeCreateOrder\':
        /** @var msOrder $msOrder */
        if ($payment = $msOrder->getOne(\'Payment\')) {
            $class = $payment->get(\'class\');
            if (preg_match(\'/^CustomerAccount/i\', $class)) {
                /** @var msPayment $payment */
                $payment->loadHandler();
                if ($payment->handler instanceof CustomerAccount && !$payment->handler->check($msOrder)) {
                    $modx->lexicon->load(\'msprofile:default\');
                    $modx->event->output($modx->lexicon(\'ms2_profile_err_balance\'));
                }
            }
        }
        break;

}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/msprofile/elements/plugins/plugin.msprofile.php',
      'content' => 'switch ($modx->event->name) {

    case \'OnManagerPageBeforeRender\':
        if ($_GET[\'a\'] == \'mgr/orders\' && $_GET[\'namespace\'] == \'minishop2\') {
            /** @var msProfile $msProfile */
            $msProfile = $modx->getService(\'msprofile\', \'msProfile\',
                MODX_CORE_PATH . \'components/msprofile/model/msprofile/\'
            );
            $msProfile->loadManagerFiles($modx->controller);
        }
        break;

    case \'msOnChangeOrderStatus\':
        if (empty($status) || $status != 2) {
            return;
        }
        /** @var msOrder $order */
        $properties = $order->get(\'properties\');
        if (empty($properties[\'account_charge\'])) {
            return;
        } /** @var modUser $user */
        elseif ($user = $order->getOne(\'User\')) {
            /** @var msCustomerProfile $profile */
            if ($profile = $order->getOne(\'CustomerProfile\')) {
                $profile->set(\'account\', $profile->get(\'account\') + $order->get(\'cost\'));
                $profile->save();
            }
            unset($properties[\'account_charge\']);
            $order->set(\'properties\', $properties);
            $order->save();
        }
        break;

    case \'msOnBeforeCreateOrder\':
        /** @var msOrder $msOrder */
        if ($payment = $msOrder->getOne(\'Payment\')) {
            $class = $payment->get(\'class\');
            if (preg_match(\'/^CustomerAccount/i\', $class)) {
                /** @var msPayment $payment */
                $payment->loadHandler();
                if ($payment->handler instanceof CustomerAccount && !$payment->handler->check($msOrder)) {
                    $modx->lexicon->load(\'msprofile:default\');
                    $modx->event->output($modx->lexicon(\'ms2_profile_err_balance\'));
                }
            }
        }
        break;

}',
    ),
  ),
  'd3565860ff8fac571f43e25b2828f564' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7bf9fbf58667f89252de825ac4a2644b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'msOnChangeOrderStatus',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'msOnChangeOrderStatus',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '188717d20755dcd8b5337fbd8234e4a5' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 30,
      'event' => 'msOnBeforeCreateOrder',
    ),
    'object' => 
    array (
      'pluginid' => 30,
      'event' => 'msOnBeforeCreateOrder',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);