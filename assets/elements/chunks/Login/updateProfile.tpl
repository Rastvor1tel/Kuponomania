{'!UpdateProfile' | snippet : [
    'validate' => 'fullname:required',
    'preHooks' => 'loadUserPhoto'
]}
<div class="change-info">
    <div class="panel-body">
        <div class="updprof-error">[[+error.message]]</div>
        [[+login.update_success:is=`1`:then=`[[%login.profile_updated? &namespace=`login` &topic=`updateprofile`]]`]]
        <form id="updateProfile" action="[[~[[*id]]]]" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="nospam" value="">
            <div class="form-group">
                <label for="fullname" class="col-sm-4 control-label">[[!%login.fullname? &namespace=`login` &topic=`updateprofile`]]</label>
                <div class="col-sm-8">
                    <input type="text" name="fullname" class="form-control" id="fullname" value="[[+fullname]]">
                    <span class="help-block text-error">
                        [[+error.fullname]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="phone" class="col-sm-4 control-label">[[!%login.phone]]</label>
                <div class="col-sm-8">
                    <input type="text" name="phone" class="form-control" id="phone" value="[[+phone]]">
                    <span class="help-block text-error">
                        [[+error.phone]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="mobilephone" class="col-sm-4 control-label">[[!%login.mobilephone]]</label>
                <div class="col-sm-8">
                    <input type="text" name="mobilephone" class="form-control" id="mobilephone" value="[[+mobilephone]]">
                    <span class="help-block text-error">
                        [[+error.mobilephone]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="address" class="col-sm-4 control-label">[[!%login.address]]</label>
                <div class="col-sm-8">
                    <input type="text" name="address" class="form-control" id="address" value="[[+address]]">
                    <span class="help-block text-error">
                        [[+error.address]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="country" class="col-sm-4 control-label">[[!%login.country]]</label>
                <div class="col-sm-8">
                    <input type="text" name="country" class="form-control" id="country" value="[[+country]]">
                    <span class="help-block text-error">
                        [[+error.country]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="city" class="col-sm-4 control-label">[[!%login.city]]</label>
                <div class="col-sm-8">
                    <input type="text" name="city" class="form-control" id="city" value="[[+city]]">
                    <span class="help-block text-error">
                        [[+error.city]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="website" class="col-sm-4 control-label">[[!%login.website]]</label>
                <div class="col-sm-8">
                    <input type="text" name="website" class="form-control" id="website" value="[[+website]]">
                    <span class="help-block text-error">
                        [[+error.website]]
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label for="photo" class="col-sm-4 control-label" style="padding-top: 0px; padding-bottom: 6px;">Фото</label>
                <div class="col-sm-8" style="padding-top: 0px; padding-bottom: 6px;">
                    <input class="btn--green" type="file" id="photo" name="photo" value="[[+photo]]">
                    <div id="img-error"></div>
                </div>
            </div>
            <input type="submit" value="Удалить фото" name="delete-photo-btn" id="login-updprof-btn" class="btn btn-primary pull-left btn--green">
            <input type="submit" value="[[!%login.update_profile]]" name="login-updprof-btn" id="login-updprof-btn" class="btn btn-primary pull-right btn--green">
        </form>
    </div>
</div>