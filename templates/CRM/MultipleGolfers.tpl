<div id="multiplehonorees" class="crm-public-form-item crm-group custom_post_profile-group">
  <div class="crm-public-form-item crm-group">
{section name='i' start=1 loop=4}
  {assign var='rowNumber' value=$smarty.section.i.index}
  <div id="add-item-row-{$rowNumber}" class="honoree-row hiddenElement {cycle values="odd-row,even-row"}">
    <fieldset><legend>{ts}Golfer {$rowNumber}{/ts}</legend>
    <div class="crm-section">
      <div class="label">
        {$form.golfer_first_name.$rowNumber.label}
      </div>
      <div class="content">
        {$form.golfer_first_name.$rowNumber.html}<br>
      </div>
    </div>
    <br/>
    <div class="crm-section">
      <div class="label">
        {$form.golfer_last_name.$rowNumber.label}
      </div>
      <div class="content">
        {$form.golfer_last_name.$rowNumber.html}
      </div>
    </div>
    </fieldset>
  </div>
{/section}
</div>
</div>
