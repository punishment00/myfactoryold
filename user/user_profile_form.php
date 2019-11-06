<?php

if(!$is_new_user)
{
    $user_res = $user_class->getSingleUser($usr_id); 
    $user_info = $user_res->fetch(PDO::FETCH_ASSOC); 

    $username = $user_info["username"]; 
    $full_name = $user_info["full_name"]; 
    $position = $user_info["position"]; 
    $language = $user_info["language"]; 
    $resign_date = $user_info["resign_date"]; 
}
else
{
    $username = ""; 
    $full_name = ""; 
    $position = ""; 
    $language = ""; 
}

?>
<div class="form-group row">
    <label class="col-2" for="username"><?= $hdlang["User_ID"]; ?>:</label>
    <div class="col-4">
        <input class="form-control form-control-sm" type="text" name="username" id="username" maxlength="20" value="<?= $username; ?>" required <?= (!$is_new_user) ? "readonly" : "" ;?> />
    </div>
</div>


<div class="form-group row">
    <label class="col-2" for="usr_password"><?= $hdlang["Password"]; ?>:</label>
    <div class="col-4">
        <input class="form-control form-control-sm" type="password" name="usr_password" id="usr_password" required <?= (!$is_new_user) ? "placeholder=\"".$hdlang["leave_blank_password"]."\"" : "" ;?> />
    </div>
</div>


<div class="form-group row">
    <label class="col-2" for="full_name"><?= $hdlang["User_Full_Name"]; ?>:</label>
    <div class="col-4">
        <input class="form-control form-control-sm" type="text" name="full_name" id="full_name" value="<?= $full_name; ?>" required />
    </div>
</div>

<div class="form-group row">
    <label class="col-2" for="position"><?= $hdlang["Position"]; ?>:</label>
    <div class="col-2">
        <select class="form-control form-control-sm" name="position" id="position">
            <option value="2" <?= ($position==2) ? "selected" : ""; ?>>Normal user</option>
            <option value="1" <?= ($position==1) ? "selected" : ""; ?>>Admin</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label class="col-2" for="language"><?= $hdlang["language"]; ?>:</label>
    <div class="col-2">
        <select class="form-control form-control-sm" name="language" id="language">
            <option value="1" <?= ($language==1) ? "selected" : ""; ?>>English</option>
            <option value="2" <?= ($language==2) ? "selected" : ""; ?>>Chinese</option>
            <option value="3" <?= ($language==3) ? "selected" : ""; ?>>Chinese (HK)</option>
            <option value="4" <?= ($language==4) ? "selected" : ""; ?>>Khmer</option>
            <option value="5" <?= ($language==5) ? "selected" : ""; ?>>Vietnamese</option>
        </select>
    </div>
</div>