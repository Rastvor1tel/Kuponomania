<div class="change-info">
    <div class="panel-body">
        <div class="form-horizontal">
            <input type="hidden" name="nospam" value="">
            <div class="form-group">
                <div class="col-sm-4 text-right"><b>[[!%login.fullname? &namespace=`login` &topic=`updateprofile`]]</b></div>
                <div class="col-sm-8 text-left">{$_modx->user.fullname}</div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 text-right"><b>[[!%login.phone]]</b></div>
                <div class="col-sm-8 text-left">{$_modx->user.phone}</div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 text-right"><b>[[!%login.address]]</b></div>
                <div class="col-sm-8 text-left">{$_modx->user.address}</div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 text-right"><b>[[!%login.city]]</b></div>
                <div class="col-sm-8 text-left">{$_modx->user.city}</div>
            </div>
            <div class="clearfix"></div>
            <br class="clear" />
            <div class="form-buttons">
                <a class="btn btn-primary pull-right btn--green" href="{30 | url}">[[!%login.update_profile]]</a>
            </div>
        </div>
    </div>
</div>