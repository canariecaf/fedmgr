<div id="pagetitle"><?php echo lang('rr_arpexcl1');?></div>
<div id="subtitle"><h3><?php echo anchor(base_url().'providers/provider_detail/idp/'.$idp_id, $idp_name ) ;?></h3><h4><?php echo $idp_entityid;?></h4></div>

<?php

if(!empty($excarray))
{
    echo '<pre>';
    print_r($excarray);
    echo '</pre>';
    foreach($excarray as $o)
     {
          echo $o;
    }

}

$attrs = array('id'=>'arpexlusions');
echo form_open(current_url(),$attrs);
if(!empty($rows) && is_array($rows))
{
    echo form_fieldset();
    echo '<ol>';
    foreach($rows as $r)
    {
       echo '<li>'.$r.'</li>';
      
    }
    echo '</ol>';
    echo form_fieldset_close();
    echo '<div class="buttons">';
    echo '<button type="reset" name="reset" value="reset" class="button negative">
                  <span class="reset">'.lang('rr_reset').'</span></button>';
    echo '<button type="submit" name="modify" value="submit" class="button positive">
                  <span class="save">'.lang('rr_save').'</span></button>';
    echo  '</div>';


}

echo form_close();