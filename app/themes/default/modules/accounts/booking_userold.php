<?php if (isset($_SESSION['user_login']) == true) { ?>

<div class="card-body">
<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::firstname?>:</strong></div>
<div class="col-md-9 font-size-14"><?=$profile_data->ai_first_name?></div>
</div>

<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::lastname?>:</strong></div>
<div class="col-md-9 font-size-14"><?=$profile_data->ai_last_name?></div>
</div>

<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::email?>:</strong></div>
<div class="col-md-9 font-size-14"><?=$profile_data->accounts_email?></div>
</div>

<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::phone?>:</strong></div>
<div class="col-md-9 font-size-14"><?=$profile_data->ai_mobile?></div>
</div>

<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::address?>:</strong></div>
<div class="col-md-9 font-size-14"><?=$profile_data->ai_address_1?>, <?=$profile_data->ai_country?></div>
</div>

<div class="row">
<div class="col-md-2 font-size-14"><strong><?=T::nationality?>:</strong></div>
<div class="col-md-4 font-size-14">
<select class="form-select form-select-sm nationality" name="nationality" style="min-height:30px">
<?=countries_list();?>
<option>qasim</option>
</select>
</div>
</div>


<!--<div class="row">
<div class="col-md-3"><?=T::nationality?></div>
<div class="col-md-9"><?php if(isset($_SESSION['hotels_nationality'])){ echo $_SESSION['hotels_nationality']; } else { echo "IN"; } ?></div>
</div>-->

<input type="hidden" name="firstname" class="firstname_cls" value="<?=$profile_data->ai_first_name?>" />
<input type="hidden" name="lastname" class="lastname_cls" value="<?=$profile_data->ai_last_name?>" />
<input type="hidden" name="email" class="email_cls" value="<?=$profile_data->accounts_email?>" />
<input type="hidden" name="phone" class="phone_cls" value="<?=$profile_data->ai_mobile?>" />
<input type="hidden" name="address" class="address_cls" value="<?=$profile_data->ai_address_1?>, <?=$profile_data->ai_country?>" />
<input type="hidden" name="country_code" class="country_code" value="<?=$profile_data->ai_country?>" />
<input type="hidden" name="nationality" class="nationality" value="<?php if(isset($_SESSION['hotels_nationality'])){ echo $_SESSION['hotels_nationality']; } else { echo "IN"; } ?>" />

<script>
$('.nationality option[value=<?php if(isset($_SESSION['hotels_nationality'])){ echo $_SESSION['hotels_nationality']; } else { echo "IN"; } ?>]').attr('selected','selected');
</script>

</div>
<?php } else { ?>
<?= userinfo();?>
<?php } ?>